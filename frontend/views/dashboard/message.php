<?php
if(isset($message)): ?>
            <div class="bg-green-500 p-4 text-white font-bold rounded-md max-w-12 fixed top-0 right-0 z-100 my-2" x-data="message()" x-show="show">
                <?= $message ?>
                <button class="text-white absolute p-1 right-1 top-0 font-bold close uppercase" @click="close()">x</button>
            </div>
<?php endif; ?>
