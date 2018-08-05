<?php
namespace Controller;

use  Faq\User\Faq;
use  Model\User\User;
use Graduate\Database\DataBase;

class FaqController {
	private $model = null;
	
	public function __construct ($db) {
		include 'model/Faq.php';
		$this->model = new Faq($db);
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
	

	public function getFormInterfaceAdmin($id) {
		$listAdmin = $this->model->getListAdmin();
		$list = $this->model->getCategory();
		$countQuest = $this->model->getCategoryAndCountQuestion();
		$countShowQuest = $this->model->getCategoryAndCountShowQuestion();
		$countAnswerQuest = $this->model->getCategoryAndCountAnswerQuestion();
		$showQuest = $this->model->showQuestion($id);
		$questionNoAnswer = $this->model->showQuestionNoAnswer();
		echo $this->render('faq/interface-admin.php', [
		    'listAdmin' => $listAdmin, 
		    'list' => $list, 
		    'countQuest' => $countQuest,
		    'countShowQuest' => $countShowQuest,
		    'countAnswerQuest' => $countAnswerQuest,
		    'showQuest' => $showQuest,
		    'questionNoAnswer' => $questionNoAnswer
	        ]);
	}
	
	public function getDeleteUser($id){
		$del = $this->modelUser->deleteUser($id);
	}
	
	public function getDeleteQuestion($delId) {
		$this->model->deleteQuestion($delId);
	}
	
	public function getExit() {
		$this->modelUser->adminExit();
	}
	
	public function getDeleteCategoryAndQuestion($id) {
		$del = $this->model->deleteCategoryAndQuestion($id);
	}
	
	public function getHiddenQuestion($id) {
		$hidden = $this->model->hiddenQuestion($id);
	}
	
	public function getShowQuestion($id) {
		$showQuest = $this->model->questionShow($id);
	}
	
	public function getShowCategory() {
		$list = $this->model->getCategory();
		$faq = $this->model->getFaq($_GET['list']);
		echo $this->render('faq/index.php', ['list' => $list, 'faq' => $faq]);
	}
	
	public function getAddQuestion($name, $email, $text, $list) {
		if($list == 0) {
			die('<p>Select a category</p>');
		}
		if(!empty($name) && !empty($email) && !empty($text) && !empty($list)) {
			$question = $this->model->addQuestion($name, $email, $text, $list);
		}
		else {
			die('<p>Fill in all the fields</p>');
		}
	}
	
	public function getEditQuestion($questionId, $question) {
		if(empty($question)) {
			echo '<p>Enter question</p>';
		}
		else {
			$this->model->editQuestion($questionId, $question);
		}
	}
	
	public function getEditAnswer($questionId, $answer) {
		if(empty($answer)) {
			echo '<p>Type answer</p>';
		}
		else {
			$this->model->editAnswer($questionId, $answer);
		}
	}
	
	public function getEditCategory($category, $id) {
		if($category == 0) {
			echo '<p>Select a category</p>';
			return false;
		}
		else {
			$this->model->editCategory($category, $id);
		}
		
	}
		
}
