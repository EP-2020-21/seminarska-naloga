<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=  $profile["IME"] . " " . $profile["PRIIMEK"] ?></title>
    <link rel="stylesheet" href="<?= CSS_URL . "tailwind.css" ?>">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
</head>
    <body>
    <div x-data="userProfile()">
        <?php include "nav.php" ?>
        <?php include "content.php" ?>
    </div>
    <script>
        const userProfile = () => {
          return {
            id: null,
            tab: "Moj profil",
            nakupi: [],
            error: "",
            changeTab (tab) {
              this.tab = tab
              if ((this.tab === "Nakupi") && (this.nakupi === [])){
                    fetch(`http://localhost/seminarska-naloga/index.php/api/nakupi?id=${id}`)
                    .then(response => response.json())
                    .then(nakupi  => this.nakupi = nakupi)
                    .catch(err => this.error = "Napaka pri iskanju nakupov")
              }
            },
          }
        }
        const form = () => {
          return {
            disabled: true,
            btn: "Želim urediti profil",
            toggleForm () {
              this.disabled = !this.disabled;
              this.btn = this.disabled ?  "Želim urediti profil" : "Zakleni urejanje"
            }
          }
        }
    </script>
    </body>
</html>