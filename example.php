<?php

require_once('lib/VoiceBunnyCarrot.php');

$vb_carrot = new VoiceBunnyCarrot('85','de52c722a40ea875ce89ae134a9ad66071144f5e','https://api.local.voicebunny.com/');

echo "<br>------ Languages --------<br>";
print_r($vb_carrot->languages());
echo "<br>------ Languages --------<br>";
echo "<br>";
echo "<br>------ Balance --------<br>";
print_r($vb_carrot->balance());
echo "<br>------ Balance --------<br>";
echo "<br>";
echo "<br>------ Gender & Ages --------<br>";
print_r($vb_carrot->gender_ages());
echo "<br>------ Gender & Ages --------<br>";
echo "<br>";
echo "<br>------ All projects --------<br>";
//print_r($vb_carrot->all_projects());
echo "<br>------ All projects --------<br>";
echo "<br>";
echo "<br>------ Get project --------<br>";
print_r($vb_carrot->get_project(1));
echo "<br>------ Get project --------<br>";
?>
