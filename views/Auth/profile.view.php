<?php

use Core\Auth;
use Core\Errors;

include root_path('Components/navbar.php');
?>

    <div class="w-2/5 text-lg text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm mx-auto my-16">
        <div class="p-3">
            <div class="flex items-center justify-between mb-2">
                <a href="#">
                    <img class="w-10 h-10 rounded-full object-cover" src="<?= Auth::query('profile_picture') ?>" alt="<?= Auth::query("first_name").' '.Auth::query("last_name") ?>">
                </a>
                <div>
                    <button onclick="toggleDrawer()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                    <?php if(Auth::isAdmin()): ?>
                    <a href="/dashboard" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Dashboard</a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                <h1 class="text-black capitalize"><?= Auth::query("first_name").' '.Auth::query("last_name") ?></h1>
            </p>
            <p class="mb-3 text-sm font-normal">
                @<?= Auth::query("username") ?>
            </p>
            <p class="mb-4 text-sm inline">User type: <h2 class="inline text-slate-900 capitalize font-bold"><?= Auth::query("role") ?></h2>.</p>
            <p class="mb-4 text-sm inline">Address: <h2 class="inline text-slate-900 capitalize font-bold"><?= Auth::query("address") ?></h2>.</p>
            <ul class="flex text-sm">
                <li class="me-2">
                    <a href="mailto:<?= Auth::query("email") ?>" class="hover:underline">
                        <span>Email: </span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?= Auth::query("email") ?></span>
                    </a>
                </li>
                <li>
                    <a href="tel:<?= Auth::query("phone_number") ?>" class="hover:underline">
                        <span>Phone Number: </span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?= Auth::query("phone_number") ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <div data-popper-arrow></div>
    </div>

    <!-- drawer component -->
    <div id="drawer-update" class="fixed top-0 left-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Update <?= Auth::query("username") ?></h5>
        <button type="button" data-drawer-dismiss="drawer-update-product-default" onclick="toggleDrawer()" aria-controls="drawer-update-product-default" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form action="/profile/<?= Auth::query('id') ?>/<?= Auth::query('username') ?>" method="POST" enctype="multipart/form-data">
            <div class="space-y-4">
                <div>
                    <h5 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Picture</h5>
                    <div class="flex justify-between items-center">
                        <img src="<?= Auth::query('profile_picture') ?>" alt="" class="object-cover rounded-full h-16 w-16">
                        <div>
                            <label class="mt-2 bg-slate-600 text-gray-200 rounded-md px-4 py-2 cursor-pointer hover:bg-slate-700 hover:text-white" for="profile_picture"><i class="fa-solid fa-cloud-arrow-up"></i> New Picture</label>
                            <input type="file" name="new_profile_picture" id="profile_picture" class="hidden">
                            <input type="hidden" name="profile_picture" value="<?= Auth::query('profile_picture') ?>">
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= Auth::query("first_name") ?>">
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= Auth::query("last_name") ?>">
                    </div>
                </div>
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= Auth::query("username") ?>">
                    <div class="text-red-500"><?= Errors::get('username') ?></div>
                </div>
                <div>
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                    <input type="number" id="phone_number" name="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= Auth::query("phone_number") ?>">
                </div>
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected="<?= Auth::query("role") ?>"><?= Auth::query("role") ?></option>
                        <?php if(Auth::query("role") === "admin"){ ?>
                            <option value="member">member</option>
                        <?php } elseif (Auth::query("role") === "member"){ ?>
                            <option value="admin">admin</option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <textarea name="address" id="address" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= Auth::query("address") ?></textarea>
                </div>
                <input type="hidden" name="id" value="<?= Auth::query("id") ?>">
            </div>
            <div class="bottom-0 left-0 flex justify-center w-full pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
                <button type="submit" name="update-user" class="w-full justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update
                </button>
                <button type="button" class="w-full justify-center text-slate-600 inline-flex items-center hover:text-white border border-slate-600 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-slate-500 dark:text-slate-500 dark:hover:text-white dark:hover:bg-slate-600 dark:focus:ring-slate-900">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <script>
        let drawer = document.getElementById("drawer-update");
        function toggleDrawer() {
            drawer.classList.toggle("-translate-x-full");
        }
    </script>

<?php
include(root_path('Components/footer.php'));
unset($_SESSION["errors"]);
?>