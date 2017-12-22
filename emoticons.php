<?php
	function getEmoticons($data) {
		$data = str_replace(':( ', '<img src="emoticons/1.png"/>' ,$data);
		$data = str_replace(':D ', '<img src="emoticons/2.png"/>' ,$data);
		$data = str_replace(':) ', '<img src="emoticons/3.png"/>' ,$data);
		$data = str_replace('^_^ ', '<img src="emoticons/4.png"/>' ,$data);
		$data = str_replace('<3 ', '<img src="emoticons/5.png"/>' ,$data);

		return $data;
	}

	echo getEmoticons('Hello people :D <br> &#x1f601; My name is karim :) <3 ^_^ ');
?>