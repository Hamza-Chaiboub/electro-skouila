<?php
$page = 'categories';
include(__DIR__ . '/../../Components/navbar.php');

echo $_SERVER["REQUEST_URI"];

include(__DIR__ . '/../../Components/categories.php');
include(__DIR__ . '/../../Components/footer.php');