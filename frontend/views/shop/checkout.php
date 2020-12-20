<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=CSS_URL . "tailwind.css"?>">
    <title>Checkout</title>
</head>
    <body>
        <h1 class="p-4 sm:p-8 text-2xl sm:text-6xl">Blagajna</h1>
        <table class="table-auto container mx-auto text-center">
            <tr class="border-b-2 border-black">
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Artikel</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Količina</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Cena na kos</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">SkupajCena</th>
            </tr>
        <?php foreach ($basket as $item): ?>
            <tr>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold"> <?=$item["naziv"] ?></td>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold"> <?=$item["kolicina"] ?></td>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold"> <?=$item["cena"] ?>€</td>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold"> <?=$item["cenaSkupaj"] ?>€</td>
            </tr>
        <?php endforeach; ?>
            <tr class="border-t-2 border-black">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-xl sm:text-4xl p-2 sm:p-6 text-bold"><?= $totalValue ?>€</td>
            </tr>
        </table>
        <div class="w-full flex justify-evenly">
            <button class="p-4 sm:p-6 rounded-lg text-white bg-blue-700">Pobriši košarico</button>
            <button class="p-4 sm:p-6 rounded-lg text-white bg-blue-700">Posodobi košarico</button>
            <a href="<?=BASE_URL. "checkout/oddajNakup"?>" class="p-4 sm:p-6 rounded-lg text-white bg-blue-700">Potrdi naročilo</a>
        </div>
    </body>
</html>
