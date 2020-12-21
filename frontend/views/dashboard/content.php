<main class="col-span-4 h-screen overflow-y-auto">
    <div x-show="tab === 'narocila'" id="dashboard-narocila">
        <h1 class="text-4xl text-left uppercase p-4 font-bold">Obdelava naročil</h1>
        <hr />
        <table class="table-auto mx-auto w-full text-center">
            <thead class="border-b-4 border-black">
            <tr>
                <th class="text-xl text-black p-3 text-bold">ID nakup</th>
                <th class="text-xl text-black p-3 text-bold">Stranka </th>
                <th class="text-xl text-black p-3 text-bold">Artikli</th>
                <th class="text-xl text-black p-3 text-bold">Status</th>
                <th class="text-xl text-black p-3 text-bold">Cena</th>
                <th class="text-xl text-black p-3 text-bold">Čas naročila</th>
                <th class="text-xl text-black p-3 text-bold">Čas spremembe</th>
                <th class="text-xl text-black p-3 text-bold">Akcije</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($nakupi as $nakup): ?>
                <tr class="border-1 border-b h-32 py-5">
                    <td class="text-md text-black p-2"><?= $nakup["IDNAKUPA"] ?></td>
                    <td class="text-md text-black p-2"><?= $nakup["IME"] . " " . $nakup["PRIIMEK"] ?></td>
                    <td class="text-md text-black p-2">
                        <ul>
                            <?php
                            include_once "backend/model/ShopModel.php";
                            $artikli = ShopModel::getArtikliByNakup($nakup["IDNAKUPA"]);
                            foreach ($artikli as $artikel): ?>
                                <li><?=$artikel["NAZIV_ARTIKEL"]. " " . $artikel["KOLICINA"]."x"?> </li><br/>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td class="text-md text-black p-2">
                        <?php if($nakup["ID_STATUS"] == 1){
                            echo "Oddano naročilo";
                        }   else if ($nakup["ID_STATUS"] == 2){
                            echo "Potrjeno";
                        } else if ($nakup["ID_STATUS"] == 3) {
                            echo "Stornirano";
                        } else if ($nakup["ID_STATUS"] == 4){
                            echo "Preklicano";
                        } else {
                            echo "Zaključeno";
                        }
                        ?></td>
                    <td class="text-md text-black p-2"><?= $nakup["SKUPNA_CENA"] ?></td>
                    <td class="text-md text-black p-2"><?= $nakup["DATUMCAS_NAROCILA"] ?></td>
                    <td class="text-md text-black p-2"><?= $nakup["DATUMCAS_SPREMEMBE"] ?></td>
                    <td class="text-md text-black p-2">
                        <?php
                            if($nakup["ID_STATUS"] == 1):
                        ?>
                        <div class="flex justify-evenly items-center">
                            <form action="<?= BASE_URL . "api/confirmNakup"?>" method="POST">
                                <input hidden name="id" value="<?= $nakup["IDNAKUPA"] ?>"  />
                                <input type="submit" class="p-2 bg-green-700 text-white text-bold mx-2 cursor-pointer" value="Potrdi" />
                            </form>
                            <form action="<?= BASE_URL . "api/declineNakup" ?>" method="POST">
                                <input hidden name="id" value="<?= $nakup["IDNAKUPA"] ?>"  />
                                <input type="submit" class="p-2 bg-red-500 text-white text-bold mx-2 cursor-pointer" value="Prekliči" />
                            </form>
                        </div>
                        <?php elseif ($nakup["ID_STATUS"] == 2):?>
                            <div class="flex justify-evenly items-center">
                                <form action="<?= BASE_URL . "api/purgeNakup" ?>" method="POST">
                                    <input hidden name="id" value="<?= $nakup["IDNAKUPA"] ?>"  />
                                    <input type="submit" class="p-2 bg-red-500 text-white text-bold mx-2 cursor-pointer" value="Storniraj" />
                                </form>
                                <form action="<?= BASE_URL . "api/concludeNakup" ?>" method="POST">
                                    <input hidden name="id" value="<?= $nakup["IDNAKUPA"] ?>"  />
                                    <input type="submit" class="p-2 bg-green-700 text-white text-bold mx-2 cursor-pointer" value="Zaključi" />
                                </form>
                            </div>
                        <?php else: ?>
                        <p class="p-2 text-black text-bold mx-2">/</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

    <div x-show="tab === 'artikli'" id="dashboard-artikli" class="px-3">
        <div class="flex justify-between">
            <h1 class="text-4xl text-left uppercase p-4 font-bold">Artikli v ponudbi</h1>
            <div class="flex justify-center items-center mr-3">
                <a href="<?= BASE_URL . "dashboard/addItem" ?>" class="bg-green-600 p-4 text-white uppercase rounded-md hover:bg-green-500 cursor-pointer">
                    Dodaj
                </a>
            </div>
        </div>
        <hr />
        <table class="table-auto mx-auto w-full">
            <thead class="border-b-4 border-black">
                <tr>
                    <th class="text-xl text-black p-3 text-bold">Artikel</th>
                    <th class="text-xl text-black p-3 text-bold">Opis</th>
                    <th class="text-xl text-black p-3 text-bold">Cena</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in items" :key="item.ID_ARTIKEL">
                    <tr class="border-1 border-b h-32 py-5">
                        <td class="text-md text-black p-2" x-text="item.NAZIV_ARTIKEL"></td>
                        <td class="text-md text-black p-2" x-text="item.OPIS"></td>
                        <td class="text-md text-black p-2" x-text="item.CENA"></td>
                        <td class="text-md text-black p-2">
                            <button @click="console.log(item.ID_ARTIKEL)" class="bg-yellow-300 p-4 text-black uppercase rounded-md">
                                Uredi
                            </button>
                        </td>
                        <td class="text-md text-black p-2">
                            <button @click="console.log(item.ID_ARTIKEL)" class="bg-red-500 p-4 text-white uppercase rounded-md">
                                Izbriši
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

    <div x-show="tab === 'stranke'" id="dashboard-stranke">
        <div class="flex justify-between">
            <h1 class="text-4xl text-left uppercase p-4 font-bold">Prijavljene stranke</h1>
        </div>
        <hr />
        <table class="table-auto mx-auto w-full">
            <thead class="border-b-4 border-black">
            <tr>
                <th class="text-xl text-black p-3 text-bold text-center">Ime</th>
                <th class="text-xl text-black p-3 text-bold text-center">Priimek</th>
                <th class="text-xl text-black p-3 text-bold text-center">Email</th>
                <th class="text-xl text-black p-3 text-bold text-center">Datum registracije</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <template x-for="stranka in stranke" :key="stranka.ID_STRANKA">
                <tr class="border-1 border-b h-32 py-5">
                    <td class="text-md text-black p-2 text-center" x-text="stranka.IME"></td>
                    <td class="text-md text-black p-2 text-center" x-text="stranka.PRIIMEK"></td>
                    <td class="text-md text-black p-2 text-center" x-text="stranka.EMAIL"></td>
                    <td class="text-md text-black p-2 text-center" x-text="stranka.DATUMREGISTRACIJE"></td>
                    <td class="text-md text-black p-2 text-center">
                    <template x-if = "!stranka.IZBRISAN">
                        <td class="text-md text-black p-2 text-center">
                            <button @click="activateUser(stranka.ID_STRANKA)" class="bg-green-500 p-4 text-white uppercase rounded-md">Aktiviraj</button>
                        </td>
                    </template>
                    <template x-if = "stranka.IZBRISAN">
                        <td class="text-md text-black p-2 text-center">
                            <button @click="deactivateUser(stranka.ID_STRANKA)" class="bg-red-500 p-4 text-white uppercase rounded-md">Deaktiviraj</button>
                        </td>
                    </template>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

    <div x-show="tab === 'zaposleni'" id="dashboard-zaposleni">
        <div class="flex justify-between">
            <h1 class="text-4xl text-left uppercase p-4 font-bold">Zaposleni</h1>
        </div>
        <hr />
        <table class="table-auto mx-auto w-full">
            <thead class="border-b-4 border-black">
            <tr>
                <th class="text-xl text-black p-3 text-bold text-center">Ime</th>
                <th class="text-xl text-black p-3 text-bold text-center">Priimek</th>
                <th class="text-xl text-black p-3 text-bold text-center">Email</th>
                <th class="text-xl text-black p-3 text-bold text-center">Admin</th>
                <th class="text-xl text-black p-3 text-bold text-center">Izbrisan</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <template x-for="zaposlen in zaposleni" :key="zaposlen.ID_ZAPOSLENI">
                <tr class="border-1 border-b h-32 py-5">
                    <td class="text-md text-black p-2 text-center" x-text="zaposlen.IME"></td>
                    <td class="text-md text-black p-2 text-center" x-text="zaposlen.PRIIMEK"></td>
                    <td class="text-md text-black p-2 text-center" x-text="zaposlen.EMAIL"></td>
                    <td class="text-md text-black p-2 text-center" x-text="zaposlen.ADMIN"></td>
                    <td class="text-md text-black p-2 text-center" x-text="zaposlen.IZBRISAN"></td>
                    <template x-if = "!zaposlen.IZBRISAN">
                        <td class="text-md text-black p-2 text-center">
                            <button @click="activateZap(zaposlen.ID_ZAPOSLENI)" class="bg-green-500 p-4 text-white uppercase rounded-md">Aktiviraj</button>
                        </td>
                    </template>
                    <template x-if = "zaposlen.IZBRISAN">
                        <td class="text-md text-black p-2 text-center">
                            <button @click="deactivateZap(zaposlen.ID_ZAPOSLENI)" class="bg-red-500 p-4 text-white uppercase rounded-md">Deaktiviraj</button>
                        </td>
                    </template>
                </tr>
            </template>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

</main>
