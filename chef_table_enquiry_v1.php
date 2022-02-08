<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

$name = $_POST['name'];
$email = $_POST['email'];

$message = $_POST['message'];
$error = "";
function refill() {echo "\nPlease re-fill the form" . "<a href='contact.html' style='text-decoration:none;color:#7f8c8d;text-align:center;'> Re-fill</a>";}

function isValidName($name){
  return preg_match("/^[a-zA-Z ]*$/",$name);
}
function isValidEmail($email){
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isInjected($str) {
    $inject = "/(\r|\t|%0A|%0D|%08|%09)+/i";
    return (preg_match($inject, $str) > 0);
}

if(isInjected($name)){
  $error .= "\nBad name value!";
}
if(isInjected($email)){
  $error .= "\nBad email value";
}

try {
  if(!empty($_POST)){
    $emailText = "You have enquiry \n======\n";

    $formcontent="From: $name \n Message: $message";

    $recipient = "tsieneetan@gmail.com";
    $subject = "Contact Form";
    $mailheader = "From: $email \r\n";

    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
    header("Location:https://www.theslurpme.com/chef_table");
  }
} catch (\Exception $e){
  $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}


?>
