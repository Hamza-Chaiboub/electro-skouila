<?php
/**
 * @var $category
 */
include(__DIR__ . '/../../Components/navbar.php');
?>

<div class="overflow-y-auto overflow-x-hidden flex justify-center items-center w-full">
    <div class="p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit <?php echo $category->name ?>
                </h3>
            </div>
            <form action="/category/edit/<?php echo $category->id ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-4 flex flex-col gap-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Type product name" value="<?php echo $category->name ?>">
                        <div class="text-red-500"><?php echo $error ?? ''; ?></div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between">

                        <label class="block mb-2 text-sm font-medium text-gray-900 w-full" for="file_input">Upload file</label>
                        <img src='<?php echo $category->image ?>' alt="" class="w-1/3 items-center">
                        <input name="image" class="flex-grow block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" id="file_input" type="file" value="">
                        <input type="hidden" name="image" value="<?php echo $category->image ?>">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" rows="4" name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write category description here"><?php echo $category->description ?></textarea>
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="featured" class="sr-only peer" <?php echo $category->featured == 1 ? "checked" : "" ?> value="1">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900">Featured ?</span>
                        </label>
                    </div>
                </div>
                <button type="submit" name="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update
                </button>
                <a href="/category/delete/<?php echo $category->id ?>" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Delete
                </a>
                <a href="/category/<?php echo $category->id ?>" class="text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Cancel
                </a>
                <input type="hidden" name="id" value="<?php echo $category->id ?>">
            </form>
        </div>
    </div>
</div>
<?php
include(__DIR__ . '/../../Components/footer.php');
?>