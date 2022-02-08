<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

$name = $_POST['name'];
$email = $_POST['email'];
$location = $_POST['location'];
if ($_POST['phone']){
  $phone = $_POST['phone'];
} else {
  $phone = "No phone number";
}
$message = $_POST['message'];
$nameError = "";
$emailError = "";
$emailRegex = "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)";
function refill() {echo "\nPlease re-fill the form" . "<a href='contact.html' style='text-decoration:none;color:#7f8c8d;text-align:center;'> Re-fill</a>";}

if (!preg_match("/^[a-zA-Z ]*$/",$name))
{
$nameError = "Only letters and white space allowed\n";
echo $nameError;
die(refill());
} else if ( !($name=='') && !($email=='') && !($location=='') && !($message=='') && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
    $emailError = "Enter a valid email address \n";
    echo $emailError;
    die(refill());
} else {
    $formcontent="From: $name \n Message: $message \n At: $location \n Phone: $phone";

    $recipient = "gastrolinktrading@gmail.com";
    $subject = "Contact Form";
    $mailheader = "From: $email \r\n";

    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
    echo "Thank You!" . " -" . "<a href='home.html' style='text-decoration:none;color:#7f8c8d;text-align:center;'> Return Home</a>";
  }
?>
