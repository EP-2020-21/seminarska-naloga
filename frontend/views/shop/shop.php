<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Index page</title>
  </head>
  <body>
    <h1>Hello world!</h1>
    <a href="<?= BASE_URL . "login"?>">login</a>
    <?php if(isset($_SESSION["profile_id"])){
      echo $_SESSION["profile_id"];
    }
    ?>
  </body>
</html>