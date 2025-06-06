<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/autoload.php';

// Check authentication
checkAdminAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    try {
        // First, get the service request details
        $stmt = $link->prepare("SELECT * FROM bookser WHERE id = ?");
        $stmt->execute([$id]);
        $request = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($request) {
            // Update the status
            $update_stmt = $link->prepare("UPDATE bookser SET status = ? WHERE id = ?");
            if ($update_stmt->execute([$status, $id])) {

                // Send email notification about status update
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'rcinfotech11@gmail.com';
                    $mail->Password = 'eolm wbba majw jlaa';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Additional settings to improve deliverability
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ],
                    ];

                    // Recipients
                    $mail->setFrom('rcinfotech11@gmail.com', 'IT Next Services');
                    $mail->addReplyTo('support@rcinfotech.com', 'IT Next Services');

                    // Add recipient email - if form email is provided use that, otherwise use booked_by_email
                    $recipient_email = !empty($request['email']) ? $request['email'] : $request['booked_by_email'];
                    $mail->addAddress($recipient_email, $request['fname'] . ' ' . $request['lname']);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Service Request Status Update - IT Next';

                    // Customize message based on status
                    $status_message = '';
                    $next_steps = '';

                    if ($status === 'approved') {
                        $status_message = 'has been approved';
                        $next_steps = 'Our team will contact you shortly to proceed with the service.';
                    } elseif ($status === 'rejected') {
                        $status_message = 'has been rejected';
                        $next_steps = 'If you have any questions, please contact our support team.';
                    }

                    $mail->Body = "
                    <html>
                    <body style='font-family: Arial, sans-serif;'>
                        <h2>Service Request Status Update</h2>
                        <p>Dear {$request['fname']} {$request['lname']},</p>
                        <p>Your service request for <strong>{$request['subject']}</strong> {$status_message}.</p>
                        <table style='border-collapse: collapse; width: 100%; max-width: 600px;'>
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd;'><strong>Service:</strong></td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$request['subject']}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd;'><strong>Description:</strong></td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$request['description']}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd;'><strong>Current Status:</strong></td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>" . ucfirst($status) . "</td>
                            </tr>
                        </table>
                        <p>{$next_steps}</p>
                        <p>You can track your service request status in the 'Booked Services' section of your account.</p>
                        <p>Best regards,<br>IT Next Team</p>
                    </body>
                    </html>";

                    $mail->AltBody = "Plain text version of your email";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Email sending failed: " . $mail->ErrorInfo);
                }

                header('Location: service_requests.php');
                exit;
            }
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
}

header('Location: service_requests.php');
exit;
?>