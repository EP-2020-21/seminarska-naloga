<main class="col-span-3 h-screen overflow-y-auto">
    <div x-show="tab === 'narocila'" id="dashboard-narocila">
        <h1 class="text-4xl text-left uppercase p-4 font-bold">Obdelava naročil</h1>
        <hr />

    </div>

    <div x-show="tab === 'artikli'" id="dashboard-artikli" class="px-3">
        <h1 class="text-4xl text-left uppercase p-4 font-bold">Artikli v ponudbi</h1>
        <hr />
        <table class="table-auto mx-auto w-full">
            <thead class="border-b-4 border-black">
                <tr>
                    <th class="text-xl text-black p-3 text-bold">Artikel</th>
                    <th class="text-xl text-black p-3 text-bold">Opis</th>
                    <th class="text-xl text-black p-3 text-bold">Slika</th>
                    <th class="text-xl text-black p-3 text-bold">Cena</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr class="border-1 border-b h-32 py-5">
                    <td class="text-md text-black p-2"><?=$item["NAZIV_ARTIKEL"]?></td>
                    <td class="text-md text-black p-2"><?=$item["OPIS"]?></td>
                    <td class="text-md text-black p-2"><?=$item["PATH_TO_IMG"]?></td>
                    <td class="text-md text-black p-2"><?=$item["CENA"]?>€</td>
                    <td class="text-md text-black p-2"><a class="bg-yellow-300 p-4 text-black uppercase rounded-md">Uredi</a></td>
                    <td class="text-md text-black p-2"><a class="bg-red-500 p-4 text-white uppercase rounded-md">Izbriši</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

    <div x-show="tab === 'stranke'" id="dashboard-stranke">
        <h1 class="text-4xl text-left uppercase p-4 font-bold">Prijavljene stranke</h1>
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
            <?php foreach ($stranke as $stranka): ?>
                <tr class="border-1 border-b h-32 py-5">
                    <td class="text-md text-black p-2 text-center"><?=$stranka["IME"]?></td>
                    <td class="text-md text-black p-2 text-center"><?=$stranka["PRIIMEK"]?></td>
                    <td class="text-md text-black p-2 text-center"><?=$stranka["EMAIL"]?></td>
                    <td class="text-md text-black p-2 text-center"><?=$stranka["DATUMREGISTRACIJE"]?></td>
                    <td class="text-md text-black p-2 text-center"><a class="bg-yellow-300 p-4 text-black uppercase rounded-md">Uredi</a></td>
                    <td class="text-md text-black p-2 text-center"><a class="bg-red-500 p-4 text-white uppercase rounded-md">Izbriši</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

</main>
