<?php

class cURL {

 private $curl;

 public function __construct($url) {

  $this->curl = curl_init();

  curl_setopt($this->curl, CURLOPT_URL, $url);
  curl_setopt($this->curl, CURLOPT_COOKIEJAR, 'cookies.txt');
  curl_setopt($this->curl, CURLOPT_COOKIEFILE, 'cookies.txt');
  curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, FALSE);
  curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($this->curl, CURLOPT_VERBOSE, 1);
  curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.8) Gecko/20061025 Firefox/1.5.0.8'));
  curl_setopt($this->curl, CURLOPT_MAXREDIRS, 0);

 }

 public function execute() {

  return curl_exec($this->curl);

 }

 public function post($post = array()) {

  $string = array();
  foreach($post as $key => $value) {
   $string[] = (string)$key .'='. (string)$value;
  }

  curl_setopt($this->curl, CURLOPT_POST, 1);
  curl_setopt($this->curl, CURLOPT_POSTFIELDS, implode('&', $string));

 }

 public function __destruct() {
  //curl_close($this->curl);
 }

}

?>
