<?php
      $db_server = "feenix-mariadb.swin.edu.au";
      $db_user = "s103809938";
      $db_pass = "140502";
      $db_name = "s103809938_db";
      try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
      }
      catch(mysqli_sql_exception $e) {
        echo "<div class='alert alert-success'>Could not connect</div><br>";
      }
?>