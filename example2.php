<?php
# Author::    Jorge Vargas  (mailto:jorge.vargas@voicebunny.com)
# Copyright:: Copyright (c) 2008 Torrenegra IP, LLC.
# License::   Distributed under Creative Commons CC-BY license http://creativecommons.org/licenses/by/3.0/

require_once('lib/VoiceBunnyCarrot.php');

$vb_carrot = new VoiceBunnyCarrot('0', 'xxxxXXXXxxxxXXXX','https://api.local.voicebunny.com/');

$balance = $vb_carrot->balance();
echo "Your account balance is: ". $balance['balance']['amount'] ." ". $balance['balance']['currency']."<br>";

$current_balance = $balance['balance']['amount'];

$title = "My test project";
$script = array();
$script['Part001'] = "What's up, folks";
$script['Part002'] = "What's up, doc";
$language = "eng-us";
$talentId = 6;

$quoteParams = array(
    'script'=> $script, 
    'language'=>$language,
    'fulfilmentType' => 'booking',
    'talentID' => $talentId
);
$quote = $vb_carrot->quote($quoteParams);
echo "Posting this booking will cost: ". $quote['quote']['price']." ". $quote['quote']['currency']."<br>";

$reward = $quote['quote']['price'];

if( $current_balance >= $reward ){
    $project = array(
        "title" => $title,
        "script" => $script,
        "remarks" => "I want the voice be similar to Bugs Bunny.",
        "talentID" => $talentId
    );
    $response = $vb_carrot->create_booking_project($project);
    if(isset($response['error'])){
        echo "Something happened: " . $response['error']['message'];
    }else{
        echo "Project successfully posted.";
    }
}else{
    echo "You dont have enough money to post this project.";
}

?>
