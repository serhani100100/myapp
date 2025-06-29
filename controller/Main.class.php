<?php

class Main{
	
	public function show(){
		return Html::load(App::$key.".html");
	}

	public function send() {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$message = $_POST["message"];
		$copy = $_POST["copy"];

		if (empty($email)) {
			$email = "Email not entered";
		}

		$html = $name.'/'.$email.'/'.$message.'/'.$copy;
		return $html;
	} 
	
}
