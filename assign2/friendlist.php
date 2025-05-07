<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend List</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .index-info {

    font-size: 1.875em;
    text-align: center;
    background: linear-gradient(-45deg, blue, red, green, purple, black);
    background-size: 400% 400%;
    animation: gradient 7s ease infinite;
    height: auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
.navbar .nav-link, .navbar .navbar-brand{
  color: white !important;
}
    </style>
</head>
<body style="background-color:  #826aa5;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">MySite</a>
        
        <?php
        // Check if user has logged in
        session_start();
        if (isset($_SESSION["email"])) {
        ?>
        <a class="nav-link" href="friendadd.php">Add friend</a>
        <a class="nav-link" href="logout.php">Log out</a>
        <?php
        }
        ?>
    </nav>

    <div class="container content mt-5" style="background-color: white;">
        <?php
        require_once("functions.php");
        require_once("db.php");

        if (isset($_SESSION["profile"]) && isset($_SESSION["email"])) {
            echo "<h1 class='display-4'>Welcome " . $_SESSION["profile"] . " to the site!</h1>";

            //Image of Darwin
            talking();
            echo "<div class='eyes'>";
            echo "<img class='eye eye-1' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 7%; max-height: 7%; top:-463px; right:-100px; position:relative;'>";
            echo "<img class='eye eye-2' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 7%; max-height: 7%; position: relative; bottom: 440px; left: 145px;'>";
            echo "<img class='eye eye-3' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 10%; max-height: 10%; position: relative; bottom: 444px; left: 409px;'>";
            echo "<img class='eye eye-4' src='/cos30020/s103809938/assign2//images/ey.png' style='max-width: 10%; max-height: 10%; position: relative; bottom: 484px; left: 145px;'>";
            echo "</div>";

            echo "<div id='all-table' style='position: relative; bottom: 176px;'>";
            echo "<table class='table table-bordered table-hover mt-4'><thead class='thead-dark'><tr><th>Friend Name</th><th>Action</th></tr></thead><tbody>";

            $email = $_SESSION["email"];
            $sql = "SELECT friend_id FROM friends WHERE friend_email = '$email'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $user = $row["friend_id"];

                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    Unfriend($id);
                    $sql7 = "SELECT profile_name FROM friends WHERE friend_id = '" . $id . "'";
                    $result7 = mysqli_query($conn, $sql7);
                    if ($result7) {
                        $row11 = mysqli_fetch_assoc($result7);
                        $byeFriend = $row11["profile_name"];
                        dar_talk("Seems like <br>" . $byeFriend . "<br> no longer uses<br> that account");
                        gum_talk("Better is a<br> neighbor who <br>is near than <br>a brother who<br> is far away");
                        //Transform image position
                        echo "<script>
                                document.getElementById('darwinMessage').style.bottom = '727px';
                                document.getElementById('gumballMessage').style.bottom = '1357px';
                                document.getElementById('darwinMessage1').style.bottom = '1076px';
                                document.getElementById('gumballMessage1').style.bottom = '1720px';
                                document.getElementById('all-table').style.bottom = '27px';
                              </script>";
                    }
                } else {
                    //Display Chat bubble
                    dar_talk("Hi, " . $_SESSION["profile"] . ". How <br> is your day?");
                    gum_talk("We had listed <br>your friends below.");
                    echo "<script>
                            document.getElementById('all-table').style.bottom = '26px';
                          </script>";
                }

                $sql1 = "SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$user'";
                $result1 = mysqli_query($conn, $sql1);

                if ($result1) {
                    echo "<div class='alert alert-info'>Total number of friends is " . mysqli_num_rows($result1) . "</div>";
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $friend_id = $row1["friend_id2"];
                        $friend_name = get_friend($friend_id);
                        echo "<form method='post' action='friendlist.php'>";
                        echo "<tr><td>$friend_name</td><td><a href='friendlist.php?id=".$friend_id."' class='btn btn-danger' onClick='black(this, event)'>Unfriend</a></td></tr>";
                        echo "</form>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No friends found</td></tr>";
                    dar_talk("Letting the friendlist<br> empty is no good!");
                    gum_talk("Lets go to <br>FRIEND LIST to add some!");
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No user found</td></tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning'>Please log in to continue!!</div>";
        }
        ?>
    </div>


    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>