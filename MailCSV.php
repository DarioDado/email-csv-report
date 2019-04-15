<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require_once('vendor/phpmailer/PHPMailer.php');
require_once('vendor/phpmailer/SMTP.php');
// require_once('vendor/phpmailer/Exception.php');


class MailCSV {
    
    public function sendCSVEmail($data, $address, $from, $subject, $body) {
        
        //create temporary csv file
        $filename="Website-Report-" . date("F-j-Y") . ".csv";
        $this->createCsvTempFile($data, $filename);

        //attach file and send email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yelpcampdeveloper@gmail.com';
        $mail->Password = 'yelpcamp123';
        $mail->SMTPSecure = 'tls'; //tls
        $mail->Port = 587;        //587
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );


        $mail->setFrom($from);
        $mail->addAddress($address);
        $mail->addAttachment("temp/$filename");
        
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            unlink("temp/$filename");
            return true;
        }

    }

    private function createCsvTempFile($data, $filename) {
        // Open temp file pointer
        $fp = fopen("temp/$filename", 'w+');
        
        // Loop data and write to file pointer
        foreach ($data as $value) {
            fputcsv($fp, $value);
        }
        
        // Place stream pointer at beginning
        rewind($fp);
    }

}

