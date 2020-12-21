<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
    <title><?= $item["NAZIV_ARTIKEL"] ?></title>
</head>
<body>
<?php include_once "nav.php" ?>
<main class="mt-5 mx-auto flex flex-col w-1/2">
    <form action="<?=BASE_URL. "dashboard/editItem"?>" method="POST">
        <h1 class="px-1 sm:px-2 py-1 text-lg">Artikel</h1>
        <input hidden name="id" value="<?= $item["ID_ARTIKEL"] ?>" />
        <input
            type="text"
            class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 my-2"
            name="naziv"
            value="<?= $item["NAZIV_ARTIKEL"] ?>"
            required
        />
        <h1 class="px-1 sm:px-2 py-1 text-lg">Opis</h1>
        <textarea
            rows="5"
            name="opis"
            class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 my-2"
            required
        ><?= $item["OPIS"] ?></textarea>
        <h1 class="px-1 sm:px-2 py-1 text-lg">Cena</h1>
        <input
            type="number"
            name="cena"
            step=".01"
            class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 my-2"
            value="<?= $item["CENA"] ?>"
            required
        />
        <h1 class="px-1 sm:px-2 py-1 text-lg">Slika</h1>
        <input
            id="img_url"
            type="text"
            class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 my-2"
            name="img_url"
            placeholder="Povezava do slike se bo izpolnila z klikom na upload file"
            value="<?= $item["PATH_TO_IMG"] ?>"
            required
        />

        <select name="kategorija" id="kategorija"
                class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 my-2"
        >
            <?php foreach($kategorije as $kategorija): ?>
                <option value="<?= $kategorija["ID_KATEGORIJE"] ?>"> <?= $kategorija["NAZIV_KATEGORIJE"] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="flex">
            <input
                type="submit"
                value="Posodobi"
                class="ml-2 px-2 py-2 font-sans bg-yellow-400 text-black font-bold text-2xl cursor-pointer transform duration-100 hover:bg-yellow-300 uppercase my-2 w-full"
            />
        </div>
    </form>
    <h1 class="px-1 sm:px-2 py-1 text-lg">Naloži sliko</h1>
    <button id="upload_widget" class="cloudinary-button my-2">Upload files</button>
</main>

<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script type="text/javascript">
  var myWidget = cloudinary.createUploadWidget({
      cloudName: 'karantenafud',
      uploadPreset: 'emss9enu'}, (error, result) => {
      if (!error && result && result.event === "success") {
        document.getElementById("img_url").value = result.info.secure_url
      }
    }
  )
  document.getElementById("upload_widget").addEventListener("click", function(){
    myWidget.open();
  }, false);
</script>
</body>
</html>
