<?php
namespace Controller;
use  Faq\User\Faq;
use  Model\User\User;
use Graduate\Database\DataBase;


class UserController {
	private $modelUser = null;
	
	public function __construct ($db) {
		include 'model/User.php';
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
	
	public function formLogon() {
		if(!empty($_SESSION['user'])){
			header('Location: ?interface-admin=1');
		}
		if((int)$_GET['admin'] === 1) {
			echo $this->render('faq/auth.php');
		}
	}
	
	public function getLogon($login, $password) {
		if(!empty($login) && !empty($password)) {
			$logon = $this->modelUser->logon($login, $password);
		}
		
		else {
			die('<p>Fill in all the fields</p>');
		}
	}
	
	public function setNewAdmin($login, $password) {
		if(!empty($login) && !empty($password)) {
			$newAdmin = $this->modelUser->newAdmin($login, $password);
		}
		else {
			echo '<p>Fill in all the fields</p>';
		}
	}
	
	public function getUpdatePass($newPass, $admin) {
		if(!empty($newPass)) {
			$pass = $this->modelUser->newPassword($newPass, $admin);
		}
		else {
			echo '<p>Enter password</p>';
		}
	}
	
	public function getNewCategory($title){
		if(!empty($title)) {
			if(iconv_strlen($title) > 0) {
				$new = $this->modelUser->newCategory($title);
			}
		}
		else {
			echo '<p>Enter category name</p>';
		}
	}
	
	public function getNewName($questionId, $name) {
		if(empty($name)) {
			echo '<p>Enter your name</p>';
		}
		else {
			$this->modelUser->newName($questionId, $name);
		}
	}
	
	
}

