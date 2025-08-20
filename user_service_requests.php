<?php
session_start();

require_once 'config/config.php';

// Check if the user is logged in
if (!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
  header("Location: login");
  exit();
}

// Ensure the email is set in the session after login
if (!isset($_SESSION["email"]) || $_SESSION["email"] === "") {
  echo "<script>" . "alert('Email not found in session. Please log in again.');" . "</script>";
  header("Location: login");
  exit();
}

// Fetch the user's booked services
$email = $_SESSION["email"];
$service_requests = [];
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$total_requests = 0;
try {
  // Count total service requests for pagination
  $count_stmt = $link->prepare("SELECT COUNT(*) FROM bookser WHERE email = :email");
  $count_stmt->execute(['email' => $email]);
  $total_requests = (int) $count_stmt->fetchColumn();

  // Get only 10 service requests for the current page
  $stmt = $link->prepare("SELECT b.*, 
                            CONCAT(b.fname, ' ', b.lname) as booked_for_name,
                            b.email as booked_for_email,
                            b.mobile as booked_for_phone
                            FROM bookser b 
                            WHERE b.email = :email 
                            ORDER BY b.booking_time DESC
                            LIMIT :limit OFFSET :offset");
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $service_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  error_log("Database error: " . $e->getMessage());
}
?>
<?php include 'csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RCInfotech</title>
  <link rel="icon" href="images/logos/logo-1.png" type="image/gif" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <link rel="stylesheet" href="css/colors1.css" />
  <link rel="stylesheet" href="css/custom.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/all.min.css">
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
  <!-- section -->
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_center">
              <h2>My Service Requests</h2>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive-mobile">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Contact Details</th>
                  <th>Address</th>
                  <th>Subject</th>
                  <th>Description</th>
                  <th>Booking Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($service_requests)): ?>
                  <tr>
                    <td colspan="8" class="text-center">No service requests found.</td>
                  </tr>
                <?php else: ?>
                  <?php $index = $offset + 1; ?>
                  <?php foreach ($service_requests as $request): ?>
                    <tr>
                      <td><?php echo $index++; ?></td>
                      <td><?php echo htmlspecialchars($request['booked_for_name']); ?></td>
                      <td>
                        Email: <?php echo htmlspecialchars($request['booked_for_email']); ?><br>
                        Phone: <?php echo htmlspecialchars($request['booked_for_phone']); ?>
                      </td>
                      <td><?php echo htmlspecialchars($request['address']); ?></td>
                      <td><?php echo htmlspecialchars($request['subject']); ?></td>
                      <td><?php echo htmlspecialchars($request['description']); ?></td>
                      <td><?php echo htmlspecialchars($request['booking_time']); ?></td>
                      <td>
                        <?php
                        $status = htmlspecialchars($request['status'] ?? 'Pending');
                        $statusClass = '';
                        if ($status === 'approved') {
                          $statusClass = 'status_approved';
                        } elseif ($status === 'rejected') {
                          $statusClass = 'status_rejected';
                        } elseif ($status === 'pending') {
                          $statusClass = 'status_pending';
                        }
                        ?>
                        <span class="status_display <?php echo $statusClass; ?>">
                          <?php echo ucfirst($status); ?>
                        </span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
      // Pagination links
      $total_pages = ceil($total_requests / $limit);
      if ($total_pages > 1):
        ?>
        <div class="row pagination-margin-top">
          <div class="col-md-12">
            <nav aria-label="Service Requests Pagination">
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo;</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item<?php if ($i == $page)
                    echo ' active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">&raquo;</a></li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- end section -->
  <!-- <div class="section padding_layout_1">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="main_heading text_align_left">
                <h2>Experienced Staff</h2>
                <p class="large">
                  Our experts have been featured in press numerous times.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="full team_blog_colum">
              <div class="it_team_img">
                <img
                  class="img-responsive"
                  src="images/it_service/Utsav.jpg"
                  alt="#"
                  height=343
                />
              </div>
              <div class="team_feature_head">
                <h4>Utsav Dungrani</h4>
              </div>
              <div class="team_feature_social">
                <div class="social_icon">
                  <ul class="list-inline">
                    <li>
                      <a
                        class="fa fa-facebook"
                        href="https://www.facebook.com/"
                        title="Facebook"
                        target="_blank"
                      ></a>
                    </li>
                    <li>
                      <a
                        class="fa fa-google-plus"
                        href="https://plus.google.com/"
                        title="Google+"
                        target="_blank"
                      ></a>
                    </li>
                    <li>
                      <a
                        class="fa fa-twitter"
                        href="https://twitter.com"
                        title="Twitter"
                        target="_blank"
                      ></a>
                    </li>
                    <li>
                      <a
                        class="fa fa-linkedin"
                        href="https://www.linkedin.com"
                        title="LinkedIn"
                        target="_blank"
                      ></a>
                    </li>
                    <li>
                      <a
                        class="fa fa-instagram"
                        href="https://www.instagram.com"
                        title="Instagram"
                        target="_blank"
                      ></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  <!-- section -->
  <?php include 'testimonial.php'; ?>
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
</body>

</html>