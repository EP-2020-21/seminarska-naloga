<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
    <title>Add item</title>
</head>
    <body>
        <?php include_once "nav.php" ?>
        <main class="mt-5">
            <form action="<?=BASE_URL. "/api/addItem"?>" method="POST" class="mx-auto flex flex-col w-3/4">
                <h1>Artikel</h1>
                <input
                    type="text"
                    class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    name="naziv"
                    required
                />
                <h1>Opis</h1>
                <textarea type="text" name="opis" required > </textarea>
                <h1>Cena</h1>
                <input type="number" name="slika" required />
                <h1>Slika</h1>
                <input type="file" name="slika" required />
                <input type="submit"  value="dodaj"/>
            </form>
        </main>
    </body>
</html>
