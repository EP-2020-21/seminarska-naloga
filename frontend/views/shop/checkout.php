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
        <a href="<?= BASE_URL . "shop" ?>" class="text-left p-4 sm:p-6 ml-4 my-4 text-xl text-blue-700 hover:underline cursor-pointer">Nazaj v trgovino</a>
        <h1 class="text-6xl font-extrabold text-white select-none text-center">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 px-2 rounded-md">
                        Blagajna
                    </span>
        </h1>
        <?php if (isset($message)): ?>
            <h2 class="p-4 sm:p-6 my-4 bg-blue-700 text-left text-xl text-white font-bold"><?= $message ?></h2>
        <?php endif; ?>
        <table class="table-auto container mx-auto text-center mt-4">
            <tr class="border-b-2 border-black">
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Artikel</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Količina</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">Cena na kos</th>
                <th class="text-lg sm:text-xl p-2 sm:p-6 text-bold">SkupajCena</th>
            </tr>
        <?php foreach ($basket as $item): ?>
            <tr>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold"> <?=$item["naziv"] ?></td>
                <td class="text-lg sm:text-xl p-2 sm:p-6 text-bold">
                    <form method="POST" action="<?= BASE_URL  . "checkout/updateBasket" ?>">
                        <input hidden name="id"  value="<?=$item["itemID"]?>" />
                        <input name="kolicina" type="number" step="1" min="0" value="<?=$item["kolicina"] ?>" class="text-right"/>
                        <input type="submit" value="posodobi"/>
                    </form>
                </td>
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
        <div class="w-full flex sm:justify-end sm:flex-row items-center flex-col-reverse sm:mr-4">
            <a  href="<?= BASE_URL . "checkout/emptyBasket" ?>"
                class="p-4 sm:p-6 rounded-lg text-white bg-red-500 mx-2 text-bold cursor-pointer font-bold w-3/4 sm:w-1/6 text-center mt-4">Sprazni košarico</a>
            <a href="<?=BASE_URL. "checkout/oddajNakup"?>"
               class="p-4 sm:p-6 rounded-md text-white bg-blue-700 mx-2 text-bold cursor-pointer font-bold w-3/4 sm:w-1/6 text-center mt-4">
                Potrdi naročilo
            </a>
        </div>
    </body>
</html>
