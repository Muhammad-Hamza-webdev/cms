<?php
include('connection/connection.php');
if (isset($_REQUEST['sub_btn'])) {
    $fnam = $_POST['fname'];
    $lnam = $_POST['lname'];
    $fathernam = $_POST['fathername'];
    $mail = $_POST['email'];
    $add = $_POST['address'];
    $gen = $_POST['gender'];
    $dept = $_POST['department'];
    $phone = $_POST['phone'];
    $check_query = "SELECT * FROM persons where `person_email`='$mail'";
    $result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($result) > 0) {
        header('location:registeration.php?account-already-exist=1');
    } else {


        $qy = "insert into persons(person_name, last_name, father_name, person_email, address, gender,phone) values('$fnam','$lnam','$fathernam','$mail','$add','$gen','$phone')";
        mysqli_query($con, $qy);

        //get max person id
        $max_person = "SELECT max(`person_id`) as max FROM `persons`";
        $result = mysqli_query($con, $max_person);

        while ($row = mysqli_fetch_array($result)) {
            $max_id = $row['max'];
        }

        //insertion in account table
        $account_data = "INSERT INTO accounts(`person_id`,`password`,`user_type`,`department_id`) values('$max_id','" . $_REQUEST['c_pass'] . "','1','$dept')";
        $result2 = mysqli_query($con, $account_data);

        //redirect
        header('location:login.php?account-registered=1');
    }
}
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
    <?php
        include('components/header.php');
        ?>

    <!-- breadcumb-area start -->
    <div class="breadcumb-area black-opacity bg-img-reg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcumb-wrap">
                        <h2>Registeration</h2>
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
                            <li>Registeration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->

    <!-- contact-area start -->
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row box-shadow-light m-0">
                <div class="col-md-6 d-flex h-740">
                    <img src="assets/images/signup.svg" alt="Sign up">
                </div>
                <div class="col-md-6 p-20">
                    <div class="contact-wrap form-style">
                        <h3>Sign Up </h3>
                        <div class="cf-msg"></div>
                        <form method="post" id="cf">
                            <div class="row">
                                <div class="col-xs-12">
                                    <select class="form-control" id="department" name="department"
                                        style="width: 100%; text-indent: 5px;  height: 45px;background-color: white;">
                                        <option value="0">Select Department</option>
                                        <?php
                                            $query = "SELECT * FROM `departments` where `dept_status`=1";
                                            $query = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                        <option value="<?= $row['department_id'] ?>"><?= $row['department'] ?></option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div><br><br>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Frist Name" id="fname" name="fname">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Last Name" id="lname" name="lname">
                                </div>
                                <div class="col-xs-12">
                                    <input type="text" placeholder="Father Name" id="fathername" name="fathername">
                                </div>
                                <div class="col-xs-12">
                                    <input type="email" placeholder="Enter Email" id="email" name="email">
                                </div>
                                <div class="col-xs-12">
                                    <input type="number" placeholder="Enter Phone" name="phone" id="phone">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="password" placeholder="Enter Password" name="pass" id="pass">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="password" placeholder="Confirm Passworde" name="c_pass" id="c_pass">
                                </div>
                                <div class="col-xs-12">
                                    <textarea class="contact-textarea" placeholder="Enter Address" id="address"
                                        name="address"></textarea>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-sm-1 col-xs-12">
                                        <label style="margin-right: 30px; margin-bottom:60px;">Male</label>
                                    </div>
                                    <div class="col-sm-1 col-xs-12">
                                        <input value="1" type="radio" id="gender" name="gender"
                                            style="padding-top: 30px;width: 15px; height: 20px;">
                                    </div>
                                    <div class="col-sm-1 col-xs-12">
                                        <label style="margin-right: 30px; margin-bottom:60px;">Female</label>
                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <input value="0" type="radio" id="gender" name="gender"
                                            style="padding-top: 30px;width: 15px; height: 20px;">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="submit" class="cont-submit btn-contact btn-style"
                                        onclick="return valid()" name="sub_btn" id="sub_btn">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area end -->
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
    <!-- main js -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/dark-mode.js"></script>

    <script>
    function valid() {
        $('#fname, #department, #lname, #fathername, #email, #phone, #pass, #c_pass, #address').css('border',
            'solid green 1px');
        $('input[name="gender"]').css('outline', 'none');

        var isValid = true;

        function markInvalid(selector, message) {
            $(selector).css('border', 'solid red 1px').focus();
            toastr.error(message);
            isValid = false;
        }

        function markGenderInvalid(message) {
            $('input[name="gender"]').css({
                'box-shadow': '0.5px -0.5px 0 1px red',
                'border-radius': '50px'
            });
            toastr.error(message);
            isValid = false;
        }

        function markGenderValid() {
            $('input[name="gender"]').css({
                'box-shadow': '0.5px -0.5px 0 1px green',
                'border-radius': '50px'
            });
        }

        var phoneRegex = /^(?:\+92|0)?\d{3}-?\d{7}$/;

        var f_name = $('#fname').val().trim();
        var department = $('#department').val();
        var l_name = $('#lname').val().trim();
        var father_name = $('#fathername').val().trim();
        var e_mail = $('#email').val().trim();
        var pnumb = $('#phone').val().trim();
        var p_pass = $('#pass').val().trim();
        var cp_pass = $('#c_pass').val().trim();
        var add = $('#address').val().trim();
        var gender = $('input[name="gender"]:checked').val();

        if (f_name === '' || !/^[a-zA-Z]+$/.test(f_name)) {
            markInvalid('#fname', 'Please enter a valid first name (letters only).');
        }
        if (l_name === '' || !/^[a-zA-Z]+$/.test(l_name)) {
            markInvalid('#lname', 'Please enter a valid last name (letters only).');
        }
        if (father_name === '' || !/^[a-zA-Z ]+$/.test(father_name)) {
            markInvalid('#fathername', 'Please enter a valid father’s name (letters and spaces only).');
        }
        if (department === '0') {
            markInvalid('#department', 'Please select a department.');
        }
        if (e_mail === '' || !/^\S+@\S+\.\S+$/.test(e_mail)) {
            markInvalid('#email', 'Please enter a valid email address.');
        }
        if (pnumb === '' || !phoneRegex.test(pnumb)) {
            markInvalid('#phone',
                'Please enter a valid phone number (e.g., 312-1234567, 0312-1234567, +92312-1234567, or 03121234567).'
            );
        }
        if (p_pass === '' || p_pass.length < 8) {
            markInvalid('#pass', 'Password must be at least 8 characters long.');
        }
        if (cp_pass === '' || cp_pass !== p_pass) {
            markInvalid('#c_pass', 'Passwords do not match.');
        }
        if (add === '') {
            markInvalid('#address', 'Address cannot be empty.');
        }
        if (!gender) {
            markGenderInvalid('Please select your gender.');
        } else {
            markGenderValid();
        }

        return isValid;
    }
    </script>
    <?php
        if (isset($_GET['account-already-exist'])) {
            ?>
    <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.error('Email Already Exist!');
    </script>
    <?php
        }
        ?>
</body>

</html>