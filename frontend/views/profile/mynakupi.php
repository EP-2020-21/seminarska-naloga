<?php if (isset($nakupi)): ?>
<table class="table-auto mx-auto w-full text-center">
    <thead class="border-b-4 border-black">
    <tr>
        <th class="text-xl text-black p-3 text-bold">Artikli</th>
        <th class="text-xl text-black p-3 text-bold">Status</th>
        <th class="text-xl text-black p-3 text-bold">Cena</th>
        <th class="text-xl text-black p-3 text-bold">Čas naročila</th>
        <th class="text-xl text-black p-3 text-bold">Čas spremembe</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($nakupi as $nakup): ?>
        <tr class="border-1 border-b h-32 py-5">
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
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h1 class="text-center text-lg text-bold p-4 sm:p-6">V trgovini lahko trenutno kupujejo samo stranke!</h1>
<?php endif; ?>