<!-- page showing basic information for about -->
<?php
include '../includes/header.php';
include '../includes/navbar.php';
include_once '../includes/dbConn.php';
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

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Quick Search..." aria-label="Search" aria-describedby="basic-addon2">
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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                        <img class="img-profile rounded-circle" src="assets\img\receptionist.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="rProfile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="addDoctor.php">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Add/Edit Doctor
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
        <!-- End of Topbar -->
        <div class="loader-wrapper">
            <div class="loader-inner"></div>
        </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">ABOUT</h1>
                <button type="button" onclick="location.href='rDashboard.php'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-alt-left-arrow fa-sm text-white-50"></i> GO BACK </Button>

            </div>
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->

            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                </div>
                <div class="card-body" style="font-size:24px">
                    The aim of the system is to develop a check-in system for new or existing customers of the Wild Vet.
                    The system will work along with their existing systems to reduce the check-in time and reduce the paper waste.
                    The check-in will be made available on web browser, android and IOs.
                    The primary function of the check-in is to allow easier check-in digitally where the client can input the pet details either at their home, by filling the form online, or via scanning a QR code at the VET clinic.
                    The system also allows for the receptionist and doctors to view the client information and send relevant links related to pet to the clients.
                </div>
            </div>

            <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                            <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center">
                                <button type="button" class=" btn btn-warning" onclick="location.href='rDashboard.php'" ;>GO BACK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <?php
    include '../includes/scripts.php';
    include '../includes/footer.php';
    ?>