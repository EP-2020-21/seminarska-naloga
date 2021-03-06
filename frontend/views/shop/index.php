<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>STORE</title>
		<link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
		<link rel="stylesheet" href="<?=CSS_URL . "_shop.css"?>">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
	</head>
	<body class="bg_pattern" x-data="shop()" x-init="fetchBasket()">
		<a class="p-2 fixed bottom-0 right-0 bg-blue-700 uppercase text-white w-full sm:w-32" href="#nav"></a>

		<!-- NAVIGATION -->
		<?php include_once "nav.php";?>
		<!--  -->
		<?php include_once "category.php";?>
		<main class="lg:container shadow-2xl mx-auto bg-white lg:mt-3 z-10 relative lg:bottom-10" style="margin-bottom: 40px;">
			<!-- FEATURE ARTIKLI -->
			<?php include_once "featureditems.php";?>
			<!-- OSTALI ARTIKLI -->
			<?php include_once "items.php";?>
		</main>

		<!-- FOOTER -->

		<!-- LIBS  -->
		<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
		<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
		<!-- Swiper -->
		<script src="<?= JS_URL . "swiper.js"?>"> </script>
		<script src="<?= JS_URL . "mobile-overlay.js"?>"> </script>
        <script>
            const shop = () => {
                return {
                  apiURL: "https://localhost/netbeans/seminarska-naloga/index.php/api/",
                  popup: false,
                  st_artiklov: 0,

                  filledBasket () {
                    return this.popup;
                  },

                  fetchBasket() {
                    fetch(`${this.apiURL}basket`)
                    .then(response => response.json())
                    .then(basket => {
                      if(basket) {
                        if (Object.keys(basket).length > 0){
                           this.st_artiklov = Object.keys(basket).length
                          this.popup = true;
                        }
                      }
                    })
                  },
                  addToBasket(id_artikel) {
                    fetch(`${this.apiURL}addToBasket?id=${id_artikel}`)
                    .then(response => response.json())
                    .then( basket => {
                      if(basket) {
                        if (Object.keys(basket).length > 0){
                          this.st_artiklov = Object.keys(basket).length
                          this.popup = true;
                        }
                      }
                    })
                  }
                }
            }

            const profileDropdown = () => {
              return {
                show: false,
                openDropdown () {
                  this.show = true
                },
                closeDropdown () {
                  this.show = false
                }
              }
            }
        </script>
	</body>
</html>