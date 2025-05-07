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
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <style>
              .navbar {
          background-color: #773400;
      }

      .container-fluid, body {
          background: linear-gradient(-45deg,

                  #5ea1c2,
                  #6291c0,
                  #707eb6,
                  #826aa5,
                  #90558b,
                  #96406a);
          background-size: 400% 400%;
          animation: gradient 7s ease infinite;
          padding: 20px;
          text-align: center;
      }

      .section {
          background: linear-gradient(-45deg,
                  #5ea1c2,
                  #39bacd,
                  #33d0c4,
                  #6ae3ab,
                  #aef18b,
                  #f9f871);
          background-size: 400% 400%;
          animation: gradient 7s ease infinite;
          padding: 20px;
          text-align: left;
      }

      .index-info {

          font-size: 1.875em;
          text-align: left;
          background: linear-gradient(-45deg, blue, red, purple, black);
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

      .navbar .nav-link,
      .navbar .navbar-brand {
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
          0% {
              transform: rotateX(0) rotateY(0) rotate(0);
              opacity: 1;
              visibility: visible;
          }

          25% {
              transform: rotateX(180deg) rotateY(0) rotate(0);
          }

          50% {
              transform: rotateX(180deg) rotateY(180deg) rotate(0);
          }

          75% {
              transform: rotateX(180deg) rotateY(180deg) rotate(180deg);
          }

          100% {
              opacity: 0;
              visibility: hidden;
              display: none;
          }
      }

      .container {
          max-width: 40%;
      }
    </style>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #773400; color: white !important;">
        <a class="navbar-brand" style="color: white !important;" href="index.php">MySite</a>
        <a class="nav-link" style="color: white !important;" href="signup.php">Sign up</a>
        <a class="nav-link"  style="color: white !important;" href="about.php">About</a>

    </nav>
    <div class="container-fluid">
    <div class="container content mt-5 section">
        <h1 class="display-4 index-info">Login</h1>
        <form action="login.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        include('db.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $isValid = true;
            $email_regex = "/^[a-zA-Z]+@$/";
            $user_regex = "/^[a-zA-Z]+$/";
            $pass_regex = "/^[a-zA-Z0-9_.-]*$/";

            $isValid = false;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='alert alert-danger mt-3'>Please enter a valid email!</div>";
                $isValid = false;
            } else {
                $sql = "SELECT * FROM friends WHERE friend_email = '$email' AND password = '$password'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["email"] = $email;
                    $_SESSION["profile"] = $row["profile_name"];
                    header("Location: friendlist.php");
                } else {
                    echo "<div class='alert alert-danger mt-3'>Username or password is incorrect!</div>";
                }
            }
        }
        ?>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>