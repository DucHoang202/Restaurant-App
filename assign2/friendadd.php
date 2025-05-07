<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:  #826aa5;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #773400;">
        <a class="navbar-brand" style="color: white !important;" href="index.php">MySite</a>
        <?php
        session_start();
        if (isset($_SESSION["email"])) {
        ?>
        <a class="nav-link"style="color: white !important;" href="friendlist.php">Friend list</a>
        <a class="nav-link" style="color: white !important;" href="logout.php">Log out</a>
        <?php
        }
        ?>
    </nav>

    <div class="container content mt-5" style="background-color: white;">
        <?php
        require_once("functions.php");
        require_once("db.php");
        $page = 0;
        $pages = 0;
        $user = 0;
        if (isset($_SESSION["profile"]) && isset($_SESSION["email"])) {
            echo ("<h1 class='display-4'>Welcome " . $_SESSION["profile"] . " to the site!</h1>");

            //Image of Gumball
            echo "<div style='relative'>";
            talking();
            echo "<div class='eyes'>";
            echo "<img class='eye eye-1' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 7%; max-height: 7%; top:-463px; right:-100px; position:relative;'>";
            echo "<img class='eye eye-2' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 7%; max-height: 7%; position: relative; bottom: 440px; left: 145px;'>";
            echo "<img class='eye eye-3' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 10%; max-height: 10%; position: relative; bottom: 444px; left: 409px;'>";
            echo "<img class='eye eye-4' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 10%; max-height: 10%; position: relative; bottom: 484px; left: 145px;'>";
            echo "</div>";
            echo "<table class='table table-bordered table-hover mt-4'><thead class='thead-dark'><tr><th>Friend Name</th><th>Action</th><th>Mutual friends</th></tr></thead><tbody>";

            $email = $_SESSION["email"];
            $sql = "SELECT friend_id FROM friends WHERE friend_email = '$email'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $user = $row["friend_id"];
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    Addfriend($id);
                }
      
                $sql1 = "SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$user'";
                $result1 = mysqli_query($conn, $sql1);

                if ($result1) {
                    echo "<div class='alert alert-info'>Total number of friends is " . mysqli_num_rows($result1) . "</div>";
                }
                $sql1 = "SELECT friend_id, profile_name FROM friends WHERE friend_id NOT IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$user') AND friend_id != '$user'";
                $result3 = mysqli_query($conn, $sql1);

                // Pagination
                $start = 0;
                $rows_per_page = 10;
                $nr_of_rows = $result3->num_rows;
                $pages = ceil($nr_of_rows / $rows_per_page);
             
                if (isset($_GET['page-nr'])) {
                    $page = $_GET['page-nr'] - 1;
                    $start = $page * $rows_per_page;
                    $_SESSION["page_number"] = $page;
                } else {
                    $page = 0;
                    $_GET['page-nr'] = 1;
                }

                //Divide item for each pagination page
                $sql2 = "SELECT friend_id, profile_name FROM friends WHERE friend_id NOT IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$user') AND friend_id != '$user' LIMIT $start, $rows_per_page";
                $result1 = mysqli_query($conn, $sql2);

                if ($result1) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $friend_id = $row1["friend_id"];
                        $friend_name = $row1["profile_name"];
                        echo "<form method='post' action='friendadd.php'>";
                        echo "<tr><td>$friend_name</td>
                              <td><a href='friendadd.php?id=".$friend_id. "&page-nr=". $_GET["page-nr"] ."' class='btn btn-primary'>Add friend</a></td>
                              <td>".count_mutual_friends((int)$user, (int)$friend_id)."</td></tr>";                        echo "</form>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No friends found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No user found</td></tr>";
            }
            echo "</tbody></table>";
            echo "</div>";

        ?>

        <div class="content"></div>
        <div class="page-info mt-4">
            <p>Showing <?php echo $page + 1 ?> of <?php echo $pages ?> pages</p>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="?page-nr=1">First</a></li>

                <?php
                // Go to previous page
                if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page-nr=' . ($_GET['page-nr'] - 1) . '">Previous</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
                }
                    //Use number for navigation
                ?>
            
                <div class="page-numbers">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $pages; $i++) {
                            echo '<li class="page-item"><a class="page-link" href="?page-nr=' . $i . '">' . $i . '</a></li>';
                        } ?>
                    </ul>
                </div>

                <?php
                //Go to next page
                if (!isset($_GET['page-nr'])) {
                    echo '<li class="page-item"><a class="page-link" href="?page-nr=2">Next</a></li>';
                } else {
                    if ($_GET['page-nr'] >= $pages) {
                        echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page-nr=' . ($_GET['page-nr'] + 1) . '">Next</a></li>';
                    }
                }
                ?>
                <li class="page-item"><a class="page-link" href="?page-nr=<?php echo $pages ?>">Last</a></li>
            </ul>
        </nav>
        <?php 
                } else {
            echo "<div class='alert alert-warning'>Please log in to continue!!</div>";
        }
            dar_talk("I am truly <br> looking forward!");
            gum_talk("Lets find some <br>friends here!");
            echo "<script>      document.getElementById('darwinMessage').style.bottom = '1580px';
                                document.getElementById('gumballMessage').style.bottom = '2086px';
                                document.getElementById('darwinMessage1').style.bottom = '1944px';
                                document.getElementById('gumballMessage1').style.bottom = '2438px'; </script>";

            echo "</div>";
        ?>
    </div>
    
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

