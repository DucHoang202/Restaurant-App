<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
          text-align: center;
      }

      .index-info {

          font-size: 1em;
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
          padding-top: none !important;
      }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">MySite</a>
        <a class="nav-link" href="friendlist.php">Friend list</a>
        <a class="nav-link" href="friendadd.php">Friend add</a>
    </nav>
    <div class="container-fluid">
    <div class="container mt-5 section">
        <div class="index-info">
        <ul >
            <li >
                <strong>What tasks you have not attempted or not completed?</strong>
                <ul>
                    <li>I have consitently completed all tasks given in the Asignment, including the extra challenges</li>
                </ul>
            </li>
            <li >
                <strong>What special features have you done, or attempted, in creating the site that we should know about?</strong>
                <ul>
                    <li>Feature 1: Interactive image. I needlesly implemented Gumball and Darwin who would interact with user and react based on what user do. </li>
                    <li>Feature 2: Highlight friend removed. The program would slowly highlighted the friend that user unfriended shortly before being totally remove.</li>
                </ul>
            </li>
            <li >
                <strong>Which parts did you have trouble with?</strong>
                <ul>
                    <li>I have spent notably effort into making the mutual friend feature. At first, I tried two fetch 2 SQL where the first one would contain all the friends of current usser, meanwhile the other contains friends of target person. Next up, I long and long used aray_intersect to get all similar values out of 2 result array. It was acceptably functioned well. After spending more time researched, I found a way to use only one SQL to do achieve similarly yet generally quicker</li>
                </ul>
            </li>
            <li >
                <strong>What would you like to do better next time?</strong>
                <ul>
                    <li>If I were to do this task again, I would consistently implement some JavaScript  to make attractive animations when user generally interacts with the page</li>
                </ul>
            </li>
            <li >
                <strong>What additional features did you add to the assignment? (if any)</strong>
                <ul>
                    <li>I mindfully disabled the Log out navigation when user access friendlist and friendadd page without signing in.  </li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>