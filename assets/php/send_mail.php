<?php
// the message
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
$msg = $_POST['message'];
$msg = str_replace("\n.", "\n..", $msg);
$receiver = $_POST['email'];
$subject = $_POST['subject'];

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70, "\r\n", );

$url = "http://delta.maliliconstruction.systems/assets/scripts/send_mail.php";

$fields = array(
    'msg'=>$msg,
    'receiver'=>$_POST['email'],
    'subject'=>$_POST['subject']
);

$postvars='';
$sep='';
foreach($fields as $key=>$value)
{
    $postvars.= $sep.urlencode($key).'='.urlencode($value);
    $sep='&';
}

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;
