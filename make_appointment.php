<?php
include './config/config.php';
session_start();

// If user is not logged in then redirect to login page
if (!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
  header("Location: login.php");
  exit;
}

// Ensure the email is set in the session after login
if (!isset($_SESSION["email"]) || $_SESSION["email"] === "") {
  echo "<script>" . "alert('Email not found in session. Please log in again.');" . "</script>";
  header("Location: login.php");
  exit;
}

// Fetch services from database
$stmt = $link->prepare("SELECT id, name FROM services");
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $fname = $_POST["frm_name"];
  $lname = $_POST["frm_lname"];
  $form_email = $_POST["frm_email"];
  $mobile = $_POST["frm_contact"];

  // Validate Indian mobile number
  if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
    echo "<script>" . "alert('Please enter a valid 10-digit Indian mobile number starting with 6-9');" . "</script>";
    exit;
  }

  $services = $_POST["frm_services"];
  $description = $_POST["frm_descri"];
  $booked_by_email = $_SESSION["email"]; // Email from the session (logged-in user)

  // Use PDO prepared statement
  $sql = "INSERT INTO bookser (fname, lname, email, mobile, subject, description, booked_by_email, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
  $stmt = $link->prepare($sql);
  $result = $stmt->execute([$fname, $lname, $form_email, $mobile, $services, $description, $booked_by_email]);

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
      $recipient_email = !empty($form_email) ? $form_email : $booked_by_email;
      $mail->addAddress($recipient_email, $fname . ' ' . $lname);

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Service Booking Confirmation - IT Next';
      $mail->Body = "
            <html>
            <body style='font-family: Arial, sans-serif;'>
                <h2>Service Booking Confirmation</h2>
                <p>Dear {$fname} {$lname},</p>
                <p>Thank you for booking a service with IT Next. Here are your booking details:</p>
                <table style='border-collapse: collapse; width: 100%; max-width: 600px;'>
                    <tr>
                        <td style='padding: 8px; border: 1px solid #ddd;'><strong>Service:</strong></td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>{$services}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border: 1px solid #ddd;'><strong>Description:</strong></td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>{$description}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border: 1px solid #ddd;'><strong>Contact Number:</strong></td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>{$mobile}</td>
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
    header("Location: service_success.php?booking_id=" . $booking_id);
    exit;
  } else {
    echo "<script>" . "alert('Something Went Wrong.');" . "</script>";
  }
}
?>
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
  <style>
    .button {
      font-size: 15px;
      font-weight: bold;
      border-radius: 5px;
    }

    .loader_animation {
      animation: none;
    }

    .grp_btn {
      margin-top: 13px;
    }

    /* Dropdown styles */
    .menu_side .first-ul li {
      position: relative;
    }

    .menu_side .first-ul li:hover .dropdown-menu {
      display: block;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: #fff;
      min-width: 200px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      padding: 0;
      margin: 0;
      border-radius: 4px;
    }

    .dropdown-menu li {
      display: block;
      width: 100%;
    }

    .dropdown-menu li a {
      display: block;
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .dropdown-menu li a:hover {
      background: #039ee3;
      color: #fff;
    }

    .menu_side .first-ul li.shop-dropdown>a:after {
      content: '\f107';
      font-family: FontAwesome;
      margin-left: 5px;
    }

    .footer_mail-section .field input {
      max-width: 210px;
    }

    .float-right2 {
      gap: 10px;
    }

    .make_appo .btn.white_btn {
      margin-right: 10px;
    }

    @media only screen and (max-width: 767px) {
      .grp_btn {
        margin-bottom: 10px !important;
      }

      .make_appo {
        margin: 0 !important;
      }

      .make_appo .btn {
        width: 160px !important;
        padding: 0 10px !important;
        font-size: 12px !important;
        margin: 0 !important;
        white-space: nowrap;
      }

      .float-right2 {
        justify-content: center !important;
        gap: 18px !important;
        padding: 0 10px !important;
      }

      /* Make logo smaller and adjust header layout */
      .logo {
        text-align: center;
        padding: 5px 0;
      }

      .logo img {
        max-width: 100px !important;
        height: auto !important;
      }

      #navbar_menu.small-screen #menu-button {
        top: -90px;
      }

      .menu_side .first-ul li.shop-dropdown>a:after {
        display: none;
      }

      .footer_blog .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 columns */
        gap: 20px;
        /* Space between columns */
      }

      .footer_blog .col-md-6 {
        width: 100%;
        /* Full width for each column */
      }

      .footer_blog .col-md-6:nth-child(1) {
        grid-row: 1;
        /* Social media and additional links in the first row */
      }

      .footer_blog .col-md-6:nth-child(2) {
        grid-row: 1;
        /* Services and contact us in the first row */
      }

      .footer_blog .col-md-6:nth-child(3) {
        grid-row: 2;
        /* Move to the second row if needed */
      }

      .footer_blog .col-md-6:nth-child(4) {
        grid-row: 2;
        /* Move to the second row if needed */
      }

      .footer_blog .col-md-6:nth-child(1),
      .footer_blog .col-md-6:nth-child(3) {
        width: 130%;
      }

      .footer_mail-section .field input {
        max-width: 160px;
      }

      .contact_us_section {
        margin-top: -75px;
        margin-bottom: 15px;
      }

      .contact_us_section h2 {
        font-size: 24px;
      }
    }
  </style>
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
                        <input class="field_custom" placeholder="Email (Optional)" type="email" name="frm_email" />
                      </div>
                      <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input class="field_custom" placeholder="Phone Number" type="tel" required name="frm_contact"
                          pattern="^[6-9][0-9]{9}$" maxlength="10"
                          onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                          title="Please enter valid 10 digit Indian mobile number starting with 6-9" />
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
                  <!-- <form <?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class='frm'>
                    <h1>PHP - MySQL CRUD</h1>
                    <hr>
                    <div class='group'>
                      <label>Name : </label>
                      <input type='text' name='frm_name' required>
                    </div>
                    <div class='group'>
                      <label>Email : </label>
                      <input type='email' name='frm_email' required>
                    </div>
                    <div class='group'>
                      <label>Contact : </label>
                      <input type='text' name='frm_contact' required>
                    </div>
                    <div class='group'>
                      <input type='submit' name='submit' class='btn-green' value='Save Details'>
                    </div>
                  </form> -->
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
  <!-- section -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="contact_us_section">
              <div class="call_icon">
                <img src="images/it_service/phone_icon.png" alt="#" />
              </div>
              <div class="inner_cont">
                <h2>REQUEST A FREE QUOTE</h2>
                <p>Get answers and advice from people you want it from.</p>
              </div>
              <div class="button_Section_cont">
                <a class="btn dark_gray_bt" href="contact.php">Contact us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

  <script>
    // Phone number validation
    document.querySelector('input[name="frm_contact"]').addEventListener('input', function (e) {
      // Remove any non-numeric characters
      this.value = this.value.replace(/[^0-9]/g, '');

      // Ensure first digit is 6-9
      if (this.value.length > 0) {
        const firstDigit = parseInt(this.value[0]);
        if (firstDigit < 6) {
          this.value = '';
        }
      }
    });

    // Prevent paste of non-numeric characters
    document.querySelector('input[name="frm_contact"]').addEventListener('paste', function (e) {
      e.preventDefault();
      const pastedText = (e.clipboardData || window.clipboardData).getData('text');
      if (/^[6-9][0-9]*$/.test(pastedText)) {
        this.value = pastedText.slice(0, 10);
      }
    });
  </script>
  <!-- zoom effect -->
  <script src="js/hizoom.js"></script>
  <script>
    $(".hi1").hiZoom({
      width: 300,
      position: "right",
    });
    $(".hi2").hiZoom({
      width: 400,
      position: "right",
    });
  </script>
  <script src="js/security.js"></script>
</body>

</html>