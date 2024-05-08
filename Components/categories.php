<?php
/**
 * @var $categories
 */

use Core\Auth;

?>
<!-- Product List Section: Categories Grid -->
<div class="bg-white dark:bg-gray-900 dark:text-gray-100">
    <div class="mx-auto text-center mt-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Categories</h2>
        <?php if(Auth::authenticated() && Auth::isAdmin()){ ?>
            <div class="mt-16">
                <a href="/category/create" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-700">Create New
                    Category</a>
            </div>
        <?php } ?>
    </div>
    <div class="container mx-auto px-4 py-16 lg:px-8 lg:py-16 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            <?php
            if ($categories !== null) {
                foreach ($categories as $result) { ?>
                <a href="/category/<?= $result->id ?>/<?= $result->slug ?>" class="group relative block overflow-hidden transition ease-out active:opacity-75 sm:col-span-2 md:col-span-1">
                    <img src="<?= $result->image ?>" alt="Product Image" class="object-cover h-full transform transition ease-out group-hover:scale-110"/>
                    <div class="absolute inset-0 bg-black bg-opacity-25 transition ease-out group-hover:bg-opacity-0"></div>
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                    <div class="rounded-3xl bg-white bg-opacity-95 px-4 py-3 text-sm font-semibold uppercase tracking-wide transition ease-out group-hover:bg-blue-600 group-hover:text-white dark:border-gray-800 dark:bg-gray-900/90"><?= $result->name ?></div>
                    </div>
                </a>
                <?php }
            } else {
                echo "<div>Not Categories found!</div>";
            } ?>
        </div>
    </div>
</div>
<!-- END Product List Section: Categories Grid -->
