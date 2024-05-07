<?php

use Core\Errors;
use Models\Category;

include_once __DIR__ . '/../../Components/navbar.php';
$categories = Category::getAll();
?>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="flex items-center space-x-5">
                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                        <h2 class="leading-relaxed">New product</h2>
                        <p class="text-sm text-gray-500 font-normal leading-relaxed">Create a new product (a product must have at least a name).</p>
                    </div>
                </div>
                <form action="/product/create" method="POST" enctype="multipart/form-data">
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="leading-loose">Name:</label>
                                <input type="text" name="name" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Product name">
                            </div>
                            <div class="text-red-600"><?= Errors::get("name") ?></div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Category:</label>
                                <select name="category_id" id="" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                    <option value="">Choose category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex flex-col">
                                    <label class="leading-loose">Price:</label>
                                    <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="number" name="price" class="p-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Price">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label class="leading-loose">Quantity:</label>
                                    <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="number" name="quantity" class="p-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Featured image:</label>
                                <input type="file" name="featured_image" id="">
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Description:</label>
                                <textarea name="description" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Product description"></textarea>
                            </div>
                        </div>
                        <div class="pt-4 flex items-center space-x-4">
                            <a href="<?= $_SERVER["HTTP_REFERER"] ?? '/products' ?>" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                            </a>
                            <button class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../../Components/footer.php';
?>