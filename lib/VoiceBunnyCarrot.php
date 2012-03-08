<?php

class VoiceBunnyCarrot {

    private $api_url;
    private $api_id;
    private $api_key;

    function __construct($api_id, $api_key, $url = 'https://api.voicebunny.com/') {
	$this->api_id = $api_id;
	$this->api_key = $api_key;
	$this->api_url = $url;
    }

    public function languages() {
	$data = $this->request('languages', 'get', false);
	return json_decode($data[1], true);
    }

    public function balance() {
	$data = $this->request('balance', 'get');
	return json_decode($data[1], true);
    }

    public function gender_ages() {
	$data = $this->request('genderAndAges', 'get', false);
	return json_decode($data[1], true);
    }

    public function request($url, $method = 'post', $auth = true, $vars = array()) {

	$vars = http_build_query($vars);
	$opts = array(
	    CURLOPT_URL => $this->api_url . '/' . $url,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_INFILESIZE => -1,
	    CURLOPT_TIMEOUT => 60,
	    CURLOPT_SSL_VERIFYPEER => false,
	);

	if ($auth)
	    $opts[CURLOPT_USERPWD] = $this->api_id . ':' . $this->api_key;
	switch ($method) {
	    case 'get':
	    case 'GET':
		$opts[CURLOPT_HTTPGET] = true;
		$opts[CURLOPT_URL] .= '?' . $vars;
		break;
	    case 'post':
	    case 'POST':
	    default:
		$opts[CURLOPT_POST] = true;
		$opts[CURLOPT_POSTFIELDS] = $vars;
		break;
	}
	$curl = curl_init();
	curl_setopt_array($curl, $opts);
	$response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	return array((int) $status, $response);
    }

}

?>
