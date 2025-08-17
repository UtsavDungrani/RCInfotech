<?php
include './config/config.php';
session_start();

// If user is not logged in then redirect to login page
if (!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
  header("Location: login");
  exit;
}

// Ensure the email is set in the session after login
if (!isset($_SESSION["email"]) || $_SESSION["email"] === "") {
  echo "<script>" . "alert('Email not found in session. Please log in again.');" . "</script>";
  header("Location: login");
  exit;
}

// Fetch services from database
$stmt = $link->prepare("SELECT id, name FROM services");
$stmt->execute();

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Always fetch user info for the logged-in user
$email = $_SESSION["email"];
$user_info = "SELECT * FROM users WHERE email = '$email'";
$user_result = $link->query($user_info);
$user_row = $user_result ? $user_result->fetch(PDO::FETCH_ASSOC) : null;

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $fname = $_POST["frm_name"];
  $lname = $_POST["frm_lname"];
  $mobile = $_POST["frm_contact"];

  // Validate Indian mobile number
  if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
    echo "<script>" . "alert('Please enter a valid 10-digit Indian mobile number starting with 6-9');" . "</script>";
    exit;
  }

  $services = $_POST["frm_services"];
  $description = $_POST["frm_descri"];
  $email = $_SESSION["email"]; // Email from the session (logged-in user)

  // Use PDO prepared statement
  $sql = "INSERT INTO bookser (fname, lname, email, mobile, subject, description, status) 
            VALUES (?, ?, ?, ?, ?, ?, 'pending')";
  $stmt = $link->prepare($sql);
  $result = $stmt->execute([$fname, $lname, $email, $mobile, $services, $description]);

  if ($result) {
    // Get the last inserted booking ID
    $booking_id = $link->lastInsertId();

    // Send confirmation email
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
      $recipient_email = !empty($form_email) ? $form_email : $email;
      $mail->addAddress($recipient_email, $fname . ' ' . $lname);

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Service Booking Confirmation - IT Next';
      $mail->Body = "
        <html>
        <head>
          <style>
            body { 
              font-family: Arial, sans-serif; 
            }
            table { 
              border-collapse: collapse; 
              width: 100%; 
              max-width: 600px; 
            }
            td { 
              padding: 8px; 
              border: 1px solid #ddd; 
            }
            .strong { 
              font-weight: bold; 
            }
          </style>
        </head>
        <body>
          <h2>Service Booking Confirmation</h2>
          <p>Dear {$fname} {$lname},</p>
          <p>Thank you for booking a service with IT Next. Here are your booking details:</p>
          <table>
            <tr>
              <td class='strong'>Service:</td>
              <td>{$services}</td>
            </tr>
            <tr>
              <td class='strong'>Description:</td>
              <td>{$description}</td>
            </tr>
            <tr>
              <td class='strong'>Contact Number:</td>
              <td>{$mobile}</td>
            </tr>
          </table>
          <p>Your service request has been received and is currently pending. We will review it and update you on any status changes.</p>
          <p>You can track your service request status in the 'Booked Services' section of your account.</p>
          <p>Best regards,<br>IT Next Team</p>
        </body>
        </html>";
      $mail->AltBody = "Plain text version of your email";

      $mail->send();
    } catch (Exception $e) {
      error_log("Email sending failed: " . $mail->ErrorInfo);
    }

    // Redirect to service_success.php with the booking ID
    header("Location: service_success?booking_id=" . $booking_id);
    exit;
  } else {
    echo "<script>" . "alert('Something Went Wrong.');" . "</script>";
  }
}
?>
<?php include 'csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>RCInfotech</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- site icons -->
  <link rel="icon" href="images/logos/logo-1.png" type="image/gif" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- Site css -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- responsive css -->
  <link rel="stylesheet" href="css/responsive.css" />
  <!-- colors css -->
  <link rel="stylesheet" href="css/colors1.css" />
  <!-- custom css -->
  <link rel="stylesheet" href="css/custom.css" />
  <!-- wow Animation css -->
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/all.min.css">
  <!-- revolution slider css -->
  <link rel="stylesheet" type="text/css" href="revolution/css/settings.css" />
  <link rel="stylesheet" type="text/css" href="revolution/css/layers.css" />
  <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css" />
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="default_theme" class="it_service">
  <!-- loader -->
  <div class="bg_load"> <img class="loader_animation" src="images/loaders/loader.gif" alt="#" /> </div>
  <!-- end loader -->
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- end header -->
  <!-- inner page banner -->
  <?php include 'breadcrumbs.php'; ?>
  <!-- end inner page banner -->
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="full">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="main_heading text_align_center">
                  <h2>Make Appointment</h2>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 appointment_form">
                <div class="form_section">
                  <form class="form_contant" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <fieldset class="row">
                      <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input class="field_custom" placeholder="First Name*" type="text" required name="frm_name" />
                      </div>
                      <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input class="field_custom" placeholder="Last Name" type="text" required name="frm_lname" />
                      </div>
                      <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input class="field_custom" placeholder="Email" type="email" name="frm_email"
                          value="<?php echo $_SESSION['email'] ?>" readonly />
                      </div>
                      <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input class="field_custom" placeholder="Phone Number" type="tel" required name="frm_contact"
                          pattern="^[6-9][0-9]{9}$" maxlength="10"
                          onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                          title="Please enter valid 10 digit Indian mobile number starting with 6-9"
                          value="<?php echo isset($user_row["phone"]) ? htmlspecialchars($user_row["phone"]) : '' ?>" />
                      </div>
                      <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <select class="field_custom" name="frm_services" required>
                          <option value="">Select a Service</option>
                          <?php
                          foreach ($services as $row) {
                            echo "<option value='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'>" . htmlspecialchars($row['name']) . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <textarea class="field_custom" placeholder="Description" required name="frm_descri"></textarea>
                      </div>
                      <div class="center">
                        <button class="btn main_bt" type='submit' name='submit' class='btn-green'
                          value='Book Services'>SUBMIT NOW</button>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->
  <?php include 'testimonial.php'; ?>
  <!-- end section -->
  <!-- end section -->
  <!-- footer -->
  <?php include 'footer.php'; ?>
  <!-- end footer -->
  <!-- js section -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- menu js -->
  <script src="js/menumaker.js"></script>
  <!-- wow animation -->
  <script src="js/wow.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <script src="js/security.js"></script>
  <script src="js/form_validation.js"></script>
</body>

</html>