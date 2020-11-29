<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Index page</title>
    <link rel="stylesheet" href="<?= CSS_URL . "tailwind.css" ?>">
  </head>
  <body>

    <!-- NAVIGATION -->
      <?php include_once "nav.php"; ?>
    <!--  -->
    
    <!-- MAIN SHOP -->
    <h1>Hello world!</h1>
    <a href="<?= BASE_URL . "login"?>">login</a>
    <a href="<?= BASE_URL . "register"?>">register</a>
    <?php if(isset($_SESSION["profile_id"])){
      echo $_SESSION["profile_id"];
    }
    ?>
    <!--  -->

    <!-- FOOTER -->

    <!--  -->
  </body>
</html>