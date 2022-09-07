<?php
//https://www.php.net/manual/en/datetime.construct.php
//https://www.php.net/manual/en/datetime.format.php
//https://www.php.net/manual/en/datetime.createfromformat.php
//http://www.timezoneconverter.com/cgi-bin/zonehelp

//time

$time = time();
$timeFormatted = date('Y-m-d',$time);
echo "Time {$timeFormatted}\n";

//check valid

echo checkdate(07,06,1987)?"valid Date"."\n":"Not Valid Date"."\n";

//setting dates

//american format mm/dd/yyyy
$date = new DateTime('09/05/2022');
echo $date->format('F j, Y')."\n";
//explicit format 'dd/mm/yyyy'
$date = DateTime::createFromFormat('d/m/Y', '09/05/2022');
echo $date->format('F j, Y')."\n";

//time Zones

$zones = DateTimeZone::listIdentifiers();
foreach ($zones as $zone)
{
    echo "**************************************\n";
    $timezone = new DateTimeZone($zone);
    //Location
    echo "Time Zone Name: ".$timezone->getName()."\n";
    try {
        $date = new DateTime('now', $timezone);
        echo "Current Time and Date: ".$date->format('F j, Y :: H:i:s a')."\n";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
    $timezoneDetails = $timezone->getLocation();
    echo "latitude: ".$timezoneDetails['latitude']." / longitude: ".$timezoneDetails['longitude']."\n";
    echo "info: ".$timezoneDetails['comments']."\n";
    
//    echo $timezoneDetails['country_code']."\n";   
//    echo "\n";
//    print_r($timezone);
//    echo "\n";
    
    echo "\n\n\n";
}



