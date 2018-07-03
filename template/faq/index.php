<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		 <link rel="stylesheet" href="style.css">
		<style>
		</style>
	</head>
	<body>
		<header>
			<p class="header">FAQ</p>
		</header>
		
		<div class="new-question">
			<p>Ask a Question</p>
			
			<form method="POST">
				<div class="user clearfix">	
				
					<p>
						<label for="name">Name</label>
						<input type="text" id="name" name="name">
					</p>
					
					<p>
						<label for="emil">Email</label>
						<input type="text" id="email" name="email">
					</p>
					<br>
					<br>
					<p>
					Category <select name="category">
							<option value="null">-</option>
							<?php
								foreach($list as $name){
									echo '<option value="'.$name['id'].'">'.$name['name'].'</option>';
								}
							?>
						</select>
					</p>
				</div>
				
				
				<textarea rows="5" name="text"></textarea>
				 <p><input type="submit" name="addQuestion" value="Send"></p>
			</form>
		</div>
		
		<section>
			<div class="content clearfix">
				<div class="category">
					<ul>
						<?php
							foreach($list as $name):?>
								<li><a href="?list=<?php echo $name['id']?>"><?php echo $name['name']?></a></li>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="questions">
					<ul class="mainMenu">
					
						<?php
							foreach($faq as $key) {
								if(!empty($key['answer']) && $key['status'] == 1): ?>
									<li class="item ">
										<div class="item_title"><?php echo $key['name']?>
											<span></span>
										</div>
									  <ul class="submenu none">
										 <p>
											<?php echo $key['answer']?>
										 </p>
									  </ul>
									</li>
						<?php endif; }?>
					  </ul>
				</div>
			</div>
		</section>
		
		<script>
			let mainMenu = document.querySelector('.mainMenu')
			let allItems = document.querySelectorAll('.item'); 
			mainMenu.addEventListener("click", e => {
			let currentItem = e.target.closest('.item'); 

			for (let item of allItems) { 
				item.firstElementChild.classList.remove('active'); 
				item.firstElementChild.nextElementSibling.classList.add('none');
			  }
		  
			currentItem.firstElementChild.classList.add('active'); 
			currentItem.firstElementChild.nextElementSibling.classList.remove('none')
			currentItem.firstElementChild.nextElementSibling.style.marginBottom = "-40px";
			});
		  </script>
	</body>
<html>