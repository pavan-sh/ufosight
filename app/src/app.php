<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/validation.php';

use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

if ($_SERVER['REQUEST_METHOD']==='POST') {

//trim whitespaces & do sanitization 
$date = trim($_POST['date']);
$email = trim($_POST['email']);
$sight = trim($_POST['sight']);
$date_val = $date;

$date_validator = Validator::date('d-m-Y')->notEmpty();
$email_validator = Validator::email()->notEmpty();
$sight_validator = Validator::stringType()->length(1, 750);

try {
$date_validator->assert($date);
$email_validator->assert($email);
$sight_validator->assert($sight);
echo "<div class='head'>Message:</div>";
echo "<div class='class-out'><p>Date: ".date('F jS Y', strtotime($date))."</p>";
echo "<p>Email: ".$email."</p>";
echo "<p>Description: ".$sight."</p></div>";
} catch (NestedValidationException $e) {
	echo '<ul>';
foreach ($e->getMessages() as $message) {
	echo "<li>$message</li>";
	}
echo '</ul>';
}
}