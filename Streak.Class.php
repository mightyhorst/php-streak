<?php
class Streak {
	private $_streak_API = 'https://www.streak.com/api/v1';
	private $_streak_token = '';
	private $method = '';
	private $submethod = '';
	private $method_key = '';
	private $submethod_key = '';
	
	function __construct($key) {

		$this->_streak_token = $key;
	}
	private function verbData($verb, $url, $username, $password, $additional) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, 
			$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 
			1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 
			$timeout);
		curl_setopt($ch, CURLOPT_USERPWD,
			"$username:$password");
		switch($verb) {
			case "POST":
				$fields = json_encode($additional);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,
				"POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS,
					$fields);
				curl_setopt($ch, CURLOPT_HTTPHEADER, 
					array('Content-Type: application/json'));
				break;
			case "GET":
				break;
			case "DELETE":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,
				"DELETE");
				break;
			case "PUT":
				$fields_string = '';
				foreach($additional as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,
				"POST");
				curl_setopt($ch,CURLOPT_POST,
					count($additional));
				curl_setopt($ch,CURLOPT_POSTFIELDS,
					$fields_string);
				curl_setopt($ch, CURLOPT_HTTPHEADER, 
					array('Content-Type: application/json'));
				break;
			default:
				break;
		}
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	private function getQuery() {
		if($this->method_key != '') {
			$this->method = $this->method."/";
		}
		if($this->submethod != '' && $this->submethod_key != '') {
			$this->submethod = $this->submethod."/";
		}
		return $this->_streak_API.$this->method.$this->method_key.$this->submethod.$this->submethod_key;
	}
	//verbs
	public function get() {
		$return_data = $this->verbData("GET",$this->getQuery(), $this->_streak_token, "", "");
		return $return_data;
	}
	public function post($post) {
		$return_data = $this->verbData("POST",$this->getQuery(), $this->_streak_token, "", $post);
		return $return_data;
	}
	public function put($put) {
		$return_data = $this->verbData("PUT",$this->getQuery(), $this->_streak_token, "", $put);
		return $return_data;
	}
	public function delete() {
		$return_data = $this->verbData("DELETE",$this->getQuery(), $this->_streak_token, "", "");
		return $return_data;
	}
	//methods
	public function Pipeline($key = '') {
		$this->method = "/pipelines";
		$this->submethod = '';
		$this->method_key = $key;
		$this->submethod_key = '';
		return $this;
	}
	public function Box($key = '') {
		$this->method = "/boxes";
		$this->submethod = '';
		$this->method_key = $key;
		$this->submethod_key = '';
		return $this;
	}
	public function Thread($key = '') {
		$this->method = "/threads";
		$this->submethod = '';
		$this->method_key = $key;
		$this->submethod_key = '';
		return $this;
	}
	public function User($key = 'me') {
		$this->method = "/users";
		$this->submethod = '';
		$this->method_key = $key;
		$this->submethod_key = '';
		return $this;
	}
	public function Snippet($key = '') {
		$this->method = "/snippets";
		$this->submethod = '';
		$this->method_key = $key;
		$this->submethod_key = '';
		return $this;
	}
	public function Search($query = '') {
		$this->method = "/search?query=".$query;
		$this->submethod = '';
		$this->method_key = '';
		$this->submethod_key = '';
		return $this;
	}
	//submethods
	public function Boxes($key = '') {
		$this->submethod = "/boxes";
		$this->submethod_key = $key;
		return $this;
	}
	public function News($key = '') {
		$this->submethod = "/newsfeed";
		$this->submethod_key = $key;
		return $this;
	}
	public function Stages($key = '') {
		$this->submethod = "/stages";
		$this->submethod_key = $key;
		return $this;
	}
	public function Fields($key = '') {
		$this->submethod = "/fields";
		$this->submethod_key = $key;
		return $this;
	}
		//box-only submethods
	public function Reminders($key = '') {
		$this->submethod = "/remidners";
		return $this;
	}
	public function Files($key = '') {
		$this->submethod = "/files";
		return $this;
	}
	public function Threads($key = '') {
		$this->submethod = "/threads";
		return $this;
	}
	public function Comments($key = '') {
		$this->submethod = "/comments";
		return $this;
	}

}