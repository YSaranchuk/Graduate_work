<?php

class UserController {
	private $modelUser = null;
	
	function __construct ($db) {
		include 'model/user.php';
		$this->modelUser = new User($db);
	}
	
	private function render($template = null, $params = null) {
		$fileTemplate = 'template/'.$template;
		if (is_file($fileTemplate)) {
			ob_start();
			if (count($params) > 0) {
				extract($params);
			}
			include $fileTemplate;
			return ob_get_clean();
		}
	}
	
	function formLogon() {
		if(!empty($_SESSION['user'])){
			header('Location: ?interface-admin=1');
		}
		if((int)$_GET['admin'] === 1) {
			echo $this->render('faq/auth.php');
		}
	}
	
	function getLogon($login, $password) {
		if(!empty($login) && !empty($password)) {
			$logon = $this->modelUser->logon($login, $password);
		}
		
		else {
			die('<p>Fill in all the fields</p>');
		}
	}
	
	function setNewAdmin($login, $password) {
		if(!empty($login) && !empty($password)) {
			$newAdmin = $this->modelUser->newAdmin($login, $password);
		}
		else {
			echo '<p>Fill in all the fields</p>';
		}
	}
	
	function getUpdatePass($newPass, $admin) {
		if(!empty($newPass)) {
			$pass = $this->modelUser->newPassword($newPass, $admin);
		}
		else {
			echo '<p>Enter password</p>';
		}
	}
	
	function getNewCategory($title){
		if(!empty($title)) {
			if(iconv_strlen($title) > 0) {
				$new = $this->modelUser->newCategory($title);
			}
		}
		else {
			echo '<p>Enter category name</p>';
		}
	}
	
	function getNewName($questionId, $name) {
		if(empty($name)) {
			echo '<p>Enter your name</p>';
		}
		else {
			$this->modelUser->newName($questionId, $name);
		}
	}
	
	
}
