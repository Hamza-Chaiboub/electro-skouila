<?php
// types of array
    // Simple
$arr1 = ['Hamza', 'Hafsa', 'Mohamed', 'Yahya'];

    // Associative Array
$arr2 = [
    "name" => "Hamza",
    "age" => 30,
    "fav_color" => "Black"
];

    // Multi-dimensional array
$arr3 = [
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "week-end" => [
        "Saturday",
        "Sunday"
    ]
];
//echo $arr3["week-end"][0];

// if else statement
$age = 16;

if($age > 25){
    //echo "You are old";
} elseif ($age <= 25 && $age >18){
    //echo "You are an adult";
}else {
    //echo "You are too young";
}

//ternary operator
$age2 = 21;

//echo $age2 >= 18 ? 'Adult' : 'Minor';

// Loops
    // For loop
$alphabets = ['A', 'B', 'C', 'D', 'E', 'F'];

for($i = 0; $i < count($alphabets); $i++){
    //echo $alphabets[$i] . "<br>";
}

    // Foreach
foreach($alphabets as $alphabet){
    //echo $alphabet . "<br>";
}

$my_array = [
    "group_name" => "F-December",
    "members" => 13,
    "course" => "fullstack web development"
];

// group_name : F-December
// members : 13
// course : fullstack web development

foreach($my_array as $key => $value){
    //echo "$key : $value <br>";
}

    // While loop
$counter = 10;
while($counter < 5){
    //echo "Test $counter <br>";
    $counter++;
}

    // Do While loop
$counter2 = 10;
do {
    //echo "Test $counter2 <br>";
    $counter2++;
}while($counter2 < 5);

    // Switch Statement

$result = 0;

switch($result){
    case 0:
        //echo "The result is 0";
        break;
    case 1:
        //echo "The result is 1";
        break;
    case 2:
        //echo "the result is 2";
        break;
    case 3:
        //echo "the result is 3";
        break;
    default:
        //echo "This result in unknown";
}

// the % operator

$number = 28;
if($number % 2 == 0){
    //echo "$number can be divided by 2";
}else {
    //echo "$number cannot be divided by 2";
}

// the "NOT" operator {!}
if(!($number > 10)){
    //echo "Test passed";
}else {
    //echo "Test not passed";
}


$name = "Skouila!";

echo "Hello" + $name;






















$age = 30; // Integer
$name = "Hamza"; // String
$height = 3.5; // Float
$fav_foods = array("Couscous", "Tajine", "Pastille"); //Array
$fav_colors = ["Black", "Orange", "Green", "Red"]; // Array

//

