<form name='comment' method='post' action='index.html?p=postComment&id=<?php echo $_GET['id'];?>'>
	<label>Title:<br><input type='text' size='25' name='comment_title'></label><br>
	<label>Comment:<br><textarea style='width: 250px; height: 100px;' name='comment_content'></textarea></label><br>
			<input type='submit' name='submit' value='OK!'>
</form>			