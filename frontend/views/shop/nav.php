<nav id="nav" class="bg-white mx-auto w-full py-4 shadow-lg md:sticky">
    <!-- MENU ON DESKTOP -->
    <div class="pt-3 pb-2 flex justify-between items-center lg:flex hidden lg:container mx-auto">
    <!-- LOGO || RIGHT SIDE -->
    <div class="mt-2">            
        <form
            method="POST"
            action="<?= BASE_URL . "shop"?>"
            class="flex items-center mx-2 justify-end w-full"
            >
                <input 
                    type="text"
                    name="query"
                    placeholder="Poišči v trgovini"
                    class="rounded-md shadow-md px-2 py-1 focus:ring-blue-700 w-full" 
                />
                <input type="submit" value="išči" class="shadow-md px-2 py-1"/>
            </form>
        </div>
        <!-- CENTER -->
        <div
            id="nav_center"
            class="flex justify-center items-center"
        >
            <h1 class="text-6xl font-extrabold text-white select-none">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 px-2 rounded-md">
                    KarantenaFud
                </span>
            </h1>
        </div>
        <!-- LINKS || USER PROFILE || LEFT SIDE -->
        <div 
        id="nav_right"
        class="flex justify-end pr-4"
        >
            <ul class="flex">
                <li class="flex items-center w-6 mx-4 relative">
                    <a 
                    href="<?= BASE_URL . "checkout" ?>"
                    class="text-xl text-gray-400 hover:text-blue-700 uppercase"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-400 hover:text-blue-700">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    </a>
                    <?php if (isset($_SESSION["basket"])) : ?>
                    <div class="absolute top-7 left-5 rounded-full bg-red-700 h-5 w-5 flex justify-center items-center">
                        <p id="basketCounter" class="text-white p-1 text-xs font-bold"><?= sizeof($_SESSION["basket"]) ?></p>
                    </div>
                    <?php endif; ?>
                </li>
                <li class="px-2 flex items-center mx-2 relative">
                    <?php if (isset($_SESSION["profile"])): ?>
                    <div x-data="profileDropdown()">
                        <button
                        @click="openDropdown()"
                        class="text-xl text-gray-400 hover:text-blue-700 uppercase font-semibold w-full"
                        >
                            <?= $_SESSION["profile"]["IME"] . " " . $_SESSION["profile"]["PRIIMEK"] ?>
                        </button>
                        <div id="profile-dropdown-menu" x-show="show" class="absolute top-7 right-5 bg-white shadow-lg p-2 z-50" @click.away="closeDropdown()">
                            <ul class="flex flex-col">
                                <li class="p-6 text-lg font-bold hover:bg-blue-700 hover:text-white cursor-pointer uppercase">
                                    <a href="<?= BASE_URL . "profile" ?>">Moj profil</a>
                                </li>
                                <?php if (isset($_SESSION["profile"]["ID_ZAPOSLENI"])): ?>
                                <li class="p-6 text-lg font-bold hover:bg-blue-700 hover:text-white cursor-pointer uppercase">
                                    <a href="<?= BASE_URL . "dashboard" ?>">Dashboard</a>
                                </li>
                                <?php endif; ?>
                                <li class="p-6 text-lg font-bold hover:bg-blue-700 hover:text-white cursor-pointer uppercase">
                                    <a href="<?= BASE_URL . "logout" ?>">Izpiši me</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php else: ?>
                    <a 
                    href="<?= BASE_URL . "login" ?>"
                    class="text-xl text-gray-400 hover:text-blue-700 uppercase font-semibold"
                    >
                        Prijava
                    </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <!--  -->
    
    <!-- MENU MOBILE -->
    <div class="lg:hidden flex justify-around pt-3">
        <div id="mobile-logo">
            <h1 class="text-4xl font-extrabold text-white">
                <span class="text-gradient bg-gradient-to-r from-indigo-700 via-blue-500 to-blue-700 px-2 rounded-md">
                    KarantenaFud
                </span>
            </h1>
        </div>
        <div id="mobile-burger" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-8 w-8 text-blue-700 cursor-pointer" onclick="toggleMenu(true)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </div>
        <div 
        id="mobile-menu-overlay"
        class="fixed h-screen w-0 fixed z-10 left-0 top-0 bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 overflow-x-hidden"
        >
            <div 
            id="overlay-content"
            class="relative top-10 w-full text-center mt-10 flex flex-col"
            >   
                <?php if (isset($_SESSION["profile"])): ?>
                <a class="text-white text-2xl uppercase my-2 " href="<?= BASE_URL . "profile" ?>"> <?= $_SESSION["profile"]["IME"] . " " . $_SESSION["profile"]["PRIIMEK"] ?></a>
                <?php else: ?>
                <a class="text-white text-2xl uppercase my-2 " href="<?= BASE_URL . "login" ?>">Prijava</a>
                <?php endif; ?>
                <a class="text-white text-2xl uppercase my-2 " href="#">Košarica</a>
            </div>
            <div class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="absolute top-10 right-10 text-white w-8 h-8" onclick="toggleMenu(false)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </div>
        </div>
    </div>
</nav>