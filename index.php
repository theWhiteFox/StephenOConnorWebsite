<?php

require_once 'core/init.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

      <!-- {{ mustache.js }} placeholders to target different JSON elements -->
      <script id="characterstpl" type="text/template">      
      {{#characters}}
      <div class="character">
         <img src="images/{{shortname}}_tn.jpg" alt="Photo of {{name}}" />
         <h3>{{name}}</h3>
         <h4>{{reknown}}</h4>
         <p>{{bio}}</p>
       </div>
         {{/characters}}
      </script>
      <link href="css/styley.min.css" rel="stylesheet" type="text/css"/>
      <link href="css/styleCar.css" rel="stylesheet" type="text/css"/>
      <!-- https://cdnjs.com/-->
      <script src="js/libs/jquery/jquery.js" type="text/javascript"></script>      
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.cycle/3.03/jquery.cycle.all.min.js" type="text/javascript"></script>
      <script src="js/libs/mustache.js/mustache.js" type="text/javascript"></script>

      <script type="text/javascript">
         $(function () {

            $.getJSON('data.json', function (data) {
               var template = $('#characterstpl').html();
               var html = Mustache.to_html(template, data);
               $('#carousel').html(html);
               
               $('#carousel').cycle({
                  fx: 'fade',
                  pause: 1,
                  next: '#next_btn',
                  prev: '#prev_btn',
                  speed: 500,
                  slideResize: true,
                 containerResize: false,
                 width: '100%',
                 fit: 1,
                  timeout: 10000                  
               }); // cycle.js 
            }); // getJSON            
         }); // function
      </script>
</head>
<body>

<div id="content">
                <!-- Page #1 -->
                <article id = "page-projects" class="page-round">

                    <!-- Page Project -->
                    <div class="pageStyle">
      
      <div id="characterbox"> 
          <a href ="#" id="prev_btn">&laquo;</a>
          <a href ="#" id="next_btn">&raquo;</a>
         <a href="https://github.com/Stevo5o/JSON-Carousel">
            <img id="git" src="images/github.png" alt="github"/></a> 
         <h2>Projects</h2>                 
         <div id="carousel"></div>          
      </div>
      <br>
</div>
</article>


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
</div>
                </body>
</html>