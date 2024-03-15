<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro-Skouila</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<header>
    <nav>
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
            <a href="" class="link login">Login</a>
            <a href="" class="link signup" id="test">Signup</a>
        </div>
    </nav>
    <div class="mobile_menu hidden" id="mobile_menu">
        <a href="/" class="link">Home</a>
        <a href="/views/categories/categories.php" class="link">Categories</a>
        <a href="/views/products.php" class="link">Products</a>
        <a href="" class="link">About</a>
        <a href="" class="link">Contact</a>
    </div>
</header>