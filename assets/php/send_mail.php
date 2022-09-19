<?php
// the message

$msg = $_POST['message'];
$msg = str_replace("\n.", "\n..", $msg);
$receiver = $_POST['email'];
$subject = $_POST['subject'];
if()

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70, "\r\n", );

// send email
if(mail($receiver,$subject,$msg)){
    echo "Email sent successfully!";
}else{
    echo "Email failed to send!";
}

