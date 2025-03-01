<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 1) {
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>All Complians | Complain Managment System GCUF Sahiwal Campus</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/libs/css/style.css">
            <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
            <link rel="stylesheet" href="../css/toastr.min.css">
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
                    <div class="container-fluid  dashboard-content">
                        <!-- ============================================================== -->
                        <!-- pageheader -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title">All Complains</h2>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">view all Complains</a></li>
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
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"> Complains</h5>
                                        <p>All Complians</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Applicant</th>
                                                        <th>Department</th>
                                                        <th>Category</th>
                                                        <th>Applicant Phone</th>
                                                        <th>Status</th>
                                                        <th>Feed back Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE  p.person_id=' . $_SESSION['USERID'];
                                                    $result = mysqli_query($con, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $sr = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $sr . "." ?></td>
                                                                <td><?= $row['person_name'] . ' ' . $row['last_name'] ?></td>
                                                                <td><?= $row['department'] ?></td>
                                                                <td><?= $row['category'] ?></td>
                                                                <td><?= $row['phone'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['com_status'] == 1) {
                                                                        echo '<span style="color: red">Pending</span>';
                                                                    } else if ($row['com_status'] == 2) {
                                                                        echo '<span style="color: blue">InProgress</span>';
                                                                    } else {
                                                                        echo '<span style="color: Green">Completed</span>';
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?= ($row['feedback_status'] == 1) ? '<b style="color: Green;">Given</b>' : '<b style="color: red;">Panding</b>' ?>
                                                                </td>
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
                                                            <td colspan="8"><center>No Record Found</center></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end data table  -->
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
            <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
            <script src="assets/libs/js/main-js.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
            <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
            <script src="assets/vendor/datatables/js/data-table.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
            <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
            <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
            <script src="../js/toastr.min.js"></script>
            <script>
                                                                function view_detail(id) {
                                                                    window.window.location.href = 'user_complain_response.php?complain=' + id;
                                                                }
            </script>
            <?php
            if (isset($_GET['disabled'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Account Suspended!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['actived'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Account Activated!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['markedinprocess'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Marked Inprocess!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['responded'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Responded!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['reviewed'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Review Submitted!');
                </script>
                <?php
            }
            ?>
        </body>

    </html>
    <?php
} else {
    header('location:error404.php');
}
?>