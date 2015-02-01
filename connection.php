<?php
/*** mysql hostname ***/		

						/*** mysql username ***/
						$username = 'root';

						/*** mysql password ***/
						$password = '';

						try {
						
						 $dbh = new PDO('mysql:host=localhost;dbname=register', $username, $password, array(
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_EMULATE_PREPARES => false,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));							
							/*** echo a message saying we have connected ***/						
							}
						catch(PDOException $e)
							{
							echo $e->getMessage();
							}				