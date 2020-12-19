<section id="featured-items">
    <!-- Desktop slider -->
    <div class="swiper-container lg:h-96 h-80 mx-auto xl:shadow-lg w-full lg:block hidden">
        <div class="swiper-wrapper">

            <!-- Slides -->
            <?php foreach($featuredItems as $featuredItem): ?>
            <div class="swiper-slide w-full h-full flex md:flex-row flex-col">
                <div class="flex-shrink">
                    <img alt="test" src="<?= $featuredItem["PATH_TO_IMG"] ?>" class="w-full h-auto" />
                </div>
                <div class="relative p-4 flex justify-center flex-col flex-grow">
                    <div>
                        <h2 class="mr-2 mt-2 text-black text-3xl text-black font-semibold font-serif w-3/4"><?= $featuredItem["NAZIV_ARTIKEL"] ?></h2>
                        <p  class="mr-2 mt-2 text-black text-xl text-black font-light font-serif"><?= $featuredItem["OPIS"] ?></p>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button class="w-1/4 p-2 bg-blue-500 hover:bg-blue-700 text-white text-2xl cursor-pointer rounded-full">V košarico</button>
                        <p  class="mt-2 text-black text-5xl text-black font-semibold font-serif"><?= $featuredItem["CENA"] ?> €</p>
                    </div>
                    <h1 class="absolute top-2 right-2 bg-black text-white p-1 uppercase rounded-sm">novo</h1>
                </div>          
            </div>
            <?php endforeach; ?>
            <!-- END OF SLIDES -->

        </div>
    </div>
    <!-- Mobile -->
    <div class="flex flex-col lg:hidden">
        <h1 class="text-4xl font-extrabold text-black p-2 text-center font-semibold w-full">Novo v ponudbi!</h1>
        <hr/>

        <!-- ITEMS -->
        <div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- SLIDE -->
                    <?php foreach($featuredItems as $featuredItem): ?>
                    <div class="swiper-slide flex w-full justify-between sm:flex-row flex-col my-2">
                        <!-- IMG -->
                        <div class="sm:w-1/4 w-full">
                            <img src="<?= $featuredItem["PATH_TO_IMG"] ?>" alt="burger" class="h-auto sm:w-full max-w-12 max-h-60 mx-auto">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="flex flex-col sm:w-3/4 w-full p-2">
                            <h1 class="font-bold font-serif sm:text-2xl text-lg text-black"><?= $featuredItem["NAZIV_ARTIKEL"] ?></h1>
                            <p class="font-serif sm:text-xl text-sm text-black"><?= $featuredItem["OPIS"] ?></p>
                            <div class="flex justify-between items-center mt-1">
                                <button class="font-bold text-blue-500 hover:text-blue-700 underline cursor-pointer text-xl">
                                       V košarico 
                                </button>
                                <p class="font-bold font-serif text-xl text-black"><?= $featuredItem["CENA"] ?> €</p>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <?php endforeach; ?>
                <!-- END OF SLIDE -->
                </div>
            </div>
        </div>
        <!--  -->

    </div>
</section>