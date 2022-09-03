<?php
////include __DIR__.'Assets\SQLQueries\Insert Into Comments.txt';
//require_once 'vendor/autoload.php';
//// use the factory to create a Faker\Generator instance
//$faker = Faker\Factory::create();
//// generate data by calling methods
//echo $faker->name()."\n";
//// 'Vince Sporer'
//echo $faker->email()."\n";
//// 'walter.sophia@hotmail.com'
//echo $faker->realTextBetween($minNbChars = 30, $maxNbChars = 500, $indexSize = 2)."\n";
//echo $faker->catchPhrase()."\n";
//echo $faker->bs()."\n";
//// 'Numquam ut mollitia at consequuntur inventore dolorem.'

$myFile = fopen("Assets/SQLQueries/Insert Into Comments.txt", "r") or die("Unable to open file!");;
$textString = "";
while(!feof($myFile)) {
    $textString .= fgetc($myFile);
}
echo $textString;
fclose($myFile);