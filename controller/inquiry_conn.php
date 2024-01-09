<?php
include '../connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (isset($_POST['clientInquirySubmit'])) {
    // Retrieve form data
    $clientEmail = mysqli_real_escape_string($conn, $_POST['clientEmail']);
    $clientName = mysqli_real_escape_string($conn, $_POST['clientName']);
    $clientNumber = mysqli_real_escape_string($conn, $_POST['clientNumber']);
    $clientRegion = mysqli_real_escape_string($conn, $_POST['clientRegion']);
    $clientwo = mysqli_real_escape_string($conn, $_POST['clientWO']);
    $clientComment = mysqli_real_escape_string($conn, $_POST['clientComment']);
    $clientPreferredContact = mysqli_real_escape_string($conn, $_POST["inlineRadioOptions"]);


    // Prepare and execute the SQL INSERT statement using prepared statements
    $sql = "INSERT INTO inquiry (client_email, client_name, client_number, client_region, client_wo, client_comment, preferred_contact)
                        VALUES ('$clientEmail', '$clientName', '$clientNumber', '$clientRegion', $clientwo, '$clientComment', '$clientPreferredContact')";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) == 1) {

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'truelinkcompany@fuyouhin-kaishuu.com';
            $mail->Password   = 'Superman#1234';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('truelinkcompany@fuyouhin-kaishuu.com', 'TrueLink Company');
            $mail->addAddress($clientEmail,$clientName);

            //Content
            $mail->isHTML(false);
            $mail->Subject = 'Thank you for your Inquiry';
            $mail->Body    = "
Dear " . $clientName . "

ご連絡いただき、誠にありがとうございます。お問い合わせいただいたサービスに関する情報について、当社の担当者が迅速にご連絡差し上げます。お客様のご要望にお応えできるよう、心よりお手伝いさせていただきます。

何かご質問やご不明点がございましたら、どうぞお気軽にお知らせください。誠心誠意、サポートさせていただきます。
 
何よりも、当社のサービスに興味を持っていただき、誠にありがとうございます。今後とも、ご協力いただけますことを心よりお待ちしております。

どうぞよろしくお願いいたします。

敬具、

佐瀬蛍
不用品回収代行サービス
070-4797-8099";
            $mail->send();
             header('location:../?inquiry=success inquiry');

        } catch (Exception $e) {
            // header("location:./?status=Mail System has an error! Contact NexGen IT Solutions");
        }
    } else {
        header('location:../?inquiry=failed to inquire');
    }
}
