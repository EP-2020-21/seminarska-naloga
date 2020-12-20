<section class="bg-gradient-to-r from-blue-500 via-blue-700 to-blue-500 w-full h-48 text-white text-center">
    <div class="p-10 flex justify-center items-center flex-col w-full h-full">
        <!-- CURRENT CATEGORY -->
        <h1 class="font-bold text-4xl p-2">
            Kategorija
        </h1>
        <!-- CATEGORY LIST -->
        <ul class="flex flex-wrap justify-center items-center">
            <li class="mx-2 text-xl hover:underline">
                <a href="<?= BASE_URL . "shop"?>">Vse</a>
            </li>
            <?php foreach ($kategorije as $kategorija): ?>
            <p class="hidden lg:inline select-none">&#9671</p>
            <li class="mx-2 text-xl hover:underline">
                <a href="<?= BASE_URL . "shop?kategorija=" . $kategorija["ID_KATEGORIJE"] ?>"><?=$kategorija["NAZIV_KATEGORIJE"]?> </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>