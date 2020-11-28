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
                        class="ml-2 px-2 py-1 rounded-md font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div class="flex px-1 py-2 sm:p-3 mx-1">
                    <label class="px-1 sm:px-2 py-1 text-lg">Geslo:</label>
                    <input 
                        name="geslo" 
                        type="password" 
                        placeholder="Vpiši geslo" 
                        class="ml-2 px-2 py-1 rounded-md font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div class="flex px-1 py-2 sm:p-3 mx-1">
                    <input 
                        type="submit" 
                        value="Login" 
                        class="ml-2 px-2 py-2 rounded-md font-sans w-full bg-blue-700 text-white font-bold text-2xl cursor-pointer transform duration-100 sm:hover:scale-105 uppercase"
                    />
                </div>
            </form>
            <a href="<?= BASE_URL . "register" ?>"> Ustvari račun </a>
            </div>

        </div>
    </div>
    </body>
</html>