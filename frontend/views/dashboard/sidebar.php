<aside id="dashboard-sidemenu" class="h-screen col-span-1 py-2 flex flex-col justify-start border-r-2 border-black">
    <button @click="changeTab('narocila')" :class="{ underline : tab === 'narocila' }" class="w-full my-1 px-2 py-4 cursor-pointer hover:bg-blue-700 hover:text-white
    uppercase">Obdelava naročil</button>
    <button @click="changeTab('artikli')" :class="{ underline : tab === 'artikli' }" class="w-full my-1 px-2 py-4 cursor-pointer hover:bg-blue-700 hover:text-white
    uppercase">Artikli</>
    <button @click="changeTab('stranke')" :class="{ underline : tab === 'stranke' }" class="w-full my-1 px-2 py-4 cursor-pointer
    hover:bg-blue-700 hover:text-white
    uppercase">Stranke</button>
    <?php if ($_SESSION["profile"]["ADMIN"]): ?>
    <button @click="changeTab('zaposleni')" :class="{ underline : tab === 'zaposleni' }" class="w-full my-1 px-2 py-4 cursor-pointer
    hover:bg-blue-700 hover:text-white
    uppercase">Zaposleni</button>
    <?php endif; ?>
</aside>
