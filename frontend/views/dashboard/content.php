<main class="col-span-4 h-screen overflow-y-auto">
    <div x-show="tab === 'narocila'" id="dashboard-narocila">
        <h1 class="text-4xl text-left uppercase p-4 font-bold">Obdelava naročil</h1>
        <hr />

    </div>

    <div x-show="tab === 'artikli'" id="dashboard-artikli" class="px-3">
        <div class="flex justify-between">
            <h1 class="text-4xl text-left uppercase p-4 font-bold">Artikli v ponudbi</h1>
            <div class="flex justify-center items-center mr-3">
                <a class="bg-green-600 p-4 text-white uppercase rounded-md hover:bg-green-500 cursor-pointer">Dodaj</a>
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
            <div class="flex justify-center items-center mr-3">
                <a class="bg-green-600 p-4 text-white uppercase rounded-md hover:bg-green-500 cursor-pointer">Dodaj</a>
            </div>
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
                        <button @click="console.log(stranka.ID_STRANKA)" class="bg-yellow-300 p-4 text-black uppercase rounded-md">
                            Uredi
                        </button>
                    </td>
                    <td class="text-md text-black p-2 text-center">
                        <button @click="console.log(stranka.ID_STRANKA)" class="bg-red-500 p-4 text-white uppercase rounded-md">
                            Izbriši
                        </button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
        <div class="h-32"></div>
    </div>

</main>
