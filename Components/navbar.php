<?php
/**
 * @var string $page
 * @var string $title
 */
//setSession();
/** @var $product */
use Core\Auth;

if(isset($_SESSION["logged_in"]) && $_SESSION['logged_in'])
{
    $user = $_SESSION["user"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro-Skouila - <?php echo $title ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body x-data="{ cartOpen: false , isOpen: false }">
<header>
    <nav class="py-2">
        <div class="logo">
            <a href="/">
                <img src="/img/logo.png" alt="logo of skouila">
            </a>
            <div class="bars" onclick="my_function()" id="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="links">
            <a href="/" class="link <?php echo $page == 'home' ? 'active' : '' ?>">Home</a>
            <a href="/categories" class="link <?php echo $page == 'categories' ? 'active' : '' ?>">Categories</a>
            <a href="/products" class="link <?php echo $page == 'products' ? 'active' : '' ?>">Products</a>
            <a href="#" class="link">About</a>
            <a href="#" class="link">Contact</a>
        </div>
        <div class="buttons">
            <div class="inline">
                <button @click="cartOpen = !cartOpen" class="link"><i class="fa-solid fa-cart-shopping relative"><span class="<?= isset($_SESSION['cart']) ? 'bg-red-500' : 'hidden' ?> w-3 h-3 absolute rounded-full -top-2 left-0"></span></i></button>
                <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="z-10 fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                        <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <hr class="my-3">
                    <?php
                    if(isset($_SESSION['cart'])):
                    foreach($_SESSION['cart'] as $productInCart): ?>
                    <div class="flex justify-between mt-6">
                        <div class="flex">
                            <img class="h-20 w-20 object-cover rounded" src="<?= $productInCart->featured_image ?>" alt="">
                            <div class="mx-3">
                                <h3 class="text-sm text-gray-600"><?= $productInCart->name ?></h3>
                                <div class="flex items-center mt-2">
                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    <span class="text-gray-700 mx-2">2</span>
                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-600"><?= $productInCart->price ?>$</span>
                    </div>
                    <?php endforeach;
                    endif;
                    ?>
                    <div class="mt-8">
                        <form class="flex items-center justify-center">
                            <input class="form-input w-48" type="text" placeholder="Add promocode">
                            <button class="ml-3 flex items-center px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <span>Apply</span>
                            </button>
                        </form>
                    </div>
                    <a class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span>Checkout</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <?php if(!Auth::authenticated()){ ?>
                <a href="/login" class="link login">Login</a>
                <a href="/register" class="link signup" id="test">Signup</a>
            <?php } else { ?>
                <a href="/profile/<?= Auth::query("id") . '/' . Auth::query("username") ?>" class="link text-xl">
                    <i class="fa-solid fa-user"></i>
                    <?= ' ' . Auth::query("username") ?>
                </a>
                <a href="/user/logout" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-lg px-5 py-3 text-center">Logout</a>
            <?php } ?>
        </div>
    </nav>
    <div class="mobile_menu hidden" id="mobile_menu">
        <a href="/" class="link <?php echo $page == 'home' ? 'active' : '' ?>">Home</a>
        <a href="/categories" class="link <?php echo $page == 'categories' ? 'active' : '' ?>">Categories</a>
        <a href="/views/products.php" class="link <?php echo $page == 'products' ? 'active' : '' ?>">Products</a>
        <a href="#" class="link">About</a>
        <a href="#" class="link">Contact</a>
    </div>
</header>

