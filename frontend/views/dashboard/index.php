<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
</head>
    <body class="overflow-hidden">
        <?php include_once "message.php" ?>
        <?php include_once "nav.php" ?>
        <section id="dashboard-body" x-data="dashboard()" class="w-full h-5/6 grid grid-cols-5">
            <?php include_once "sidebar.php" ?>
            <?php include_once "content.php" ?>
        </section>
    </body>
    <script>
        const dashboard = () => {
          return {
            tab: "narocila",
            changeTab (tab) {
              this.tab = tab
            },
          }
        }

        const message = () => {
          return {
            show: true,
            close () {
              this.show = false
            }
          }
        }
    </script>
</html>
