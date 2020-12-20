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
            apiURL: "http://localhost/seminarska-naloga/index.php/api/",

            items: [],
            fetchItems () {
              fetch(`${this.apiURL}items`)
              .then(response => response.json())
              .then(items => this.items = items)
            },

            stranke: [],
            fetchStranke () {
              fetch(`${this.apiURL}stranke`)
              .then(response => response.json())
              .then(stranke => this.stranke = stranke)
            },

            zaposleni: [],
            fetchZaposleni () {
              fetch(`${this.apiURL}zaposleni`)
              .then(response => response.json())
              .then(zaposleni => this.zaposleni = zaposleni)
            },

            activateUser(id) {
                fetch(`${this.apiURL}activate/stranka?id=${id}`)
                .then(response => response.json())
                .then( _ => {this.fetchStranke()});
            },

            deactivateUser(id) {
              fetch(`${this.apiURL}deactivate/stranka?id=${id}`)
              .then(response => response.json())
              .then( _ => {this.fetchStranke()});
            },

            activateZap(id) {
              fetch(`${this.apiURL}activate/zaposleni?id=${id}`)
              .then(response => response.json())
              .then( _ => {this.fetchZaposleni()});
            },

            deactivateZap(id) {
              fetch(`${this.apiURL}deactivate/zaposleni?id=${id}`)
              .then(response => response.json())
              .then( _ => {
                this.fetchZaposleni()
              });
            },

            tab: "narocila",
            changeTab (tab) {
              this.tab = tab
              if (this.tab === "artikli") {
                    this.fetchItems()
              } else if (this.tab === "stranke") {
                    this.fetchStranke()
              } else if (this.tab === "zaposleni"){
                    this.fetchZaposleni()
              }
            }
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
