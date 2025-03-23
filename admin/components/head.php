<?php
//include('connection/connection.php');
$query = "SELECT * FROM `persons` where `person_id`=" . $_SESSION['USERID'];
$img = "SELECT * FROM `accounts_img` where `person_id`=" . $_SESSION['USERID'];
$imgResult = mysqli_query($con, $img);
$imgRow = mysqli_fetch_array($imgResult);
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
?>
<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top" style="padding: 0 10px;">
        <a class="navbar-brand user-img" href="dashboard.php"><img src="assets/images/Hajvery University admin-logo.png"
                style="width:100%" /></a>
        <button class="navbar-toggler" style="background-color: #0e0c28;" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class=" fas fa-bars" style="color:#ffffff; font-size:20px;"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item user-name">
                    <span><?=$row['person_name']?></span>
                    <!-- <div id="custom-search" class="top-search-bar">
                        <input class="form-control" type="text" placeholder="Search..">
                    </div> -->
                </li>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="display: flex;">
                        <?php
                            if ($imgRow['pict']==NULL) { 
                        ?>
                        <i class="user-avatar-md rounded-circle fas fa-user-circle" style="font-size: 40px;"></i>
                        <?php
                            } else {
                        ?>
                        <img src="<?= $imgRow['pict'] ?>" alt="User Image" class="user-avatar-md rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <?php
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                        aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">

                            <h5 class="mb-0 text-white nav-user-name">
                                <?= $row['person_name'] . " " . $row['last_name'] ?></h5>
                            <?php
                            }
                            ?>
                            <span class="status"></span><span class="ml-2">Available</span>
                        </div>
                        <a class="dropdown-item" href="account_settings.php?person_id=<?= $_SESSION['USERID'] ?>"><i
                                class="fas fa-user mr-2"></i>Account</a>
                        <!-- <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a> -->
                        <a class="dropdown-item" href="log_out.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>