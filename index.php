<?php

require_once 'core/init.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
$book = DB::getInstance()->query("SELECT * FROM books");
if(!$book->count()) {
	echo 'No book';
} else {
	foreach ($book->results() as $book) {
		echo $book->author_name, '<br>',
			 $book->title, '<br>',
			 $book->link, '<br>',
		     $book->image, '<br>';
	}
}
?>
				<!-- Page #2 -->					
                <article id="page-contact" class="page-round">
                    <!-- Contact -->
                  
                    <header>
                        <h2>Contact</h2>					
                    </header>
                    <p class="artStyle">Email: <a href="mailto:stevo.joc@gmail.com"  class="cv-hover">stevo.joc@gmail.com</a></p>		
                    <?php
                    if (isset($_POST['submit'])) {                       
                        
                            $userInsert = DB::getInstance()->insert('registered', array('name' => $_POST["name"] ,
                            	'email' => $_POST["email"], 'message' => $_POST["message"]));
                            } else {
                                // an error other than duplicate entry occurred
                                echo "Exception caught:";
                        } 
                        ?>     
                    <form method="post" action="#page-contact">
                        <label class="name">Name</label>
                        <input class="name" name="name" type="text" placeholder="Type Here">
                        <label class="email">Email</label>
                        <input class="email" name="email" type="email" placeholder="Type Here">
                        <label class="human">*What is 2+2? (Anti-spam)</label>
                        <input class="human" name="human" placeholder="Type Here">
                        <div id="message">
                            <label>Message</label>
                            <textarea name="message" placeholder="Type Here"></textarea>
                            <input id="submit" name="submit" type="submit" value="submit">					
                        </div>
                    </form>
                 				
                </article>
                </body>
</html>