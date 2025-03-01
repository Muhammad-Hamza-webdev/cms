<?php
if ($_SESSION['USERTYPE'] == 3) {
    ?>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="dashboard.php" ><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-users"></i>Users</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add_new_user.php">Add User <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="user_request.php">User Requests</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view_all_users.php">View All Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fab fa-fw fa-wpforms"></i> Complains</a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="all_complians.php">Manage Complains <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="all_completed_complains.php">Completed </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-"><i class="fas fa-bookmark"></i> Manage Site</a>
                                        <div id="submenu-4" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="site_services.php">Services<span class="badge badge-secondary">New</span></a>
                                                </li>
                                                <!--                                                <li class="nav-item">
                                                                                                    <a class="nav-link" href="#">Team<span class="badge badge-secondary">New</span></a>
                                                                                                </li>-->
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <?php
}
?>
<?php
if ($_SESSION['USERTYPE'] == 2) {
    ?>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="dashboard.php" ><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-users"></i>Users</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add_new_user.php">Add User <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="user_request.php">User Requests</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view_all_users.php">View All Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fab fa-fw fa-wpforms"></i> Complains</a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="all_complians.php">Manage Complains <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="all_completed_complains.php">Completed </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-"><i class="fas fa-bookmark"></i> Manage Departments</a>
                            <div id="submenu-4" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="department_detail.php">Departments <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="add_new_admin.php">Department Admin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view_all_admin.php">Manage Admin </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-"><i class="fas fa-bookmark"></i> Manage Site</a>
                            <div id="submenu-5" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="site_services.php">Services<span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <!--                                    <li class="nav-item">
                                                                            <a class="nav-link" href="#">Team<span class="badge badge-secondary">New</span></a>
                                                                        </li>-->
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <?php
}
?>
<!--User menu-->
<?php
if ($_SESSION['USERTYPE'] == 1) {
    ?>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="dashboard.php" ><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>

                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="reg_new_complain.php" ><i class="fab fa-wpforms"></i>Register New Complain <span class="badge badge-success">6</span></a>

                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="user_all_complians.php" ><i class="fab fa-wpforms"></i>Complains History<span class="badge badge-success">6</span></a>

                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <?php
}
?>