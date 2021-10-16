<?php
include '../includes/headerDoc.php';
include('../includes/navbarDoc.php');
include_once '../includes/dbConn.php';
    if(isset($_POST['edituser']))
    {
        $cid = $_POST['cid'];
        $space = " ";
    } 
    if(isset($_SESSION['cidup'])) {
        $cid = $_SESSION['cidup'];
    }     
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
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Quick Search..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["docEmail"]; ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php
            if(isset($_POST['edituser']))
            {
                $cid = $_POST['cid'];
                $space = " ";
            }
            if(isset($_SESSION['cidup'])) {
                $cid = $_SESSION['cidup'];
                $space = " ";
            }  
                $query = $conn->prepare("SELECT * FROM clientinfo WHERE clientId = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();

                $query2 = $conn->prepare("SELECT reason from petinfo where petKey = ?");
                $query2->bind_param("i",  $cid);
                $query2->execute();
                $result = $query2->get_result()->fetch_row();
            ?>
                <h1 class="h3 mb-0 text-gray-800">EDIT CLIENT ID <?php   echo $cid ?> </h1>
                <a href="docDash.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i> GO BACK</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                        style="font-size:1.2vw;">
                                        CLIENT NAME</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stmt[2], $space, $stmt[3]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                        style="font-size:1.2vw;">
                                        REASON FOR VISIT</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result[0]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comment fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_POST['edituser']))
            {
                $cid = $_POST['cid'];
                $space = " ";
            }
            if(isset($_SESSION['cidup'])) {
                $cid = $_SESSION['cidup'];
                $space = " ";
            }  
                $query = $conn->prepare("SELECT * FROM clientinfo JOIN petinfo ON clientinfo.clientId = petinfo.petKey WHERE clientId = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();
            ?>

        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">MOBILE NUMBER</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="mobileUpdate" value="<?php echo $stmt[4]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Other Contact</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="otherContact" value="<?php echo $stmt[5]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Email</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="email" value="<?php echo $stmt[6]?>" class="form-control"
                                                placeholder=" Mobile Number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">PET DETAILS</h1>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Pet Name</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="petname" value="<?php echo $stmt[19]?>" class="form-control"
                                                placeholder="Pet Name"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Pet Type</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="pettype" value="<?php echo $stmt[20]?>" class="form-control"
                                                placeholder="Pet Type"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Breed</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="breed" value="<?php echo $stmt[21]?>" class="form-control"
                                                placeholder="Breed"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Sex</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="sex" value="<?php echo $stmt[22]?>" class="form-control"
                                                placeholder="Sex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Color</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="color" value="<?php echo $stmt[23]?>" class="form-control"
                                                placeholder="Color"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Age</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="age" value="<?php echo $stmt[24]?>" class="form-control"
                                                placeholder="Age"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Weight</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="weight" value="<?php echo $stmt[25]?>" class="form-control"
                                                placeholder="Weight"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Microchip</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="microchip" value="<?php echo $stmt[26]?>" class="form-control"
                                                placeholder="Microchip"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Insurance</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="insurance" value="<?php echo $stmt[27]?>" class="form-control"
                                                placeholder="Insurance"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Medication</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="medication" value="<?php echo $stmt[28]?>" class="form-control"
                                                placeholder="Medication"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Parasite Control</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="parasiteC" value="<?php echo $stmt[29]?>" class="form-control"
                                                placeholder="Parasite Control"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">MC Date</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="mcdate" value="<?php echo $stmt[30]?>" class="form-control"
                                                placeholder="MC Date"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <form method="POST" action="process.php">
                <input type = "hidden" name="cidd" value="<?php echo $stmt[0]?>">
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                                style="font-size:1.2vw;">Additional Comments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                    name="comments" value="<?php echo $stmt[15]?>" class="form-control"
                                                    placeholder="Additional Comments"></div>
                                        </div>
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
                                        type="submit" name="updateDocclient" class=" btn btn-success">UPDATE</button></div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center"><button
                                        type="button" class=" btn btn-success" onclick="location.href='docDash.php'"
                                        ;>GO BACK</button></div>
                            </div>
                        </div>
                    </div>
            </form>
    </div>
</div>




<?php 
    include('../includes/scripts.php');
    include('../includes/footer.php');
    ?>