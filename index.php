<?php

require_once 'core/init.php';

// singleton pattern
// $book = DB::getInstance()->query("SELECT * FROM books");

// if(!$book->count()) {
// 	echo 'No book';
// } else {
// 	foreach ($book->results() as $book) {
// 		echo $book->author_name, '<br>',
// 			 $book->title, '<br>',
// 			 $book->link, '<br>',
// 		     $book->image, '<br>';
// 	}
// }

// $userInsert = DB::getInstance()->insert('registered', array(
// 	'name' => 'Stephen',
// 	'email' => 'My Book',
// 	'message' => 'stevo.joc@gmail.com'
// ));

// echo '<br>';

// $user = DB::getInstance()->query("SELECT * FROM users");

// if(!$user->count()) {
// 	echo 'No user';
// } else {
// 	foreach ($user->results() as $user) {
// 		echo $user->first_name, '<br>',
// 			 $user->last_name, '<br>',
// 			 $user->email_address, '<br>';
		     
// 	}
// }

if(Input::exists()) {	
	if(Token::check(Input::get('token'))) {
	$validate = new Validate();
	$validation = $validate->check($_POST, array(
		'name'=> array(
			'required' => true,
			'min' => 2,
			'max' => 20,
			//'unique' => 'register'			
		),
		'email' => array(
			'required' => true,
			'min' => 6,
			'max' => 20						
		),
		'message' => array(
			'required' => true,
			'min' => 6
			)		
	));          

	if($validation->passed()) {		
		echo 'Passed';
		
	}else {
		print_r($validation->errors());
		} // output errors
	}
}

?>
<form action="" method="post">
	<div class="field">
		<label for="name">name</label>
		<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
	</div>
	
	<div class="field">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
	</div>
	
	<div class="field">
		<label for="message">Message</label>
		<input type="text" name="message" id="message" value="<?php echo escape(Input::get('message')); ?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
	<input type="submit" value="Register">
</form>