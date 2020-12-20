<nav class="w-full py-4 px-2 bg-blue-700 flex justify-between text-white h-1/6">
    <div class="flex items-center justify-center">
        <h1 class="text-6xl font-extrabold text-white select-none">
            <span class="bg-clip-text text-transparent bg-white px-2 rounded-md">
                Dashboard
            </span>
        </h1>
        <?php if ($_SESSION["profile"]["ADMIN"]): ?>
            <h2 class="px-2 py-1 text-xl text-2xl">Role: Admin</h2>
        <?php else: ?>
            <h2 class="px-2 py-1 text-xl text-2xl">Role: Prodajalec</h2>
        <?php endif; ?>
    </div>
    <div class="flex items-center justify-center">
        <ul class="flex justify-end items-center">
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer"><a href="<?= BASE_URL . "" ?>">V trgovino</a></li>
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer"><a href="<?= BASE_URL . "dashboard" ?>">Dashboard</a></li>
            <li class="px-2 py-1 text-xl hover:underline cursor-pointer">Moj profil</li>
        </ul>
    </div>
</nav>