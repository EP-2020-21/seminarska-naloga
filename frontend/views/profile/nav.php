<nav class="w-full py-4 px-2 bg-blue-700 flex sm:flex-row flex-col sm:justify-between text-white h-1/6">
    <div class="flex items-center justify-center">
        <h1 class="text-6xl font-extrabold text-white select-none">
            <span class="bg-clip-text text-transparent bg-white px-2 rounded-md" x-text="tab"></span>
        </h1>
    </div>
    <div class="flex items-center justify-center flex-wrap">
        <ul class="flex justify-end items-center flex-wrap">
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer" @click="changeTab('Moj profil')">Moj profil</li>
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer" @click="changeTab('Nakupi')">Nakupi</li>
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer"><a href="<?= BASE_URL . "" ?>">V trgovino</a></li>
        </ul>
    </div>
</nav>
