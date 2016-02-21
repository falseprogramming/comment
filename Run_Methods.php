<?php

class Run_Methods {
	
		function __construct(){
			
			$this->comment = new Comment();
				
				$p = isset($_GET['p']) ? $_GET['p'] : '';
				
				switch($p) {
					
					case 'index':
						$this->index();
						break;
					case 'innerPost':
						$this->innerPost();
						break;
					case 'postComment':
						$this->postComment();
						break;		
					default:
						$this->index();
				}
		}
		
		public function index(){
			
			$this->comment->showPosts();
			
		}
		
		public function innerPost(){
			$this->comment->innerPost();
			$this->comment->showComments(10);
			require 'form.php';
		
		
			
			
		}
		
		public function postComment(){
			
			$this->comment->postComment();
		}
}