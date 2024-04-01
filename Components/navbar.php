<?php
/**
 * @var string $page
 */
//setSession();
if($_SESSION["logged_in"])
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
<body>
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
            <a href="/views/products.php" class="link <?php echo $page == 'products' ? 'active' : '' ?>">Products</a>
            <a href="#" class="link">About</a>
            <a href="#" class="link">Contact</a>
        </div>
        <div class="buttons">
            <?php if(!$_SESSION["logged_in"]){ ?>
                <a href="/login" class="link login">Login</a>
                <a href="/register" class="link signup" id="test">Signup</a>
            <?php } else { ?>
                <a href="/profile/<?= Auth::query(["id"]) . '/' . Auth::query(["username"]) ?>" class="link text-xl">
                    <i class="fa-solid fa-user"></i>
                    <?= ' ' . Auth::query(["username"]) ?>
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