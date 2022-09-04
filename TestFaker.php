<?php
include "Assets/PHPScripts/Include.php";
require 'Assets/PHPScripts/Tags.php';
require 'Assets/Database/DatabaseConnection.php';
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
$dbConnect = DatabaseConnection::GetInstance();
for ($i = 0; $i < 10000; $i++) 
{
//0 male, 1 female
    try 
    {

        $b_gender = rand(0, 1);
        $sex = $b_gender == 1 ? 'female' : 'male';
        $company = $faker->company();
        $email_domains = array('hotmail', 'yahoo', 'myself', 'gmail', 'aol', 'free', 'live', 'libero',
            'ntlworld', 'arcor', 'planet', 'gmx', 'mail', 'freenet', 'web', 'msn', 'comcast', 'outlook',
            'uol', 'bol', 'cox', 'sbcglobal', 'sfr', 'verizon', 'ig', 'terra', 'bigpond', 'googlemail',
            'ymail', 'rocketmail', 'charter', str_replace(" ", "", $company)); 
        $email_append = array('.com', '.co.uk', '.org', '.fr', '.de', '.it', '.com.br', '.co.in', '.es', '.nl', 
            '.com.au', '.ca', '.ru', 'co.id');
        $first_name = $faker->name($sex);
        $last_name = $faker->lastName();
        $username = $faker->userName();
        $display_name = $username.rand(0,100000);
        $domain = array_rand(array_flip($email_domains)).'';
        $append = array_rand(array_flip($email_append)).'';
        $email_address = rand(0, 1)==1?$display_name:($first_name.".".$last_name);
        $email_address .= "@".$domain.$append;
        $email_address = str_replace(" ",rand(0, 1)==1?"":"." , $email_address);
        
        $dbConnect->AddComment
        (
            $title = $b_gender == 1 ? $faker->titleFemale() : $faker->titleMale(),
            $gender = $sex,
            $display_name,
            $first_name,
            $last_name,
            $address1 = $faker->streetAddress(),
            $address2 = $faker->streetName(),
            $address3 = $faker->city(),
            $postcode = $faker->postcode(),
            $country = $faker->country(),
            $email_address,
            $phone_number = $faker->phoneNumber(),
            $comment = $faker->realTextBetween($minNbChars = 30, $maxNbChars = 500, $indexSize = 2) . "\n",
            $contact_me = rand(0, 1)
        );
    }
    catch(PDOException $e) 
    {
        echo "Error (iteration $i): " . $e->getMessage();
    }
}




?>