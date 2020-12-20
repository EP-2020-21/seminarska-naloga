<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= CSS_URL . "tailwind.css" ?>">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
    <body class="bg-gradient-to-r from-indigo-400 via-blue-500 to-blue-700">
    <div class="container shadow-lg mx-auto max-w-xl sm:mt-5 sm:mt-10 sm:p-5 sm:rounded-md bg-white pb-5">
        <?php if(isset($error)): ?>
            <div class="bg-red-500 p-4 text-white font-bold rounded-md max-w-12 relative my-2" x-data="error()" x-show="show">
                Napaka pri registraciji. Poiskusite ponovno!
                <button class="text-white absolute p-1 right-1 top-0 font-bold close uppercase" :click="close()">x</button>
            </div>
        <?php endif; ?>
        <h1 class="text-2xl ml-2 sm:text-4xl font-semibold mb-2 text-center uppercase">Register</h1>
        <hr/>
        <!-- FORM -->
            <form method="POST" action="<?= BASE_URL . "register" ?>" autocomplete="off">

            <!-- PODATKI O RAČUNU -->
                <div class="mt-1">
                    <h2 class="text-lg font-semibold ml-2">Podatki o računu</h2>
                    <div class="flex px-1 py-2 sm:p-3 mx-1 mb-1 flex-col">
                        <label class="px-1 py-1 text-lg">Email:</label>
                        <input 
                            name="email" 
                            placeholder="janez@gmail.com" 
                            type="email"
                            required 
                            class="px-1 py-1 font-sans border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col w-full"
                            value="<?= $data["email"] ?>"
                        />
                    </div>

                    <!-- Gesla -->
                    <div class="flex sm:flex-row flex-col">
                        <div class="flex px-1 py-2 sm:p-3 mx-1 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">Geslo:</label>
                            <input
                                id="geslo"
                                name="geslo" 
                                type="password"
                                required 
                                placeholder="Vpiši geslo" 
                                class="px-1 py-1 font-sans border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 w-full"
                            />
                        </div>
                        <div class="flex px-1 py-2 sm:p-3 mx-1 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">Ponovi geslo:</label>
                            <input 
                                id="checkGeslo"
                                name="potrdi_geslo" 
                                type="password"
                                required 
                                placeholder="Ponovi geslo" 
                                class="px-1 py-1 font-sans border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 w-full"
                            />
                        </div>
                    </div>
                    <!--  -->

                </div>
            <!--  -->

            <!-- Osebni podatki -->
                <div>
                    <h2 class="text-lg font-semibold ml-2">Osebni podatki</h2>

                    <!-- IME in PRIIMEK -->
                    <div class="flex sm:flex-row flex-col">
                        <div class="flex px-1 py-2 sm:p-3 mx-1 mb-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Ime:
                            </label>
                            <input 
                                name="ime" 
                                placeholder="Janez"
                                required 
                                type="text" 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["ime"] ?>"
                            />
                        </div>
                        <div class="flex px-1 py-2 sm:p-3 mx-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Priimek:
                            </label>
                            <input
                                name="priimek" 
                                placeholder="Novak"
                                required 
                                type="text" 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["priimek"] ?>"
                            />
                        </div>
                    </div>

                    <!-- ULICA in HIŠNA ŠT -->
                    <div class="flex sm:flex-row flex-col">
                        <div class="flex px-1 py-2 sm:p-3 mx-1 mb-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Ulica:
                            </label>
                            <input 
                                name="ulica" 
                                placeholder="Ulica ali naslov" 
                                type="text"
                                required 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["ulica"] ?>"
                            />
                        </div>
                        <div class="flex px-1 py-2 sm:p-3 mx-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Hišna številka:
                            </label>
                            <input 
                                name="hisna_stevilka" 
                                placeholder="12a" 
                                type="text"
                                required 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["hisna_stevilka"] ?>"
                            />
                        </div>
                    </div>
                    <!-- POŠTNA ŠT IN KRAJ -->
                    <div class="flex sm:flex-row flex-col">
                        <div class="flex px-1 py-2 sm:p-3 mx-1 mb-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Poštna številka:
                            </label>
                            <input 
                                name="postna_stevilka" 
                                placeholder="Številka poštnega predala" 
                                type="text"
                                required 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["postna_stevilka"] ?>"
                            />
                        </div>
                        <div class="flex px-1 py-2 sm:p-3 mx-1 border-gray-200 b-2 flex-col sm:w-1/2">
                            <label class="px-1 py-1 text-lg">
                                Kraj:
                            </label>
                            <input 
                                name="kraj" 
                                placeholder="Kraj bivanja" 
                                type="text"
                                required 
                                class="px-1 py-1 font-sans w-full border-blue-100 border-b-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-col"
                                value="<?= $data["kraj"] ?>"
                            />
                        </div>
                    </div>
                    <!-- CAPTCHA -->
                    <style>
                    /* already defined in bootstrap4 */
                        .text-xs-center {
                            text-align: center;
                        }

                        .g-recaptcha {
                            display: inline-block;
                        }
                    </style>
                    <div class="text-xs-center">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div>                    
                    <!-- Submit button -->
                <div class="flex px-1 py-2 sm:p-3 mx-1">
                    <input 
                        type="submit" 
                        value="Register" 
                        class="px-1 py-2 font-sans w-full bg-blue-700 text-white font-bold text-2xl cursor-pointer transform duration-100 sm:hover:scale-105 uppercase"
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
                        <span>Račun že imam - </span>
                        <a href="<?= BASE_URL . "login" ?>" class="text-blue-500 underline uppercase cursor-pointer font-semibold">
                            prijava
                        </a>
                    </div>
                </div>
            </div>
        <script>
        const error = () => {
            return {
                show: true,
                close () {
                    this.show = false;
                }
            } 
        }
        </script>
    </body>
</html>