<?php
# Author::    Jorge Vargas  (mailto:jorge.vargas@voicebunny.com)
# Copyright:: Copyright (c) 2008 Torrenegra IP, LLC.
# License::   Distributed under Creative Commons CC-BY license http://creativecommons.org/licenses/by/3.0/

require_once('lib/VoiceBunnyCarrot.php');

$vb_carrot = new VoiceBunnyCarrot( '0', 'xxxxXXXXxxxxXXXX','https://api.local.voicebunny.com/');

$balance = $vb_carrot->balance();
echo "Your account balance is: ". $balance['balance']['amount'] ." ". $balance['balance']['currency']."<br>";

$current_balance = $balance['balance']['amount'];

$wordsToChange = 5;
$readId = 75;
$voiceBunnyError = 1;
$instructions = 'Please correct the 4th word.';

$quoteParams = array(
    'wordsAddedOrChanged'=> $wordsToChange, 
    'voiceBunnyError'=>$voiceBunnyError,
);

$quote = $vb_carrot->revision_quote($readId, $quoteParams);
echo "Posting this revision will cost: ". $quote['quote']['price']." ". $quote['quote']['currency']."<br>";

$reward = $quote['quote']['price'];

if( $current_balance >= $reward ){
    $revision = array(
        'wordsAddedOrChanged' => $wordsToChange,
        'voiceBunnyError' => $voiceBunnyError,
        'instructions' => $instructions
    );
    $response = $vb_carrot->revision_add($readId, $revision);
    if(isset($response['error'])){
        echo "Something happened: " . $response['error']['message'];
    }else{
        echo "Project successfully posted.";
    }
}else{
    echo "You dont have enough money to post this project.";
}

?>
