<?php

class VBCarrot {

    private $url;
    private $api_id;
    private $api_key;

    function __construct($api_id, $api_key, $url = "https//api.voicebunny.com/") {
	$this->url = $url;
	$this->api_id = $api_id;
	$this->api_key = $api_key;
    }

    public function balance() {
	$conn = curl_init();
	$opts = array(
	    CURLOPT_URL => $this->url + 'balance.json',
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_INFILESIZE => -1,
	    CURLOPT_TIMEOUT => 60,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_HTTPGET => TRUE,
	    CURLOPT_USERPWD => $this->api_id . ':' . $this->api_key,
	);
	curl_setopt_array($conn, $opts);
	$data = curl_exec($conn);
	curl_close($conn);
	return json_decode($data, true);
    }
    public function languages() {
	$conn = curl_init();
	$opts = array(
	    CURLOPT_URL => $this->url + 'languages.json',
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_INFILESIZE => -1,
	    CURLOPT_TIMEOUT => 60,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_HTTPGET => TRUE,
	    CURLOPT_USERPWD => $this->api_id . ':' . $this->api_key,
	);
	curl_setopt_array($conn, $opts);
	$data = curl_exec($conn);
	curl_close($conn);
	return json_decode($data, true);
    }


}

?>
