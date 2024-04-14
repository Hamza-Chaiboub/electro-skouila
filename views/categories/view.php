<?php
require_once __DIR__ . '/../../Controllers/CategoryController.php';

    /**
     * @var $category
     */
$products = Product::findAllBy(["category_id" => $category->id]);

include_once __DIR__ . '/../../Components/navbar.php';
?>

<section class="relative flex items-center w-full bg-white">
    <div class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
        <div class="relative flex-col items-start m-auto align-middle">
            <?php if($category) { ?>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-24">
                <div class="relative items-center gap-12 m-auto lg:inline-flex">
                    <div class="max-w-xl text-center lg:text-left">
                        <div>

                            <p class="text-2xl font-medium tracking-tight text-black sm:text-4xl">
                                <?php echo $category->name ?>
                            </p>
                            <p class="max-w-xl mt-4 text-base tracking-tight text-gray-600">
                                <?php echo $category->description ?>
                            </p>
                        </div>
                        <div class="flex justify-center gap-3 mt-10 lg:justify-start">
                            <a class="inline-flex items-center justify-center text-sm font-semibold text-black duration-200 hover:text-blue-500 focus:outline-none focus-visible:outline-gray-600" href="/products/<?= $category->id ?>">
                                <span> View products   → </span>
                            </a>
                            <?php if(Auth::authenticated() && Auth::isAdmin()){ ?>
                            <a class="inline-flex items-center justify-center text-sm font-semibold text-black duration-200 hover:text-blue-500 focus:outline-none focus-visible:outline-gray-600" href="/category/edit/<?php echo $category->id ?>">
                                Edit
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="order-first block w-full mt-12 aspect-square lg:mt-0 lg:order-first">
                    <img class="object-cover object-center w-full mx-auto bg-gray-300 lg:ml-auto" alt="" src="<?php echo $category->image ?>">
                </div>
            </div>
            <?php } else { echo 'no such category'; } ?>
        </div>
    </div>
</section>
<?php include_once __DIR__ . '/../../Components/footer.php';