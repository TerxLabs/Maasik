<?php
require_once './vendor/autoload.php';

$helperLoader = new SplClassLoader('Helpers', './vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './vendor');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;
$config->load('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $phone   = stripslashes(trim($_POST['phone']));
    $message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email)) {
        die("Header injection detected");
    }

    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($name && $email && $emailIsValid && $message) {
        $mail = new SimpleMail();

        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSender($name);
        $mail->setSenderEmail($email);
        $mail->setSubject("Contact Form Details");

        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta charset=\"utf-8\">
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.name')}:</strong> {$name}</p>
                <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>
                <p><strong>{$config->get('fields.phone')}:</strong> {$phone}</p>
                <p><strong>{$config->get('fields.message')}:</strong> {$message}</p>
            </body>
        </html>";

        $mail->setHtml($body);
        $mail->send();

        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Maasik - Contact</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.png" />
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <!-- =============================================================================================-->
    </head>

    <body class="animsition">

        <!-- Header -->
        <header class="header1">
            <!-- Header desktop -->
            <div class="container-menu-header">
                <div class="topbar">
                    <div class="topbar-social">
                        <a href="https://www.facebook.com/Maasik-474606726405149/?ref=br_rs" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram" target="_blank"></a>
                        <!-- <a href="#" class="topbar-social-item fa fa-youtube-play"></a> -->
                        <a href="https://www.linkedin.com/company/maasik/" target="_blank" class="topbar-social-item fa fa-linkedin"></a>
                    </div>

                    <!-- <span class="topbar-child1">
                        Free shipping for standard order over Rs. 500
                    </span> -->

                    <div class="topbar-child2">
                        <span class="topbar-email">
                            info@maasik.in
                        </span>

                        <!-- <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>USD</option>
                                <option>EUR</option>
                            </select>
                        </div> -->
                    </div>
                </div>

                <div class="wrap_header">
                    <!-- Logo -->
                    <a href="index.php" class="logo">
                        <img src="images/icons/logo.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu -->
                    <div class="wrap_menu ml-auto">
                        <nav class="menu">
                            <ul class="main_menu">
                                <li>
                                    <a href="index.php">Home</a>

                                </li>

                                <li>
                                    <a href="about.php">About Us</a>
                                </li>

                                <li>
                                    <a href="product.php">Products</a>
                                </li>

                                <li>
                                    <a href="contact.php">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Header Mobile -->
            <div class="wrap_header_mobile">
                <!-- Logo moblie -->
                <a href="index.php" class="logo-mobile">
                    <img src="images/icons/logo.png" alt="IMG-LOGO">
                </a>

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
            </div>

            <!-- Menu Mobile -->
            <div class="wrap-side-menu">
                <nav class="side-menu">
                    <ul class="main-menu">
                        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                            <div class="topbar-child2-mobile">
                                <span class="topbar-email">
                                    info@maasik.in
                                </span>
                            </div>
                        </li>

                        <li class="item-topbar-mobile p-l-10">
                            <div class="topbar-social-mobile">
                                <a href="https://www.facebook.com/Maasik-474606726405149/?ref=br_rs" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                                <a href="#" class="topbar-social-item fa fa-instagram" target="_blank"></a>
                                <!-- <a href="#" class="topbar-social-item fa fa-youtube-play"></a> -->
                                <a href="https://www.linkedin.com/company/maasik/" target="_blank" class="topbar-social-item fa fa-linkedin"></a>
                            </div>
                        </li>

                        <li class="item-menu-mobile">
                            <a href="index.php">Home</a>
                        </li>

                        <li class="item-menu-mobile">
                            <a href="about.php">About Us</a>
                        </li>

                        <li class="item-menu-mobile">
                            <a href="product.php">Products</a>
                        </li>

                        <li class="item-menu-mobile">
                            <a href="contact.php">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Title Page -->
        <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m background-banner">
            <h2 class="l-text2 t-center">
                Contact
            </h2>
        </section>

        <!-- content page -->
        <section class="bgwhite p-t-66 p-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 p-b-30">
                        <div class="p-r-20 p-r-0-lg">
                            <div class="contact-map size21" id="google_map" data-map-x="40.614439" data-map-y="-73.926781" data-pin="images/icons/icon-position-map.png" data-scrollwhell="0" data-draggable="1"></div>
                        </div>
                    </div>

                    <div class="col-md-6 p-b-30">
                    <?php if(!empty($emailSent)): ?>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="alert alert-success text-center"><?php echo $config->get('messages.success'); ?></div>
                            </div>
                        <?php else: ?>
                            <?php if(!empty($hasError)): ?>
                            <div class="col-md-5 col-md-offset-4">
                                <div class="alert alert-danger text-center"><?php echo $config->get('messages.error'); ?></div>
                            </div>
                        <?php endif; ?>
                        <form id="contact-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" class="leave-comment" method="POST">
                            <h4 class="m-text26 p-b-36 p-t-15">
                                Send us your message
                            </h4>

                            <div class="bo4 of-hidden size15 m-b-20">
                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" id="name" placeholder="Full Name">
                            </div>

                            <div class="bo4 of-hidden size15 m-b-20">
                                <input class="sizefull s-text7 p-l-22 p-r-22" type="number" name="phone-number" id="phone-number" placeholder="Phone Number">
                            </div>

                            <div class="bo4 of-hidden size15 m-b-20">
                                <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" id="email" placeholder="Email Address">
                            </div>

                            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" id="message" placeholder="Message"></textarea>

                            <div class="w-size25">
                                <!-- Button -->
                                <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Send
							</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </section>

        <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-40">


            <div class="w-size19 p-t-30 p-l-15 p-r-25 respon4">
                <h4 class="s-text12 p-b-30">
                    Products
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="product.php" class="s-text7">
							Sanitary Pads
						</a>
                    </li>

                    <!-- <li class="p-b-9">
                        <a href="personal-hygiene.php" class="s-text7">
                            Personal Hygiene
						</a>
                    </li>

                    <li class="p-b-9">
                        <a href="elderly-care.php" class="s-text7">
                            Elderly Care
						</a>
                    </li> -->
                </ul>
            </div>

            <div class="w-size19 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    About Maasik
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="about.php#our-mission" class="s-text7">
							Our Mission
						</a>
                    </li>

                    <li class="p-b-9">
                        <a href="about.php#who-we-are" class="s-text7">
							Who We Are
						</a>
                    </li>

                    <li class="p-b-9">
                        <a href="index.php#about-maasik" class="s-text7">
							About Maasik
						</a>
                    </li>

                    <!-- <li class="p-b-9">
                        <a href="#" class="s-text7">
							FAQs
						</a>
                    </li> -->
                </ul>
            </div>


            <div class="w-size19 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    GET IN TOUCH
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        Any questions? <br/>Let us know at #237, 2nd Floor, JLPL Industrial Area, Sec-82 Mohali, 140301, India or call us on (+1) 96 716 6879
                    </p>

                    <div class="flex-m p-t-30">
                        <a href="https://www.facebook.com/Maasik-474606726405149/?ref=br_rs" target="_blank" class="fs-20 color1 p-r-20 fa fa-facebook"></a>
                        <a href="#" class="fs-20 color1 p-r-20 fa fa-instagram" target="_blank"></a>
                        <!-- <a href="#" class="fs-20 color1 p-r-20 fa fa-youtube-play"></a> -->
                        <a href="https://www.linkedin.com/company/maasik/" target="_blank" class="fs-20 color1 p-r-20 fa fa-linkedin"></a>
                    </div>
                </div>
            </div>

            <!-- <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="effect1 w-size9">
                        <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                        <span class="effect1-line"></span>
                    </div>

                    <div class="w-size2 p-t-20">
                        <!-- Button -->
            <!--<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
                    </div>

                </form>
            </div> -->
        </div>

        <div class="t-center p-l-15 p-r-15">
            <div class="t-center s-text8 p-t-20" style="color:#000000;">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>. All rights reserved. | Made with <i class="fa fa-heart" style="color:red;" aria-hidden="true"></i> by <a href="http://terxlabs.in" style="color:#000000;" target="_blank">TerxLabs</a>
            </div>
        </div>
    </footer>

        <!-- Back to top -->
        <div class="btn-back-to-top bg0-hov" id="myBtn">
            <span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
        </div>

        <!-- Container Selection -->
        <div id="dropDownSelect1"></div>
        <div id="dropDownSelect2"></div>



        <!--===============================================================================================-->
        <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
        <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script type="text/javascript" src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
        <script src="js/map-custom.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>

    </body>

    </html>