<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['sub_btn'])) {
        $fnam = $_POST['fname'];
        $lnam = $_POST['lname'];
        $fathernam = $_POST['fathername'];
        $mail = $_POST['email'];
        $add = $_POST['address'];
        $gen = $_POST['gender'];
        $dept = $_POST['dept'];
        $phone = $_POST['phone'];
        $check_query = "SELECT * FROM persons where `person_email`='$mail'";
        $result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($result) > 0) {
            header('location:add_new_user.php?account-already-exist=1');
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
            $account_data = "INSERT INTO accounts(`person_id`,`password`,`user_type`,`department_id`,`status`) values('$max_id','" . $_REQUEST['c_pass'] . "','3','$dept','1')";
//            die($account_data);
            $result2 = mysqli_query($con, $account_data);

            //redirect
            header('location:add_new_admin.php?account-registered=1');
        }
    }
    ?>
<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Admin Adding | Complain Managment System GCUF main Campus</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/images/Hajvery-University-logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../css/toastr.min.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <?php
                include 'components/head.php';
                include 'components/leftsidebar.php';
                ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Add New Admin</h2>
                            <p class="pageheader-text">Complain Managment System</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php"
                                                class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a class="breadcrumb-link">Manage Department</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Admin</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->

                <div class="row">
                    <!-- ============================================================== -->
                    <!-- valifation types -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">New Admin Form</h5>
                            <div class="card-body">
                                <form id="validationform" method="post">
                                    <?php
                                            if ($_SESSION['USERTYPE'] == 2) {
                                                ?>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Select
                                            Department</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <select class="form-control" id="dept" name="dept">
                                                <option value="0">Select Category</option>
                                                <?php
                                                            $query = "SELECT * FROM `departments` where `dept_status`=1";
                                                            $result = mysqli_query($con, $query);
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                <option value="<?= $row['department_id'] ?>"><?= $row['department'] ?>
                                                </option>
                                                <?php
                                                            }
                                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                            ?>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">First Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" class="form-control" name="fname" id="fname">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Last Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" class="form-control" id="lname" name="lname">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Father Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" class="form-control" id="fathername" name="fathername">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">User Email</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">User Phone</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" class="form-control" id="phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">User
                                            Password</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="password" class="form-control" id="pass" name="pass">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Confirm
                                            Password</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="password" class="form-control" id="c_pass" name="c_pass">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">User Address</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <textarea required="" class="form-control" id="address"
                                                name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Select
                                            Gender</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <select id="gender" name="gender" class="form-control">
                                                <option value="00">Select Gender</option>
                                                <option value="1">Male</option>
                                                <option value="0">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row text-right">
                                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                            <button type="submit" name="sub_btn" onclick="return valid()"
                                                class="btn btn-space btn-primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end valifation types -->
                    <!-- ============================================================== -->
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php
            include 'components/footerjs.php';
            ?>
    <script src="../js/toastr.min.js"></script>
    <script>
    $('#form').parsley();
    </script>
    <script>
    function valid() {
        var temp = 1;

        // Validate First Name
        var f_name = $('#fname').val();
        if (f_name.trim() === '') {
            $('#fname').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#fname').css('border', 'solid green 1px');
        }

        // Validate Last Name
        var l_name = $('#lname').val();
        if (l_name.trim() === '') {
            $('#lname').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#lname').css('border', 'solid green 1px');
        }

        // Validate Father Name
        var father_name = $('#fathername').val();
        if (father_name.trim() === '') {
            $('#fathername').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#fathername').css('border', 'solid green 1px');
        }

        // Validate Email
        var e_mail = $('#email').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (e_mail.trim() === '' || !emailRegex.test(e_mail)) {
            $('#email').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#email').css('border', 'solid green 1px');
        }

        // Validate Phone
        var phone = $('#phone').val();
        if (phone.trim() === '' || isNaN(phone) || phone.length < 10) {
            $('#phone').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#phone').css('border', 'solid green 1px');
        }

        // Validate Password
        var p_pass = $('#pass').val();
        if (p_pass.trim() === '' || p_pass.length < 6) {
            $('#pass').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#pass').css('border', 'solid green 1px');
        }

        // Validate Confirm Password
        var cp_pass = $('#c_pass').val();
        if (cp_pass.trim() === '' || cp_pass !== p_pass) {
            $('#c_pass').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#c_pass').css('border', 'solid green 1px');
        }

        // Validate Address
        var add = $('#address').val();
        if (add.trim() === '') {
            $('#address').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#address').css('border', 'solid green 1px');
        }

        // Validate Gender
        var gender = $('#gender').val();
        if (gender === '00') {
            $('#gender').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#gender').css('border', 'solid green 1px');
        }

        // Validate Department (if it exists)
        var dept = $('#dept').val();
        if ($('#dept').length > 0 && dept === '0') {
            $('#dept').css('border', 'solid red 1px');
            temp++;
        } else {
            $('#dept').css('border', 'solid green 1px');
        }

        if (temp !== 1) {
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.error('Please correct the highlighted fields.');
            return false;
        }
        return true;
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
    <?php
            if (isset($_GET['account-registered'])) {
                ?>
    <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.success('Account Created Successfuly!');
    </script>
    <?php
            }
            ?>
</body>

</html>
<?php
}
?>