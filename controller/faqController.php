<?php

class FaqController {
	private $model = null;
	
	function __construct ($db) {
		include 'model/faq.php';
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
	

	function getFormInterfaceAdmin($id) {
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
	
	
	function getDeleteUser($id){
		$del = $this->modelUser->deleteUser($id);
	}
	
	function getDeleteQuestion($delId) {
		$this->model->deleteQuestion($delId);
	}
	
	function getExit() {
		$this->modelUser->adminExit();
	}
	
	function getDeleteCategoryAndQuestion($id) {
		$del = $this->model->deleteCategoryAndQuestion($id);
	}
	
	function getHiddenQuestion($id) {
		$hidden = $this->model->hiddenQuestion($id);
	}
	
	function getShowQuestion($id) {
		$showQuest = $this->model->questionShow($id);
	}
	
	function getShowCategory() {
		$list = $this->model->getCategory();
		$faq = $this->model->getFaq($_GET['list']);
		echo $this->render('faq/index.php', ['list' => $list, 'faq' => $faq]);
	}
	
	function getAddQuestion($name, $email, $text, $list) {
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
	
	function getEditQuestion($questionId, $question) {
		if(empty($question)) {
			echo '<p>Enter question</p>';
		}
		else {
			$this->model->editQuestion($questionId, $question);
		}
	}
	
	function getEditAnswer($questionId, $answer) {
		if(empty($answer)) {
			echo '<p>Type answer</p>';
		}
		else {
			$this->model->editAnswer($questionId, $answer);
		}
	}
	
	function getEditCategory($category, $id) {
		if($category == 0) {
			echo '<p>Select a category</p>';
			return false;
		}
		else {
			$this->model->editCategory($category, $id);
		}
		
	}
	
	
}
