<?php

require_once('lib/PHPCarrot.php');

$vb_carrot = new VBCarrot('85','de52c722a40ea875ce89ae134a9ad66071144f5e','https://api.local.voicebunny.com/');
echo "<br/>";
print_r($vb_carrot->languages());
?>
