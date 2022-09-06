<?php
//https://www.latlong.net/
$lat = 53.793850;
$long = -1.752440;
$info = date_sun_info(time(), $lat,$long);
print_r($info);
$today = new DateTime();
?>

<!DOCTYPE html>
<?php 
for($i = 0; $i < 7; $i++)
{
    $date = new DateTime("+{$i} day");
    $info = date_sun_info($date->getTimestamp(), $lat,$long);
    $sunrise = date(('g:i a'),$info['sunrise']);
    $day = $date->format('D M j');
    echo "<p>Sun Rise {$day} - {$sunrise}</p>";
}
?>