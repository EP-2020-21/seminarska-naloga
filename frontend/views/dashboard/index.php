<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
</head>
    <body class="overflow-hidden">
        <?php include_once "nav.php" ?>
        <section id="dashboard-body" class="w-full h-screen grid grid-cols-4">
        <?php include_once "sidebar.php" ?>
        <?php include_once "content.php" ?>
        </section>
    </body>
</html>
