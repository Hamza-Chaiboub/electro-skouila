<?php
use Core\Auth;
use Models\Product;

/** @var Product $products
 * @var $current_page
 * @var $total_pages
 */


include_once __DIR__ . '/../../Components/navbar.php';

?>
<main class="ym-8">
    <div class="container mx-auto px-4 py-16 lg:px-8 lg:py-16 xl:max-w-7xl">
        <?php if(Auth::authenticated() && Auth::isAdmin()): ?>
        <a href="/product/create" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Add new product</a>
        <?php endif; ?>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            <?php if ($products): ?>
                <?php foreach ($products as $product) { ?>
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <a href="/product/<?= $product->id ?>/<?= $product->slug ?>">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('<?= $product->featured_image ?>')">
                        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                    </a>
                    <div class="px-5 py-3">
                        <a href="/product/<?= $product->id ?>/<?= $product->slug ?>" class="text-gray-700 uppercase block"><?= $product->name ?></a>
                        <span class="text-gray-500 mt-2">$<?= $product->price ?></span>
                    </div>
                </div>
                <?php } ?>
            <?php else: ?>
                <div>No products</div>
            <?php endif; ?>
        </div>
    </div>
    <nav class="container flex justify-center mb-16">
        <ul class="flex items-center -space-x-px h-8 text-sm">
            <li>
                <a href="/products/page/<?= $current_page - 1 ?>" class="<?= $current_page == 1 ? 'pointer-events-none' : '' ?> flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </a>
            </li>
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
            <li>
                <a href="/products/page/<?= $i ?>" class="<?= $current_page == $i ? 'bg-gray-100 text-gray-700 pointer-events-none' : 'text-gray-500 bg-white' ?> flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            <li>
                <a href="/products/page/<?= $current_page + 1 ?>" class="<?= $current_page == $total_pages ? 'pointer-events-none' : '' ?> flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</main>

<?php
include_once __DIR__ . '/../../Components/footer.php';
?>