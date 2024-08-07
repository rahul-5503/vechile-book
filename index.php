<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// PHPMailer library is required for SMTP email sending
header("Access-Control-Allow-Origin: *"); 
// Other headers you might need
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Check if it's a preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Return response for preflight request
    header("HTTP/1.1 200 OK");
    exit();
    }

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
// Sanitize form inputs

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the form with id "form2" was submitted
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'form1') {
        try{
        $name = filter_var($_POST['text-ab'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email-ab'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone-ab'], FILTER_SANITIZE_NUMBER_INT);
    $passenger = filter_var($_POST['passenger-ab'], FILTER_SANITIZE_STRING);
    $startloc = filter_var($_POST['fromplace-ab'], FILTER_SANITIZE_STRING);
    $endloc = filter_var($_POST['toplace-ab'], FILTER_SANITIZE_STRING);
    $date = filter_var($_POST['date-ab'], FILTER_SANITIZE_STRING);
    $time = filter_var($_POST['time-ab'], FILTER_SANITIZE_STRING);
    

    $mail->isSMTP();
    $mail->Host       = 'sh022.hostgator.in';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support@*****.com'; // Your Gmail address
    $mail->Password   = '************'; // Your Gmail password
    $mail->SMTPSecure = 'ssl';
    $mail->Port       =  465;

    //Recipients
    $mail->setFrom($email, 'Your Name');
    $mail->addAddress('support@*******.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Subject = 'New message from your website';
    $mail->Body    = "Name: $name\n, ";
    $mail->Body   .= "Email: $email\n, ";
    $mail->Body   .= "Phone: $phone\n, ";
    $mail->Body   .= "Passenger: $passenger\n, ";
    $mail->Body   .= "Start Location: $startloc\n, ";
    $mail->Body   .= "End Location: $endloc\n, ";
    $mail->Body   .= "Date: $date\n, ";
    $mail->Body   .= "Time: $time\n, ";
    $mail->send();
    if($email){
       
       $response = array("success" => true, "message" => "Form data received and processed successfully!");
       http_response_code(200);
 http_response_code(200);

   echo json_encode($response);
    }else{
        http_response_code(400);
        echo"error";
    }
    
    
} catch (Exception $e) {
    http_response_code(400);
}


    }elseif(isset($_POST['form_type']) && $_POST['form_type'] === 'form2'){

        
        try{
            $name = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $passenger = filter_var($_POST['passenger'], FILTER_SANITIZE_STRING);
    $startloc = filter_var($_POST['fromplace'], FILTER_SANITIZE_STRING);
    $endloc = filter_var($_POST['toplace'], FILTER_SANITIZE_STRING);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
    
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'sh022.hostgator.in';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@******.com'; // Your Gmail address
        $mail->Password   = '***********'; // Your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       =  465;
    
        //Recipients
        $mail->setFrom($email, 'Your Name');
        $mail->addAddress('support@******.com', 'Recipient Name');
    
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Test Email';
        $mail->Subject = 'New message from your website';
        $mail->Body    = "Name: $name\n";
        $mail->Body   .= "Email: $email\n";
        $mail->Body   .= "Phone: $phone\n";
        $mail->Body   .= "Passenger: $passenger\n";
        $mail->Body   .= "Start Location: $startloc\n";
        $mail->Body   .= "End Location: $endloc\n";
        $mail->Body   .= "Date: $date\n";
        $mail->Body   .= "Time: $time\n";
        $mail->send();
        if($email){
           
           $response = array("success" => true, "message" => "Form data received and processed successfully!");
           http_response_code(200);
    // Example: Sending an error response
    // $response = array("success" => false, "message" => "Error: Failed to process form data!");
     http_response_code(200);
    
       echo json_encode($response);
        }else{
            http_response_code(400);
            echo"error";
        }
        
        
    } catch (Exception $e) {
        http_response_code(400);
    }
    
    }
    
}

?>
