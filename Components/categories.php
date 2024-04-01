<?php
/**
 * @var $categories
 */
?>
<!--<section>
    <div class="mx-auto text-center my-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Categories</h2>
        <a href="/category/create" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-700">Create New
            Category</a>
    </div>
    <div class="cat-wrapper flex justify-around flex-wrap gap-16 w-3/4 mx-auto">
        <?php
/*        if ($categories !== null) {
            foreach ($categories as $result) { */?>
                <div class="category shadow-xl">
                    <a href="">
                        <div style="background-image: url(<?php /*echo $result->image */?>)"
                             class="group img h-64 w-96 bg-cover flex items-end justify-center p-4 rounded-lg">
                            <a href="/category/<?php /*echo $result->id */?>"
                               class="title bg-gray-300 hover:bg-blue-600 hover:text-white text-2xl rounded-md w-3/4 text-center mx-auto group-hover:bg-blue-600 group-hover:text-white"><?php /*echo $result->name */?></a>
                        </div>
                    </a>
                </div>
            <?php /*}
        } else {
            echo "<div>Not Categories found!</div>";
        } */?>
    </div>
</section>-->

<!-- Product List Section: Categories Grid -->
<div class="bg-white dark:bg-gray-900 dark:text-gray-100">
    <div class="mx-auto text-center my-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Categories</h2>
        <a href="/category/create" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-700">Create New
            Category</a>
    </div>
    <div class="container mx-auto px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            <?php
            if (true) {
                foreach ($categories as $result) { ?>
                <a href="/category/<?php echo $result->id ?>" class="group relative block overflow-hidden transition ease-out active:opacity-75 sm:col-span-2 md:col-span-1">
                    <img src="<?php echo $result->image ?>" alt="Product Image" class="transform transition ease-out group-hover:scale-110"/>
                    <div class="absolute inset-0 bg-black bg-opacity-25 transition ease-out group-hover:bg-opacity-0"></div>
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                    <div class="rounded-3xl bg-white bg-opacity-95 px-4 py-3 text-sm font-semibold uppercase tracking-wide transition ease-out group-hover:bg-blue-600 group-hover:text-white dark:border-gray-800 dark:bg-gray-900/90"><?php echo $result->name ?></div>
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
