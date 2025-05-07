<?php
session_start();
if (isset($_SESSION["profile"])) {
    header("Location: friendlist.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:  #826aa5;">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #773400; color: white !important;">
        <a class="navbar-brand" href="index.php" style="color: white !important;">MySite</a>
        <a class="nav-link" href="login.php" style="color: white !important;">Log in</a>
        <a class="nav-link" href="about.php" style="color: white !important;">About</a>

    </nav>
    <div class="container mt-5" style="background-color: #aef18b; max-width: 40%; height: 200%;">
        <h1 class="display-4">Sign Up</h1>
        <form action="signup.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="profile">Profile name</label>
                <input type="text" class="form-control" id="profile" name="profile" required value="<?php echo isset($_POST['profile']) ? htmlspecialchars($_POST['profile'], ENT_QUOTES) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <div class="form-group">
                <label for="firmpass">Confirm password</label>
                <input type="password" class="form-control" id="firmpass" name="firmpass" required>
            </div>
            <button type="submit" class="btn btn-primary" style="text-align: center;">Submit</button><br><br><br>
        </form>

        <?php
        include('db.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $profile_name = $_POST['profile'];
            $password = $_POST['pass'];
            $firmpass = $_POST['firmpass'];

            $isValid = true;

            if ($password !== $firmpass) {
                echo "<div class='alert alert-danger mt-3'>Password did not match!</div>";
                $isValid = false;
            }

            $email_regex = "/^[a-zA-Z]+@$/";
            $user_regex = "/^[a-zA-Z]+$/";
            $pass_regex = "/^[a-zA-Z0-9_.-]*$/";

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='alert alert-danger mt-3'>Please enter a valid email!</div>";
                $isValid = false;
            }

            if (!preg_match($user_regex, $profile_name)) {
                echo "<div class='alert alert-danger mt-3'>Profile name should only contain letters!</div>";
                $isValid = false;
            }

            if (!preg_match($pass_regex, $password)) {
                echo "<div class='alert alert-danger mt-3'>Password should only contain letters, numbers, and certain special characters!</div>";
                $isValid = false;
            }

            $sql = "SELECT * FROM friends WHERE friend_email = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='alert alert-danger mt-3'>This email has been registered</div>";
                $isValid = false;
            }

            if ($isValid) {
                $_SESSION["profile"] = $profile_name;
                $_SESSION["email"] = $email;

                echo "<div class='alert alert-success mt-3'>Sign up success</div>";
                $date_started = date('Y-m-d');
                $sql = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) 
                        VALUES ('$email', '$password', '$profile_name', '$date_started', '0')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: friendlist.php");
                }
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>