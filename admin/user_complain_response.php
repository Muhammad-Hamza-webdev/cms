<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 1 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['btn_send'])) {
        $query = 'INSERT INTO review(review) values("' . $_REQUEST['review'] . '")';
        mysqli_query($con, $query);

        $max_query = 'SELECT MAX(review_id) as result from `review` ';
        $result = mysqli_query($con, $max_query);
        $row = mysqli_fetch_array($result);
        $review_id = $row['result'];

        $link_query = 'INSERT INTO `review_user_complaint_link`(`person_id`,`complaint_id`,`review_id`) values("' . $_SESSION['USERID'] . '","' . $_GET['complain'] . '","' . $review_id . '") ';
        mysqli_query($con, $link_query);

        $update_query = 'Update `complaint` set `feedback_status`=1 where `complaint_id`=' . $_GET['complain'];
        mysqli_query($con, $update_query);

        header('location:user_all_complians.php?reviewed=1');
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
                                            <h2 class="pageheader-title">Complain Response </h2>
                                            <div class="page-breadcrumb">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                                        <li class="breadcrumb-item"><a  class="breadcrumb-link">View All Complains</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page"> Complain Response</li>
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
                                                        <h3 class="text-center" style="text-decoration: underline;">Response From Admin</h3>
                                                        <h3 class="text-left" >Description:

                                                        </h3>
                                                        <?php
                                                        $response_query = 'SELECT * FROM complain_response where `complaint_id`=' . $_GET['complain'];
                                                        $result = mysqli_query($con, $response_query);
                                                        $row2 = mysqli_fetch_array($result);
                                                        ?>
                                                        <span><?= $row2['description'] ?></span><br><br>
                                                        <?php
                                                        if ($row2['file'] != '') {
                                                            ?>
                                                            <h3 class="text-left" >File: <a href="<?= $row2['file'] ?>"><i class="fas fa-download"></i></a></h3>
                                                            <?php
                                                        }
                                                        ?>
                                                    </h3>
                                                </div>
                                                <div class="card-body border-top">
                                                    <h3 class="text-center">
                                                        <!-- Trigger the modal with a button -->
                                                        <?php
                                                        $check_query = 'select * from `review_user_complaint_link` as lr inner join `review` as r on lr.review_id=r.review_id where lr.complaint_id=' . $_GET['complain'];
                                                        $check_result = mysqli_query($con, $check_query);
                                                        $row1 = mysqli_fetch_array($check_result);
                                                        if (mysqli_num_rows($check_result) > 0) {
                                                            ?>
                                                            <button type="button" class="btn btn-outline-info btn-lg" data-toggle="modal" data-target="#myModal2">See Feedback</button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Give FeedBack</button>
                                                            <?php
                                                        }
                                                        ?>

                                                        <!-- Modal -->
                                                        <div id="myModal2" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <form method="post" >
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <label class="text-left">Your FeedBack</label>

                                                                            <input required="" type="text" value="<?= $row1['review'] ?>" readonly="" name="review" id="review" class="form-control"/>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                </div>
                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <form method="post" >
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label class="text-left">Enter FeedBack</label>

                                                                    <textarea required="" name="review" id="review" class="form-control"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-default" name="btn_send" onclick="return valid()" >Send</button>
                                                                </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
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
                                                                    function valid() {
                                                                        var sec = $('#review').val();
                                                                        if (sec == '') {
                                                                            $('#review').css('border', 'solid 1px red');
                                                                            return false;
                                                                        }
                                                                    }
    </script>
    </body>

    </html>
    <?php
}
?>