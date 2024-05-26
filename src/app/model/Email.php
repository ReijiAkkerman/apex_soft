<?php
    namespace project\model;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    class Email {
        public static function sendEmail(
            string $from_email,
            string $from_name,
            string $title,
            string $message
        ): void {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'mail.hosting.reg.ru';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'admin@aniproject.ru';
            $mail->Password = 'KisaragiEki4.';

            $mail->setFrom('admin@aniproject.ru', '1c-apexsoft.ru');
            $mail->addAddress($from_email, $from_name);
            $mail->Charset = 'UTF-8';
            $mail->Subject = '=?UTF-8?B?' . base64_encode($title) . '?=';
            $mail->Body = $message;

            // $mail->send();
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
            }
        }
    }