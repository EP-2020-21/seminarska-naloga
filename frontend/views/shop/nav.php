<nav class="w-full py-2 flex justify-around container mx-auto bg-white">
    <!-- LOGO || RIGHT SIDE -->
    <div 
        id="nav_left"
        class="w-full flex justify-start items-center"
    >
        <h1 class="text-4xl text-blue-700 font-bold uppercase font-mono">Fake Amazon</h1>
    </div>
    <!-- LINKS || USER PROFILE || LEFT SIDE -->
    <div 
    id="nav_right"
    class="w-full flex justify-end pr-4"
    >
        <form
        method="POST"
        action="/searchProducts" 
        class="flex items-center mx-2 w-full justify-end"
        >
            <input 
                type="text" 
                placeholder="Poišči v trgovini"
                class="rounded-md shadow-md px-2 py-1 focus:ring-blue-700 w-1/2" 
            />
        </form>
        <ul class="flex">
            <li class="px-2 flex items-center mx-2">
                <a 
                href="/checkout"
                class="text-xl text-gray-400 hover:text-blue-700 uppercase"
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-400 hover:text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                </a>
            </li>
            <li class="px-2 flex items-center mx-2">
                <a 
                href="<?= BASE_URL . "login" ?>"
                class="text-xl text-gray-400 hover:text-blue-700 uppercase font-semibold"
                >
                    Prijava
                </a>
            </li>
        </ul>
    </div>
</nav>