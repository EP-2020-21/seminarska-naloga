<section id="items" class="mt-2 mb-6">
    <h1 class="text-4xl font-extrabold text-black p-2 text-center font-semibold w-full">Redno na meniju!</h1>
    <hr class="h-2"/>

    <!-- ITEMS -->
    <div class="grid grid-cols-2 gap-4 lg:gap-0 mt-2">
        <!-- ITEM -->
        <?php foreach($items as $item): ?>
        <div class="col-span-2 sm:col-span-1 flex flex-col justify-evenly items-center sm:my-4">
            <!-- IMAGE -->
            <div class="w-full h-full flex items-center justify-center">
                    <img src="<?= $item["PATH_TO_IMG"] ?>" alt="<?= $item["NAZIV_ARTIKEL"] ?>" class="h-auto sm:w-full max-w-12 max-h-60 sm:max-h-full mx-auto sm:rounded-sm sm:shadow-sm" style="max-width: 500px; max-height: 500px;">
            </div>
            <!-- DESCRIPTION -->
            <div class="flex flex-col sm:w-3/4 w-full p-2 mx-auto justify-between items-between">
                <h1 class="font-bold font-serif sm:text-2xl text-lg text-black"><?= $item["NAZIV_ARTIKEL"] ?></h1>
                <p class="font-serif sm:text-xl text-sm text-black"><?= $item["OPIS"] ?></p>
                <div class="flex justify-between items-center mt-1">
                    <button class="font-bold text-blue-500 hover:text-blue-700 underline cursor-pointer text-xl">
                            V košarico 
                    </button>
                    <p class="font-bold font-serif sm:text-4xl text-xl text-black"><?= $item["CENA"] ?> €</p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
    <!--  -->

</section>