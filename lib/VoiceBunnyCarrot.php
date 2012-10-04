<?php
# Authors::   Jorge Vargas  (mailto:jorge.vargas@voicebunny.com), Carlos Rodriguez (mailto:carlos.rodriguez@voicebunny.com)
# Copyright:: Copyright (c) 2008 Torrenegra IP, LLC.
# License::   Distributed under Creative Commons CC-BY license http://creativecommons.org/licenses/by/3.0/

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
    
    public function all_projects(){
	$data = $this->request('projects', 'get');
	return json_decode($data[1], true);
    }
    
    public function get_project($id){
	$data = $this->request('projects/'.$id, 'get');
	return json_decode($data[1], true);
    }
    
    public function create_project($project){
        $project['script'] = json_encode($project['script']);
	$data = $this->request('projects/addSpeedy', 'post', true, $project);
	return json_decode($data[1], true);
    }
    
    public function create_booking_project($project){
        $project['script'] = json_encode($project['script']);
	$data = $this->request('projects/addBooking', 'post', true, $project);
	return json_decode($data[1], true);
    }
    
    public function force_dispose($id){
	$data = $this->request('projects/forceDispose/'.$id, 'get');
	return json_decode($data[1], true);
    }
    
    public function quote($params){
        $vars = array();
        $vars['language'] = $params['language'];
        if(isset($params['fulfilmentType'])){
            $vars['fulfilmentType'] = $params['fulfilmentType'];
        }
        if(isset($params['maxEntries'])){
            $vars['maxEntries'] = $params['maxEntries'];
        }
        if(isset($params['talentID'])){
            $vars['talentID'] = $params['talentID'];
        }
        
        if(isset($params['numberOfCharacters'])){
            $vars['numberOfCharacters'] = $params['numberOfCharacters'];
        }else if(isset($params['numberOfWords'])){
            $vars['numberOfWords'] = $params['numberOfWords'];
        }else{
            $vars['script'] = $params['script'];
        }
        
	$data = $this->request('projects/quote', 'post', true, $vars);
	return json_decode($data[1], true);
    }
    
    public function get_read($id){
	$data = $this->request('reads/'.$id, 'get');
	return json_decode($data[1], true);
    }
    
     public function approve_read($id){
	$data = $this->request('reads/approve/'.$id, 'get');
	return json_decode($data[1], true);
    }
    
     public function reject_read($id){
	$data = $this->request('reads/approve/'.$id, 'get');
	return json_decode($data[1], true);
    }
    
    public function revision_quote($id, $params){
        $vars = array();
        $vars['voiceBunnyError'] = $params['voiceBunnyError'];
        if(isset($params['charactersAddedOrChanged'])){
            $vars['charactersAddedOrChanged'] = $params['charactersAddedOrChanged'];
        }else{
            $vars['wordsAddedOrChanged'] = $params['wordsAddedOrChanged'];
        }
        $data = $this->request('reads/'.$id.'/revision/quote', 'post', true, $vars);
	return json_decode($data[1], true);
    }
    
    public function revision_add($id, $params){
        $vars = array();
        $vars['voiceBunnyError'] = $params['voiceBunnyError'];
        $vars['instructions'] = $params['instructions'];
        if(isset($params['ping'])){
            $vars['ping'] = $params['ping'];
        }
        
        if(isset($params['charactersAddedOrChanged'])){
            $vars['charactersAddedOrChanged'] = $params['charactersAddedOrChanged'];
        }else{
            $vars['wordsAddedOrChanged'] = $params['wordsAddedOrChanged'];
        }
        $data = $this->request('reads/'.$id.'/revision/add', 'post', true, $vars);
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
