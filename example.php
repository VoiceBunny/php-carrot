<?php

require_once('lib/VoiceBunnyCarrot.php');

$vb_carrot = new VoiceBunnyCarrot('85','de52c722a40ea875ce89ae134a9ad66071144f5e');
echo "<br/>";
print_r($vb_carrot->languages());
?>
