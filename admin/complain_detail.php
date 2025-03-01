<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_GET['complain_id'])) {
        $query = 'UPDATE `complaint` SET `com_status`=2 where `complaint_id`=' . $_GET['complain_id'];
        $result = mysqli_query($con, $query);
        header('location:all_complians.php?markedinprocess');
    }
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Complain Detail | Complain Managment System GCUF Main Campus</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
            <link rel="stylesheet" href="assets/libs/css/style.css">
        </head>

        <body>
            <!-- ============================================================== -->
            <!-- main wrapper -->
            <!-- ============================================================== -->
            <div class="dashboard-main-wrapper">
                <!-- ============================================================== -->
                <!-- navbar -->
                <!-- ============================================================== -->
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
                    <div class="container-fluid dashboard-content ">

                        <div class="row">
                            <div class="col-xl-12">
                                <!-- ============================================================== -->
                                <!-- pageheader  -->
                                <!-- ============================================================== -->
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="page-header" id="top">
                                            <h2 class="pageheader-title">Complain Detail </h2>
                                            <div class="page-breadcrumb">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                                        <li class="breadcrumb-item"><a  class="breadcrumb-link">Manage Complains</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Panding Complains</li>
                                                        <li class="breadcrumb-item active" aria-current="page">Complain Detail</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ============================================================== -->
                                <!-- alignment  -->
                                <!-- ============================================================== -->
                                <?php
                                $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE com.complaint_id=' . $_GET['complain'];
//    die($query);
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    ?>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card" id="align">
                                                <h5 class="card-header">Applicant Name: <?= $row['person_name'] . ' ' . $row['last_name'] ?></h5>
                                                <div class="card-body">
                                                    <p class="text-left">Applicant Department: <?= $row['department'] ?></p>
                                                    <p class="text-left">Application Category: <?= $row['category'] ?></p>
                                                </div>
                                                <div class="card-body border-top">
                                                    <h3 class="text-center">Complain Description</h3>
                                                    <p class="text-center"><?= $row['description'] ?></p>
                                                </div>
                                                <div class="card-body border-top">
                                                    <h3 class="text-center">
                                                        <input type="button" class="btn btn-success" onclick="return MarkInprocess(<?= $_GET['complain'] ?>)"value="Mark As Inprogress"/>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!-- ============================================================== -->
                                <!-- end alignment  -->
                                <!-- ============================================================== -->

                            </div>

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
            <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <script src="assets/libs/js/main-js.js"></script>
            <script>
                                                        function MarkInprocess(id) {
                                                            if (confirm("Are you sure you want to Mark as Inprocess?")) {
                                                                window.window.location.href = 'complain_detail.php?complain_id=' + id;
                                                            }

                                                        }
            </script>
        </body>

    </html>
    <?php
}
?>