<?php
include('connection/connection.php');
if (isset($_REQUEST['msg_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];
    $query = "insert INTO contact_us(name,email,subject,message) values('$name','$email','$subject','$msg')";
    mysqli_query($con, $query);
    header('location:contact.php?sent-msg=1');
}
?>
<!doctype html>
<html class="no-js">

<head>
    <?php
        include ('./components/header_link.php');
        ?>
</head>

<body>
    <!-- heared area start -->
    <?php
        include('components/header.php');
        ?>
    <!-- heared area end -->
    <!-- slider area start -->
    <section class="slider-area">
        <div class="slider-active2 slider-next-prev-style">
            <div class="slider-items">
                <img src="assets/images/slider/1.jpg" alt="" class="slider">
                <div class="slider-content text-center">
                    <div class="table">
                        <div class="table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                                        <h2>Welcome to CMS</h2>
                                        <p>CMS is a program that allows students problems deliver consistent support and
                                            manage complaints in a timely manner.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-items">
                <img src="assets/images/slider/2.jpg" alt="" class="slider">
                <div class="slider-content text-center">
                    <div class="table">
                        <div class="table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                                        <h2>Hello i am CMS</h2>
                                        <p>For an effective educational system to take place there are some issues in
                                            academic environment that should properly address to, take for instance
                                            issue of complaints management system in the university.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider area end -->
    <!-- about-area start -->
    <section class="about-area ptb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12 wow fadeInLeft">
                    <!-- <div class="about-img black-opacity"> -->
                    <div class="about-img mission-img h-250">
                        <img src="assets/images/Mission.svg" alt="Home Mission" />
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 wow fadeInRight">
                    <div class="about-wrap">
                        <h3>Our mission is to give everyone a voice and show them the world.</h3>
                        <p>Students complaint is the best indicator to determine whether a service-oriented university
                            operates well. If a university does not handle its students complaint properly and promptly,
                            further negative students responses will cause major damage to the reputation of the
                            university. </p>
                        <p>Traditionally, written complaints cause communication gap and information asymmetry. Thus,
                            some trouble cases may not be handled properly without real-time decision supports by the
                            higher authority.</p>
                        <ul>
                            <li>Upgrading educational and teaching excellence</li>
                            <li>Enhancing excellence in research</li>
                            <li>Customizing HEI international presence</li>
                            <li>Modernizing the quality of student services</li>
                            <li>Supporting HEI become environmentally friendly universities/colleges</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area end -->
    <!-- .service-area start -->
    <!-- <section class="service-area pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 wow fadeInUp">
                        <div class="section-title text-center">
                            <h2>Our Special Service</h2>
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
                            <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp"  data-wow-delay=".2s">
                                <div class="service-wrap">
                                    <div class="service-img">
                                        <img src="assets/images/service/2.jpg" alt="" />
                                    </div>
                                    <div class="service-content">
                                        <h3><?= $row['service_tittle'] ?></h3>
                                        <p><?= $row['description'] ?></p>
                                        <a href="contact.php" >Contact us</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section> -->
    <!-- .service-area end -->
    <!-- fanfact-area start -->
    <section class="fanfact-area parallax black-opacity" data-speed="5"
        data-bg-image="assets/images/bg/home-section-1.webp">
        <div class="table">
            <div class="table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6 wow fadeInUp" data-wow-delay=".1s">
                            <div class="fanfact-wrap">
                                <h2 class="counter">
                                    <?php
                                        $query = 'SELECT COUNT(`complaint_id`) as result from complaint';
                                        $result1 = mysqli_query($con, $query);
                                        $row1 = mysqli_fetch_array($result1);
                                        echo $row1['result'];
                                        ?>
                                </h2>
                                <p>Total Complains</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 wow fadeInUp" data-wow-delay=".2s">
                            <div class="fanfact-wrap">
                                <h2 class="counter"><?php
                                        $query = 'SELECT COUNT(`complaint_id`) as result from complaint where com_status=1';
                                        $result1 = mysqli_query($con, $query);
                                        $row1 = mysqli_fetch_array($result1);
                                        echo $row1['result'];
                                        ?></h2>
                                <p>Pending Complains</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="fanfact-wrap">
                                <h2 class="counter"><?php
                                        $query = 'SELECT COUNT(`complaint_id`) as result from complaint where com_status=2';
                                        $result1 = mysqli_query($con, $query);
                                        $row1 = mysqli_fetch_array($result1);
                                        echo $row1['result'];
                                        ?></h2>
                                <p>In Progress Complains</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 wow fadeInUp" data-wow-delay=".4s">
                            <div class="fanfact-wrap">
                                <h2 class="counter"><?php
                                        $query = 'SELECT COUNT(`complaint_id`) as result from complaint where com_status=3';
                                        $result1 = mysqli_query($con, $query);
                                        $row1 = mysqli_fetch_array($result1);
                                        echo $row1['result'];
                                        ?></h2>
                                <p>Solved Complains</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- fanfact-area end -->
    <!-- faq-area start -->
    <br><br>
    <div class="faq-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12  wow fadeInUp">
                    <div class="section-title text-center">
                        <h2>Frequently Asked Questions</h2>
                        <p>The majority have suffered alteration in some form, by injected humour, or randomised. by
                            injected humour, or randomised.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12  wow fadeInLeft">
                    <div class="faq-wrap">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            General Inquiries
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>Welcome to the Complain Managment System Help Desk. The Help Desk is here to
                                            answer your questions about the CMS(Complain Managment System). Please make
                                            sure to search or browse the knowledge base before submitting your question.
                                            The answer you are looking for may already be there. Thank you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Mission
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>To promote Higher Education system that may keep pace with developments and
                                            changes in today world, meet the requirements of sustainable development in
                                            the Knowledge Era, while preserving the cultural identity of our society and
                                            contribute to the progress and development of humankind by raising the
                                            quality of institutions of higher education in Punjab.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingfsix">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapsesix" aria-expanded="false"
                                            aria-controls="collapsesix">
                                            Vision
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>We provide holistic quality higher education to all the citizens in an
                                            effective, efficient, and supportive environment to facilitate them in the
                                            achievement of their goals and objectives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 fadeInRight wow">
                    <div class="faq-form form-style">
                        <div class="cf-msg"></div>
                        <form action="mail.php" method="post" id="cf">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span>Name</span>
                                    <input type="text" placeholder="Name" id="name" name="name">
                                </div>
                                <div class="col-xs-12">
                                    <span>Email</span>
                                    <input type="text" placeholder="Email" id="email" name="email">
                                </div>
                                <div class="col-xs-12">
                                    <span>Subject</span>
                                    <input type="text" placeholder="Subject" id="subject" name="subject">
                                </div>
                                <div class="col-xs-12">
                                    <span>Your Questions</span>
                                    <textarea class="contact-textarea" placeholder="Questions" id="msg"
                                        name="msg"></textarea>
                                </div>
                                <div class="col-xs-12">
                                    <button id="msg_btn" class="cont-submit btn-contact btn-style"
                                        onclick="return valid()" name="msg_btn">Questions</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- faq-area end -->
    <!-- praller-area start -->
    <section class="prallex-area black-opacity-bottom parallax ptb-180 wow fadeInUp bg-center" data-speed="3"
        data-bg-image="assets/images/bg/business-people-cafe.webp">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-12">
                    <div class="prallex-wrap text-center">
                        <h2><i class="fa fa-quote-left"></i>Keep away from people who try to belittle your ambitions.
                            Small peol always do that.<i class="fa fa-quote-right"></i></h2>
                        <span><i class="fa fa-long-arrow-left"></i> Brayden Shar <i
                                class="fa fa-long-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- praller-area end -->
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
    <script src="js/toastr.min.js"></script>
    <script src="assets/js/dark-mode.js"></script>

    <!-- main js -->
    <script src="assets/js/scripts.js"></script>
    <script>
    function valid() {
        $('#name, #email, #subject, #msg').css('border', 'solid green 1px');

        var v_name = $('#name').val().trim();
        var v_email = $('#email').val().trim();
        // var v_sub = $('#subject').val().trim();
        var v_msg = $('#msg').val().trim();

        var isValid = true;

        function markInvalid(selector, message) {
            $(selector).css('border', 'solid red 1px').focus();
            toastr.error(message);
            isValid = false;
        }

        if (v_name === '') {
            markInvalid('#name', 'Please enter your name.');
        }
        if (v_email === '' || !/^\S+@\S+\.\S+$/.test(v_email)) {
            markInvalid('#email', 'Please enter a valid email address.');
        }
        // if (v_sub === '') {
        //     if (!confirm("Post message without subject?")) {
        //         markInvalid('#subject', 'Please enter a subject.');
        //     }
        // }
        if (v_msg === '') {
            markInvalid('#msg', 'Please enter your message.');
        }

        return isValid;
    }
    </script>
    <?php
        if (isset($_GET['sent-msg'])) {
            ?>
    <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.success('Message Sent Successfully!');
    </script>
    <?php
        }
        ?>
</body>

</html>