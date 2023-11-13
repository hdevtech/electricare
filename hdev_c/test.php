<?php 
$enc = hdev_data::encd("INES"); 
echo $enc."<br>";
$dec = hdev_data::decd($enc);
echo $dec;
?>