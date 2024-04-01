<?php
include root_path('Components/navbar.php');
?>

    <div class="w-2/5 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm mx-auto my-16">
        <div class="p-3">
            <div class="flex items-center justify-between mb-2">
                <a href="#">
                    <img class="w-10 h-10 rounded-full" src="" alt="<?php echo $user->first_name  . ' ' . $user->last_name ?>">
                </a>
                <div>
                    <a href="#" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                </div>
            </div>
            <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                <h1 class="text-black capitalize"><?php echo $user->first_name  . ' ' . $user->last_name ?></h1>
            </p>
            <p class="mb-3 text-sm font-normal">
                @<?php echo $user->username ?>
            </p>
            <p class="mb-4 text-sm inline">User type: <h2 class="inline text-slate-900 capitalize font-bold"><?php echo $user->role ?></h2>.</p>
            <p class="mb-4 text-sm inline">Address: <h2 class="inline text-slate-900 capitalize font-bold"><?php echo $user->address ?></h2>.</p>
            <ul class="flex text-sm">
                <li class="me-2">
                    <a href="mailto:<?php echo $user->email ?>" class="hover:underline">
                        <span>Email: </span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo $user->email ?></span>
                    </a>
                </li>
                <li>
                    <a href="tel:<?php echo $user->phone_number ?>" class="hover:underline">
                        <span>Phone Number: </span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo $user->phone_number ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <div data-popper-arrow></div>
    </div>

<?php include(root_path('Components/footer.php')) ?>