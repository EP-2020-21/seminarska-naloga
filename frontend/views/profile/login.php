<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= CSS_URL . "tailwind.css" ?>">
</head>
    <body class="bg-gradient-to-r from-indigo-400 via-blue-500 to-blue-700">
    <div class="container shadow-lg mx-auto max-w-4xl mt-40 sm:p-5 rounded-md bg-white">
    <?php if(isset($error)): ?>
            <div class="bg-red-500 p-4 text-white font-bold rounded-md max-w-12 relative my-2">
                Napaka pri prijavi. Poiskusite ponovno!
                <button class="text-white absolute p-1 right-1 top-0 font-bold close uppercase">x</button>
            </div>
    <?php endif; ?>
        <h1 class="text-2xl ml-2 sm:text-4xl font-semibold mb-2 text-center uppercase">Login</h1>
        <hr/>
<!-- FORM -->
        <div class="flex justify-between md:flex-row flex-col-reverse sm:py-3">
            <div class="flex justify-center items-center w-full md:w-1/2">
                <img class="h-auto md:w-full w-3/4 p-2" src="<?= CSS_URL . "/images/login.svg" ?>" />
            </div>
            <div class="w-full md:ml-2">
            <form method="POST" action="<?= BASE_URL . "login" ?>">
                <div class="flex px-1 py-2 sm:p-3 mx-1 mb-1 border-gray-200 b-2">
                    <label class="px-1 sm:px-2 py-1 text-lg">Email:</label>
                    <input 
                        name="email" 
                        placeholder="janez@gmail.com" 
                        autocomplete="off" type="email" 
                        class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="<?= $data["email"] ?>"
                    />
                </div>
                <div class="flex px-1 py-2 sm:p-3 mx-1">
                    <label class="px-1 sm:px-2 py-1 text-lg">Geslo:</label>
                    <input 
                        name="geslo" 
                        type="password" 
                        placeholder="Vpiši geslo" 
                        class="ml-2 px-2 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div class="flex px-1 py-2 sm:p-3 mx-1">
                    <input 
                        type="submit" 
                        value="Login" 
                        class="ml-2 px-2 py-2 font-sans w-full bg-blue-700 text-white font-bold text-2xl cursor-pointer transform duration-100 sm:hover:scale-105 uppercase"
                    />
                </div>
            </form>

            <!-- REDIRECT -->
            <div class="flex justify-evenly w-full px-2">
                <div>
                    <span>Ne želim se prijaviti - </span>
                    <a href="<?= BASE_URL . "" ?>" class="text-blue-500 underline uppercase cursor-pointer font-semibold">
                        domov
                    </a>
                </div>
                <div>
                    <span>Nimam še računa - </span>
                    <a href="<?= BASE_URL . "register" ?>" class="text-blue-500 underline uppercase cursor-pointer font-semibold">
                        Registracija
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.close', function () {
            $(this).parent('div').fadeOut();
        });
    </script>
    </body>
</html>