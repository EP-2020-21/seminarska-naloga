<main id="profile-content">

    <section x-show="tab === 'Moj profil'" id="profile-info" class="container mx-auto">
        <?php include "myprofile.php" ?>
    </section>

    <section x-show="tab === 'Nakupi'" id="profile-purchases" class="container mx-auto">
        <?php include "mynakupi.php" ?>
    </section>
</main>
