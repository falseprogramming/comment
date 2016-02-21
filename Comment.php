<?php
//Comment mini programm: M-M T
class Comment {
    function __construct() {

        $user = 'r163655_commentU';
        $pass = 'ij17cV0w5Q';

        $this->db = new PDO('mysql:host=localhost;dbname=r163655_comment;charset=utf8', $user, $pass);
        // foreach ($this->db->query('SELECT * from posts') as $row) {
        // print_r($row);
        //}
    }
	


    public function showPosts() {

        $sth = $this->db->prepare('select * from posts');
        $sth->execute();
        $result = $sth->fetchAll();

        foreach ($result as $key => $value) {
	
            echo '<a href="index.html?p=innerPost&id=' . $value['id'] . '">' . $value['title'] . '</a>' . '<br>';
            echo $value['content'] . '<br>';
			
        }
    }

    public function innerPost() {
        $sth = $this->db->prepare("select * from posts where id = ?");
       $sth->execute(array($_GET['id']));

        $result = $sth->fetchAll();

        foreach ($result as $key => $value) {
            $postid = $value['id'];
            echo '<h2>' . $value['title'] . '</h2>' . "\n";
            echo '<p>' . $value['content'] . '</p><hr>' . "\n";
        }
    }

    public function showComments($limit) {
        $sth = $this->db->prepare("select * from comments where post_id = ? order by id desc limit $limit");

        $sth->execute(array($_GET['id']));

        $result = $sth->fetchAll();
		echo '<h2>Comments</h2>';
        foreach ($result as $key => $value) {
			
            echo '<h4>Tiitel: ' . $value['comment_title'] . '</h4>' . "\n";
            echo '<pre>' . $value['comment_content'] . '</pre>';
        }
    }

    public function postComment() {
		
        $comment_title = $_POST['comment_title'];
        $comment_content = $_POST['comment_content'];
        
            if(($comment_title == '') || ($comment_content) =='') {
                    
                    echo '<div style="color:red;">Tiitel ja sisu vajalikud</div>';
                        echo '<a href="javascript:window.history.back()">Tagasi</a>';
                
            }else {

        $sth = $this->db->prepare('insert into comments(comment_title,comment_content,post_id)
					values(:comment_title,:comment_content,:post_id)');
        $sth->execute(array(
            ':comment_title' => $comment_title,
            ':comment_content' => $comment_content,
            ':post_id' => $_GET['id']
        ));
		 echo '<a href="index.html?p=innerPost&id='.$_GET['id'].'">Back to comment. Comment name: "'.$comment_title.'"</a>';
       }
	  
    }

}
