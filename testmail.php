
<?php
			// the message
								
								ini_set( 'display_errors', 1 );
    							error_reporting( E_ALL );
							$msg = "First line of text\nSecond line of text";
							
							// use wordwrap() if lines are longer than 70 characters
							$msg = wordwrap($msg,70);
							$from = "it-dept@vasitars.com";
							$headers = "From:".$from;
							
							// send email
							mail("rahul_mahanot@vasitars.com","My subject",$msg,$headers);
							echo "The email message was sent.";
?>