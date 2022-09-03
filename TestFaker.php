<?php
include "Assets/PHPScripts/Include.php";
require 'Assets/PHPScripts/Tags.php';
require 'Assets/Database/DatabaseConnection.php';
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
$dbConnect = DatabaseConnection::GetInstance();
//0 male, 1 female
$b_gender = rand(0,1);
$sex = $b_gender==1?'female':'male';
$dbConnect->AddComment
(
    $title=$b_gender==1?$faker->titleFemale():$faker->titleMale(),
    $gender=$sex,
    $display_name=$faker->userName(),
    $first_name=$faker->name($sex),
    $last_name=$faker->lastName(),
    $address1= $faker->streetAddress(),
    $address2= $faker->streetName(),
    $address3= $faker->city(),
    $postcode= $faker->postcode(),
    $country= $faker->country(),
    $email_address = $faker->email(),
    $phone_number = $faker->phoneNumber(),
    $comment = $faker->realTextBetween($minNbChars = 30, $maxNbChars = 500, $indexSize = 2)."\n",
    $contact_me = rand(0,1)
);





?>