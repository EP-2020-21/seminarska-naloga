<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>STORE</title>
		<link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
		<link rel="stylesheet" href="<?=CSS_URL . "_shop.css"?>">
	</head>
	<body class="bg_pattern">
		<a class="p-2 fixed bottom-0 right-0 bg-blue-700 uppercase text-white w-full sm:w-32" href="#nav"></a>

		<!-- NAVIGATION -->
		<?php include_once "nav.php";?>
		<!--  -->
		<?php include_once "category.php";?>
		<main class="lg:container shadow-2xl mx-auto bg-white lg:mt-3 relative lg:bottom-10" style="margin-bottom: 40px;">
			<!-- FILTERS TODO -->
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
	</body>
</html>