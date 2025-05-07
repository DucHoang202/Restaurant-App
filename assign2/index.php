<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #773400;
        }
        .container-fluid, body {
            background: linear-gradient(-45deg, #5ea1c2, #6291c0, #707eb6, #826aa5, #90558b, #96406a);
            background-size: 400% 400%;
            animation: gradient 7s ease infinite;
            padding: 20px;
            text-align: center;
        }
        .section {
            background: linear-gradient(-45deg, #5ea1c2, #39bacd, #33d0c4, #6ae3ab, #aef18b, #f9f871);
            background-size: 400% 400%;
            animation: gradient 7s ease infinite;
            padding: 20px;
            text-align: center;
        }
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar .nav-link, .navbar .navbar-brand {
            color: white !important;
        }
        .loading {
            height: 50px;
            width: 50px;
            border: 6px solid red;
            border-radius: 4px;
            box-shadow: 0 0 8px red, 0 0 8px red inset;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            animation: 2s loading ease-in-out forwards;
            animation-fill-mode: forwards;
        }
        @keyframes loading {
            0% { transform: rotateX(0) rotateY(0) rotate(0); opacity: 1; visibility: visible; }
            25% { transform: rotateX(180deg) rotateY(0) rotate(0); }
            50% { transform: rotateX(180deg) rotateY(180deg) rotate(0); }
            75% { transform: rotateX(180deg) rotateY(180deg) rotate(180deg); }
            100% { opacity: 0; visibility: hidden; display: none; }
        }
        .container {
            padding-top: none !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">MySite</a>
        <a class="nav-link" href="login.php">Log in</a>
        <a class="nav-link" href="signup.php">Sign up</a>
        <a class="nav-link" href="about.php">About</a>
    </nav>
    <div class="container-fluid">
        <div class="container content mt-5">
            <div class="section" id="intro">
                <div class="index-info">
                    <h1>Assignment 2</h1>
                    <div>Nguyen Duc Hoang</div>
                    <div>103809938</div>
                    <div>tomhoang152@gmail.com</div>
                    <div>
                        “I declare that this assignment is my individual work. I have not
                        worked collaboratively nor have I copied from any other student’s work
                        or from any other source."
                    </div>
                </div>
            </div>
            <div class="section" id="contact">
                <div class="mt-4">
                    <h2>Message:</h2>
                    <?php
                    include('db.php');
                    echo "<div class='loading'></div>";
                    $dbcr = "CREATE DATABASE IF NOT EXISTS s103809938_db";
                    $check = mysqli_query($conn, $dbcr);
                    if (!$check) {
                        echo "<div class='alert alert-danger'>Database creation error</div>";
                    } else {
                        echo "<div class='alert alert-success'>Database created successfully</div><br>";
                    }

                    $query = "CREATE TABLE IF NOT EXISTS friends (
                        friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        friend_email VARCHAR(50) NOT NULL,
                        password VARCHAR(20) NOT NULL,
                        profile_name VARCHAR(30) NOT NULL,
                        date_started DATE NOT NULL,
                        num_of_friends INT UNSIGNED
                    );";
                    $result2 = mysqli_query($conn, $query);
                    if ($result2) {
                        echo "<div class='alert alert-success'>Table has been created</div><br>";
                    } else {
                        echo "<div class='alert alert-danger'>Cannot create table</div>";
                    }

                    $create2 = "CREATE TABLE IF NOT EXISTS myfriends (
                        friend_id1 INT NOT NULL,
                        friend_id2 INT NOT NULL,
                        CONSTRAINT chk_friend_ids CHECK (friend_id1 <> friend_id2)
                    );";
                    mysqli_query($conn, $create2);

                    $resultBuild = 0;
                    $table = "friends";
                    $query = "SELECT COUNT(*) as count FROM $table";
                    $result5 = mysqli_query($conn, $query);
                    $number = mysqli_fetch_assoc($result5);
                    if ($number['count'] < 20) {
                        $names = [
                            "John Doe", "Jane Smith", "Michael Johnson", "Emily Davis", "David Brown",
                            "Sarah Wilson", "Chris Jones", "Amanda Garcia", "James Martinez", "Jessica Lee",
                            "Daniel White", "Laura Harris", "Matthew Clark", "Sophia Lewis", "Andrew Walker",
                            "Olivia Hall", "Joshua Young", "Emma King", "Ryan Wright", "Isabella Scott",
                            "Ethan Green", "Mia Adams", "Alexander Baker", "Ava Nelson", "Benjamin Carter"
                        ];

                        for ($i = 1; $i <= 25; $i++) {
                            $friend_email = "user$i@gmail.com";
                            $password = "password$i";
                            $profile_name = $names[$i - 1];
                            $date_started = "2022-01-" . str_pad($i, 2, '0', STR_PAD_LEFT);
                            $num_of_friends = 1;
                            $rand = rand(1, 25);

                            $sql10 = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) 
                                      VALUES ('$friend_email', '$password', '$profile_name', '$date_started', '$num_of_friends')";
                            $sql11 = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ('$i', '$rand')";

                            try {
                                mysqli_query($conn, $sql10);
                                mysqli_query($conn, $sql11);
                            } catch (mysqli_sql_exception $e) {
                                $resultBuild++;
                            }
                        }

                        if ($resultBuild < 1) {
                            echo "<div class='alert alert-success'>Populate data successfully</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Cannot populate data</div>";
                        }
                    } else {
                        echo "<div class='alert alert-success'>Populate data successfully</div>";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="container3D"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>