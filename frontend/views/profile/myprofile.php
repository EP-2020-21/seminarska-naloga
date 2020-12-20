<div class="flex sm:justify-between sm:flex-row flex-col flex-wrap justify-start items-center border-b-2 border-black p-4">
    <h1 class="text-4xl text-bold p-2">
        <?= $profile["IME"] . " " . $profile["PRIIMEK"]  ?>
    </h1>
    <h2 class="text-2xl text-bold p-2">
        <?php
        if (isset($profile["ID_STRANKA"])) {
            $profileIsStranka = true;
            echo "Stranka";
        } else {
            $profileIsStranka = false;
            if ($profile["ADMIN"]){
                echo "Admin";
            } else {
                echo "Prodajalec";
            }
        } ?>
    </h2>
</div>
<div id="profile-form" x-data="form()">
    <div class="w-full flex justify-start p-4">
        <button @click="toggleForm()" class="p-4 bg-yellow-300 m-2" x-text="btn"></button>
    </div>
    <form method="POST" action="<?= BASE_URL . "profile/edit" ?>">
        <div class="flex flex-col w-full mx-auto">
            <?php if ($profileIsStranka): ?>
                <input hidden
                       type="number"
                       name="id_stranka"
                       value="<?= $profile["ID_STRANKA"]?>"
                />
            <?php else: ?>
                <input hidden
                       type="number"
                       name="id_zaposleni"
                       value="<?= $profile["ID_ZAPOSLENI"]?>"
                />
            <?php endif; ?>

            <label class="py-1 text-2xl">Ime:</label>
            <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500
                        focus:border-blue-500 font-lg
                    mb-6"
                   type="text"  name="ime" value="<?= $profile["IME"] ?>" required />

            <label class="py-1 text-2xl">Priimek:</label>
            <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                   type="text"  name="priimek" value="<?= $profile["PRIIMEK"] ?>" required/>

            <label class="py-1 text-2xl">Email:</label>
            <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                   type="text"  name="email" value="<?= $profile["EMAIL"] ?>" required/>

            <label class="py-1 text-2xl">Staro geslo:</label>
            <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                   type="password"  name="staro_geslo" required />

            <label class="py-1 text-2xl">Novo geslo:</label>
            <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full  sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                   type="password"  name="novo_geslo" required />

            <?php if ($profileIsStranka): ?>
                <label class="py-1 text-2xl">Ulica:</label>
                <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full  sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                       type="text"  name="ulica" value="<?= $naslov["ULICA"] ?>" required />

                <label class="py-1 text-2xl">Hišna številka:</label>
                <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full  sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                       type="text"  name="hisna_stevilka" value="<?= $naslov["HISNA_STEVILKA"] ?>" required/>

                <label class="py-1 text-2xl">Poštna številka:</label>
                <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full  sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                       type="text"  name="postna_stevilka" value="<?= $kraj["POSTNA_STEVILKA"] ?>" required/>

                <label class="py-1 text-2xl">Kraj:</label>
                <input x-bind:disabled="disabled" class="ml-2 px-2 py-5 font-sans w-full sm:w-3/4 border-blue-700 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-lg mb-6"
                       type="text"  name="kraj" value="<?= $kraj["KRAJ"] ?>" required/>
            <?php endif; ?>

            <input x-bind:disabled="disabled" type="submit" value="posodobi" class="px-1 py-2 font-sans w-full w-3/4 bg-blue-700 text-white font-bold text-2xl
                    cursor-pointer transform duration-100
                    hover:bg-blue-500 uppercase" />
        </div>
    </form>
    <hr>
    <h1 class="text-2xl text-bold p-2 mt-4">Izbris računa!</h1>
    <div class="w-full flex justify-start items-center">
        <form method="post">
            <label class="text-lg text-bold p-2">Ali res želite izbrisati račun?</label> <input type="checkbox" required />
            <input type="submit" value="izbriši račun" class="p-4 bg-red-500 text-bold m-2 text-lg rounded-md text-white hover:bg-red-600 cursor-pointer"/>
        </form>
    </div>
</div>
