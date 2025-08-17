<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
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

  <!-- section -->
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12">
              <div class="full margin_bottom_30">
                <div class="accordion border_circle">
                  <div class="bs-example">
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                              aria-controls="collapseOne">
                              1. When We Power On Button And also we Don't see Windows Display Why???
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <p>Here are some things you can try:
                              Restart your PC several times to launch the Windows Startup Automatic Repair screen.
                              Reset your BIOS.
                              To do this, remove the CMOS battery powering the BIOS on your motherboard and reinsert it.
                              Boot in safe mode. Safe mode can help uninstall new programs or drivers that could be
                              affecting your laptop.
                              Disconnect external display devices or docks.
                              Try reseating all of these to make sure they're connected.
                              Try using them in another computer to check they're working properly.
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                              aria-controls="collapseTwo">
                              2. If Pc Not Working?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>Unplug the computer from wherever it's currently plugged in and plug it directly into a
                              wall outlet, bypassing the UPS, surge suppressor, or power strip. If nothing still
                              happens, make sure that outlet works by plugging something else into it, like a desk lamp,
                              and confirming it turns on. </p>
                            <p>Other things you can try include:
                              Trying a different power source
                              Checking your monitor connection
                              Disconnecting your devices
                              Listening for beeps
                              Restoring your computer to previous settings
                              Checking for unresponsive apps
                              Unplugging USB devices
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                              aria-expanded="false" aria-controls="collapseThree">
                              3. What if display of Monitor not working?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>Turn off the computer and the monitor. Unplug the video cable which connects the monitor
                              to the computer. Check the video port on the computer and the monitor, and the video cable
                              if they are damaged or the pins are bent. If there is no damage, reconnect the monitor
                              to the computer.</p>
                            <p>Other things you can try include:
                              Reconnecting the video cable between the monitor and the computer
                              Attaching the monitor to different computer
                              Trying different screen resolutions
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                              aria-expanded="false" aria-controls="collapseFour">
                              4. What Is The Solution For Blue Screen Error?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>These errors can be caused by both hardware and software issues. If you added new
                              hardware to your PC before the Blue Screen error, shut down your PC, remove the hardware,
                              and try restarting. If you're having trouble restarting, you can start your
                              PC in safe mode.</p>
                            <p>A blue screen error, also known as a stop error or fatal system error, occurs when
                              Windows encounters a "STOPError" and crashes. This can be caused by hardware issues or
                              issues with low-level software running in the Windows kernel.</p>
                            <p>Here are some things you can try to fix a blue screen error:
                              Shut down your PC and disconnect any devices
                              Reboot in safe mode
                              Uninstall the software that is causing the error
                              Roll back driver updates
                              Run a malware scan
                              Check for damage
                              Review your RAM
                              Perform a hard reset
                              Run a hardware diagnostic test
                              Boot into safe mode with networking
                              Run the blue screen troubleshooter using SupportAssist
                              Repair the missing or corrupted Windows system files
                              Update the BIOS and drivers
                              Restore the computer using Windows System Restore
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                              aria-expanded="false" aria-controls="collapseFive">
                              5. What Is The Reason For Computer restarting Automatic?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>You can also try these steps:
                              Force power-off your Windows system
                              Remove peripherals and clean boot Windows
                              End unresponsive processes
                              Update your device drivers
                            </p>
                            <p>You can also try these steps to disable automatic restarts in Windows 11:
                              Open the Group Policy Editor (gpedit.msc)
                              Go to Administrative Templates > Windows Components > Windows Update
                              Double-click on "No auto-restart with logged on users for scheduled automatic updates
                              installations"
                              Select Enabled, and then select OK
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false"
                              aria-controls="collapseSix">
                              6. What Is The Solution For No Power In CPU?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>There could be several reasons why your computer is not turning on: Power supply failure:
                              The power supply unit (PSU) may have failed, which could cause the computer to not turn on
                              or not function properly. Motherboard issue: If the motherboard is damaged or has failed,
                              it can prevent the computer from starting up. </p>
                            <p>Other fixes
                              Try these other fixes:
                              Check for beep codes
                              Check for display issues
                              Check unusual BIOS settings
                              Disconnect non-essential devices
                              Check for malware
                              Check your monitor connection
                              Restore your computer to previous settings
                              Check for unresponsive apps
                              Unplug USB devices
                            </p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="center"><a class="btn sqaure_bt" href="feedback">Feedback Form</a></div>
            <div class="mt_30 flex_3">
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si1.png" alt="#" /></div>
                  <h4 class="service-heading">Fast service</h4>
                  <p>You get fast service within 2 hour responce.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si2.png" alt="#" /></div>
                  <h4 class="service-heading">Secure payments</h4>
                  <p>Your payment and account detail will be safe.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si3.png" alt="#" /></div>
                  <h4 class="service-heading">Expert team</h4>
                  <p>We have hired expert team to provide best services.</p>
                </div>
              </div>
            </div>
            </div>
            <div class="col-md-12">
              <div class="full mt_15">
                <h3>Need file recovery?</h3>
                <p>The process of restoring access to files that have been lost due to user error, storage corruption,
                  or unexpected outages. This is done by putting together the remaining fragments, rebuilding from
                  what's left, or using backups.</p>
                <p><a class="btn main_bt" href="#">Read More</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="side_bar">
            <div class="side_bar_blog">
              <h4>SEARCH</h4>
              <div class="side_bar_search">
                <div class="input-group stylish-input-group">
                  <input class="form-control" placeholder="Search" type="text" />
                  <span class="input-group-addon">
                    <button type="submit">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
            <div class="side_bar_blog">
              <h4>GET A QUOTE</h4>
              <p>
                Computers make it easier to do a lot of things, but most of the things they make it easier to do don't
                need to be done.
              </p>
              <a class="btn sqaure_bt" href="service.html">View Service</a>
            </div>
            <div class="side_bar_blog">
              <h4>OUR SERVICE</h4>
              <div class="categary">
                <ul>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Data recovery</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Computer repair</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Mobile service</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Network solutions</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Technical support</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="side_bar_blog">
              <h4>RECENT NEWS</h4>
              <div class="categary">
                <ul>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Land lights let be
                      divided</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Seasons over bearing
                      air</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Greater open after
                      grass</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Gathered was divide
                      second</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="side_bar_blog">
              <h4>TAG</h4>
              <div class="tags">
                <ul>
                  <li><a href="#">Bootstrap</a></li>
                  <li><a href="#">HTML5</a></li>
                  <li><a href="#">Wordpress</a></li>
                  <li><a href="#">Bootstrap</a></li>
                  <li><a href="#">HTML5</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end section -->
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
  <!-- revolution js files -->
  <script src="revolution/js/jquery.themepunch.tools.min.js"></script>
  <script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
  <script src="js/security.js"></script>
  <script src="js/accordion.js"></script>

</body>

</html>