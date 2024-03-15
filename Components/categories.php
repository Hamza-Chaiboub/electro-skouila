<?php
require_once __DIR__ . '/../Controllers/DatabaseConnection.php';
require __DIR__ . '/../Controllers/CategoryController.php';

$db_handler = new DatabaseConnection();

$categories = new CategoryController();
$results = $categories->index();
?>

<section>
        <div class="mx-auto text-center my-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Categories</h2>
            <a href="/categories/create" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-700">Create New Category</a>
        </div> 
        <div class="cat-wrapper flex justify-around flex-wrap gap-16 w-3/4 mx-auto">
            <?php
            if($results !== null){
            foreach($results as $result){ ?>
                <div class="category shadow-xl">
                    <a href="">
                        <div style="background-image: url(<?php echo $result->image ?>)" class="group img h-64 w-96 bg-cover flex items-end justify-center p-4 rounded-lg">
                            <a href="/category?id=<?php echo $result->id ?>" class="title bg-gray-300 hover:bg-blue-600 hover:text-white text-2xl rounded-md w-3/4 text-center mx-auto group-hover:bg-blue-600 group-hover:text-white"><?php echo $result->name ?></a>
                        </div>
                    </a>
                </div>
            <?php }
            } else {
                echo "Not Categories found!";
            }?>
        </div>
    </section>