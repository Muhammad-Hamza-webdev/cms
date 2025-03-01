<?php
include('connection/connection.php');
?>
<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/libs/css/style.css">
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
        <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
        <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
        <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
        <link rel="stylesheet" href="../css/toastr.min.css">
        <title>Dash Board | Complain Managment System GCUF Sahiwal Campus</title>
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
            <!-- end navbar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- left sidebar -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- end left sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- wrapper  -->
            <!-- ============================================================== -->
            <?php
            if ($_SESSION['USERTYPE'] == 3) {
                ?>
                <div class="dashboard-wrapper">
                    <div class="dashboard-ecommerce">
                        <div class="container-fluid dashboard-content ">
                            <!-- ============================================================== -->
                            <!-- pageheader  -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="page-header">
                                        <?php
                                        $query = "SELECT * FROM `persons` where `person_id`=" . $_SESSION['USERID'];
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <h2 class="pageheader-title">Welcome : <?= $row['person_name'] . " " . $row['last_name'] ?></h2>
                                            <?php
                                        }
                                        ?>
                                        <div class="page-breadcrumb">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Complain Managment System GCUF</li>
                                                    <?php
                                                    $query = "SELECT * FROM `departments` where `department_id`=" . $_SESSION['DEPTID'];
                                                    $result = mysqli_query($con, $query);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <li class="breadcrumb-item active" aria-current="page"><?= $row['department'] . ' Department' ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end pageheader  -->
                            <!-- ============================================================== -->
                            <div class="ecommerce-widget">
                                <div class="row">
                                    <!-- ============================================================== -->
                                    <!-- sales  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Total Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    if ($_SESSION['USERTYPE'] == 3) {
                                                        $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.department_id=' . $_SESSION['DEPTID'];
//                                                        die($total_complain);
                                                    } else {
                                                        $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where cl.person_id=' . $_SESSION['USERID'];
                                                    }
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    if (mysqli_num_rows($total_complain_result) > 0) {
                                                        $row = mysqli_fetch_array($total_complain_result);
                                                    }
                                                    ?>
                                                    <h1 class="mb-1"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end sales  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- new customer  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Pending Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    if ($_SESSION['USERTYPE'] == 3) {
                                                        $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=1 AND c.department_id=' . $_SESSION['DEPTID'];
                                                    } else {
                                                        $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=1 AND cl.person_id=' . $_SESSION['USERID'];
                                                    }
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: red;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Inprogress Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=2 AND c.department_id=' . $_SESSION['DEPTID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: blue;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end new customer  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- visitor  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Completed Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=3 AND c.department_id=' . $_SESSION['DEPTID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: green;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end visitor  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- total orders  -->
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->
                                    <!-- end total orders  -->
                                    <!-- ============================================================== -->
                                </div>
                                <div class="row">
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->

                                    <!-- recent orders  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                        <div class="card">
                                            <h5 class="card-header">New Complains</h5>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="bg-light">
                                                            <tr class="border-0">
                                                                <th class="border-0">#</th>
                                                                <th class="border-0">Applicant</th>
                                                                <th class="border-0">Department</th>
                                                                <th class="border-0">Category</th>
                                                                <th class="border-0">Status</th>
                                                                <th class="border-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE com.com_status=1 AND  com.department_id=' . $_SESSION['DEPTID'];
                                                            $result = mysqli_query($con, $query);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                $sr = 1;
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $sr . "." ?></td>
                                                                        <td><?= $row['person_name'] . ' ' . $row['last_name'] ?> </td>
                                                                        <td><?= $row['department'] ?> </td>
                                                                        <td><?= $row['category'] ?></td>

                                                                        <td><span class="badge-dot badge-danger mr-1"></span>Pending </td>
                                                                        <td>
                                                                            <input type="button"  class="btn btn-info" value="View Detail"  onclick="return view_detail_complain(<?= $row['complaint_id'] ?>)" />
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $sr++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5"><center>No Record Found</center></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="9"><a href="all_complians.php" class="btn btn-outline-light float-right">View All Complains</a></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end recent orders  -->


                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- customer acquistion  -->

                                    <!-- ============================================================== -->
                                    <!-- end customer acquistion  -->
                                    <!-- ============================================================== -->
                                </div>


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
                <?php
            }
            ?>
            <?php
            if ($_SESSION['USERTYPE'] == 1) {
                ?>
                <div class="dashboard-wrapper">
                    <div class="dashboard-ecommerce">
                        <div class="container-fluid dashboard-content ">
                            <!-- ============================================================== -->
                            <!-- pageheader  -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="page-header">
                                        <?php
                                        $query = "SELECT * FROM `persons` where `person_id`=" . $_SESSION['USERID'];
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <h2 class="pageheader-title">Welcome : <?= $row['person_name'] . " " . $row['last_name'] ?></h2>
                                            <?php
                                        }
                                        ?>
                                        <div class="page-breadcrumb">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Complain Managment System GCUF</li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end pageheader  -->
                            <!-- ============================================================== -->
                            <div class="ecommerce-widget">
                                <div class="row">
                                    <!-- ============================================================== -->
                                    <!-- sales  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Total Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where cl.person_id=' . $_SESSION['USERID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    if (mysqli_num_rows($total_complain_result) > 0) {
                                                        $row = mysqli_fetch_array($total_complain_result);
                                                    }
                                                    ?>
                                                    <h1 class="mb-1"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end sales  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- new customer  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Pending Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=1 AND cl.person_id=' . $_SESSION['USERID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: red;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Inprogress Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=2 AND cl.person_id=' . $_SESSION['USERID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: blue;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end new customer  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- visitor  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Completed Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=3 AND cl.person_id=' . $_SESSION['USERID'];
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: green;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end visitor  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- total orders  -->
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->
                                    <!-- end total orders  -->
                                    <!-- ============================================================== -->
                                </div>
                                <div class="row">
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->

                                    <!-- recent orders  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                        <div class="card">
                                            <h5 class="card-header">Completed Complains</h5>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="bg-light">
                                                            <tr class="border-0">
                                                                <th class="border-0">#</th>
                                                                <th class="border-0">Applicant</th>
                                                                <th class="border-0">Department</th>
                                                                <th class="border-0">Category</th>
                                                                <th class="border-0">Status</th>
                                                                <th class="border-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE com.com_status=3 AND com.feedback_status=0 AND  p.person_id=' . $_SESSION['USERID'];
                                                            $result = mysqli_query($con, $query);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                $sr = 1;
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $sr . "." ?></td>
                                                                        <td><?= $row['person_name'] . ' ' . $row['last_name'] ?> </td>
                                                                        <td><?= $row['department'] ?> </td>
                                                                        <td><?= $row['category'] ?></td>

                                                                        <td><span class="badge-dot badge-success mr-1"></span>Completed </td>
                                                                        <td>
                                                                            <input type="button" <?= ($row['com_status'] == 3) ? 'class="btn btn-success" value="View Response"' : 'disabled="" class="btn btn-danger" value="Waiting" ' ?>   onclick="return view_detail(<?= $row['complaint_id'] ?>)" />
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $sr++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5"><center>No Record Found</center></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="9"><a href="user_all_complians.php" class="btn btn-outline-light float-right">View All Details</a></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end recent orders  -->


                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- customer acquistion  -->

                                    <!-- ============================================================== -->
                                    <!-- end customer acquistion  -->
                                    <!-- ============================================================== -->
                                </div>


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
                <?php
            }
            ?>
            <?php
            if ($_SESSION['USERTYPE'] == 2) {
                ?>
                <div class="dashboard-wrapper">
                    <div class="dashboard-ecommerce">
                        <div class="container-fluid dashboard-content ">
                            <!-- ============================================================== -->
                            <!-- pageheader  -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="page-header">
                                        <?php
                                        $query = "SELECT * FROM `persons` where `person_id`=" . $_SESSION['USERID'];
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <h2 class="pageheader-title">Welcome : <?= $row['person_name'] . " " . $row['last_name'] ?></h2>
                                            <?php
                                        }
                                        ?>
                                        <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                        <div class="page-breadcrumb">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Complain Managment System GCUF</li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end pageheader  -->
                            <!-- ============================================================== -->
                            <div class="ecommerce-widget">
                                <div class="row">
                                    <!-- ============================================================== -->
                                    <!-- sales  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Total Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id';
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    if (mysqli_num_rows($total_complain_result) > 0) {
                                                        $row = mysqli_fetch_array($total_complain_result);
                                                    }
                                                    ?>
                                                    <h1 class="mb-1"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end sales  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- new customer  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Pending Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=1';
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: red;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Inprogress Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=2 ';
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: blue;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end new customer  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- visitor  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="card border-3 border-top border-top-primary">
                                            <div class="card-body">
                                                <h5 class="text-muted">Completed Complains</h5>
                                                <div class="metric-value d-inline-block">
                                                    <?php
                                                    $total_complain = 'SELECT COUNT(c.complaint_id) as result from `complaint` as c inner join `user_complaint_link` as cl on c.complaint_id=cl.complaint_id where c.com_status=3 ';
//                                                    die($total_complain);
                                                    $total_complain_result = mysqli_query($con, $total_complain);
                                                    $row = mysqli_fetch_array($total_complain_result);
                                                    ?>
                                                    <h1 class="mb-1" style="color: green;"><?= $row['result'] ?></h1>
                                                </div>
                                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end visitor  -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- total orders  -->
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->
                                    <!-- end total orders  -->
                                    <!-- ============================================================== -->
                                </div>
                                <div class="row">
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->

                                    <!-- recent orders  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                        <div class="card">
                                            <h5 class="card-header">New Complains</h5>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="bg-light">
                                                            <tr class="border-0">
                                                                <th class="border-0">#</th>
                                                                <th class="border-0">Applicant</th>
                                                                <th class="border-0">Department</th>
                                                                <th class="border-0">Category</th>
                                                                <th class="border-0">Status</th>
                                                                <th class="border-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE com.com_status=1';
                                                            $result = mysqli_query($con, $query);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                $sr = 1;
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $sr . "." ?></td>
                                                                        <td><?= $row['person_name'] . ' ' . $row['last_name'] ?> </td>
                                                                        <td><?= $row['department'] ?> </td>
                                                                        <td><?= $row['category'] ?></td>

                                                                        <td><span class="badge-dot badge-danger mr-1"></span>Pending </td>
                                                                        <td>
                                                                            <input type="button"  class="btn btn-info" value="View Detail"  onclick="return view_detail_complain(<?= $row['complaint_id'] ?>)" />
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $sr++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5"><center>No Record Found</center></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="9"><a href="all_complians.php" class="btn btn-outline-light float-right">View All Complains</a></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end recent orders  -->


                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- customer acquistion  -->

                                    <!-- ============================================================== -->
                                    <!-- end customer acquistion  -->
                                    <!-- ============================================================== -->
                                </div>


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
                <?php
            }
            ?>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>
        <?php
        include 'components/footerjs.php';
        ?>
        <script src="../js/toastr.min.js"></script>
        <script>
                                                                    function view_detail(id) {
                                                                        window.window.location.href = 'user_complain_response.php?complain=' + id;
                                                                    }
                                                                    function view_detail_complain(id) {
                                                                        window.window.location.href = 'complain_detail.php?complain=' + id;
                                                                    }
        </script>
        <?php
        if (isset($_GET['msg'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Login Successfuly!');
            </script>
            <?php
        }
        ?>
    </body>

</html>