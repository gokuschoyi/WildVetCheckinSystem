<?php
include 'includes/header.php';
include 'includes/navbar.php'; 
include_once 'includes/dbConn.php';      
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Quick Search..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Quick Search..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'];?></span>
                        <img class="img-profile rounded-circle" src="assets\img\admin.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="rProfile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="addDoctor.php">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Add/Edit Doctor
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <div  class="loader-wrapper">
            <div class="loader-inner"></div>
        </div>
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php
            
                $ruser = $_SESSION['username'];
                $space = ", ";
        
                $query = $conn->prepare("SELECT rLastname, rFirstname FROM reception WHERE rUsername = ?");
                $query->bind_param("s",$ruser);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();

            ?>
                <h1 class="h3 mb-0 text-gray-800">USER NAME : <?php   echo $ruser; ?> </h1>
                <a href="rDashboard.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i> GO BACK</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                        style="font-size:1.2vw;">
                                        RECEPTIONIST NAME</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stmt[1], $space, $stmt[0]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $ruser = $_SESSION['username'];
            $query = $conn->prepare("SELECT rId, rUsername, rPassword, rEmail FROM reception  WHERE rUsername = ?");
            $query->bind_param("s",$ruser);
            $query->execute();
            $stmt = $query->get_result()->fetch_row();
        ?>

        <form method="POST" action="process.php">
            <input type="hidden" name="rid" value="<?php echo $stmt[0]?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">User ID</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="rid" value="<?php echo $stmt[0]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">EMAIL</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="remail" value="<?php echo $stmt[3]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">USER NAME</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="rname" value="<?php echo $stmt[1]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-primary shadow h-100 py-2 border-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">PASSWORD</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="rpassword" value="<?php echo $stmt[2]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                            <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center"><button
                                    type="submit" name="updatereception" class=" btn btn-success">UPDATE</button></div>

                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="container-fluid " style = "padding-top:110px;">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                            <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center"><button
                                    type="button" class=" btn btn-success" onclick="location.href='rDashboard.php'" ;>GO
                                    BACK</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php 
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>