<?php
include('connection/connection.php');
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <?php
        include ('./components/header_link.php');
        ?>
</head>

<body>
    <!-- heared area end -->


    <!-- breadcumb-area start -->
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloder-wrap -->
    <?php
        include('components/header.php');
        ?>
    <!-- heared area end -->

    <!-- breadcumb-area start -->
    <div class="breadcumb-area black-opacity bg-img-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcumb-wrap">
                        <h2>Services</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcumb-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>/</li>
                            <li>Service</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->

    <!-- .service-area start -->
    <section class="service-area ptb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 wow fadeInUp">
                    <div class="section-title text-center">
                        <h2 style="margin-top: 20px;">Our Special Service</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $service_query = "SELECT * FROM `services` where ser_status = 1";
                    $result = mysqli_query($con, $service_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp" data-wow-delay=".2s">
                    <div class="service-wrap">
                        <div class="service-img">
                            <img src="admin/<?= $row['pict'] ?>" alt="" />
                        </div>
                        <div class="service-content">
                            <h3><?= $row['service_tittle'] ?></h3>
                            <p><?= $row['description'] ?></p>
                            <a href="contact.php">Contact us</a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                    ?>
            </div>
        </div>
    </section>
    <!-- .service-area end -->
    <!-- footer-area start  -->
    <?php
        include('components/footer.php');
        ?>
    <!-- footer-area end  -->
    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- counterup.main.js -->
    <script src="assets/js/counterup.main.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- jquery.waypoints.min.js -->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <!-- jquery.magnific-popup.min.js -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- jquery.slicknav.min.js -->
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- snake.min.js -->
    <script src="assets/js/snake.min.js"></script>
    <!-- wow js -->
    <script src="assets/js/wow.min.js"></script>
    <!-- plugins js -->
    <script src="assets/js/plugins.js"></script>
    <!-- main js -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/dark-mode.js"></script>

</body>

</html>