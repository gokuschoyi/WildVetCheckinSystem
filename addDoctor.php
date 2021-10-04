<?php
include 'includes/header.php';
include 'includes/navbar.php';
include_once 'includes\dbConn.php';
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
        <!-- End of Topbar -->
        <div  class="loader-wrapper">
            <div class="loader-inner"></div>
        </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">ADD DOCTOR</h1>
                <a href="rDashboard.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i> GO BACK</a>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Doctor Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="docCode.php" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label> Firstname </label>
                                                            <input type="text" name="firstname" class="form-control"
                                                                placeholder="Enter First Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Lasttname </label>
                                                            <input type="text" name="lastname" class="form-control"
                                                                placeholder="Enter Last Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="email"
                                                                class="form-control checking_email"
                                                                placeholder="Enter Email">
                                                            <small class="error_email" style="color: red;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="registerbtn"
                                                            class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary justify-content-center"
                                        data-toggle="modal" data-target="#addadminprofile">Add Doctor Profile</button>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 "></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        DOCTORS ADDED</div>
                                    <?php
                                        
                                        $query = $conn->prepare("SELECT COUNT(docId) FROM doctor ");
                                        
                                        $query->execute();
                                        $stmt = $query->get_result()->fetch_row();
                                        
                                        ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stmt[0]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        DOCTORS REGISTERED</div>
                                    <?php
                                            
                                            $query = 'SELECT COUNT(registered) FROM doctor WHERE registered = "yes"';
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $row =$stmt->get_result()->fetch_row();
                                            ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row[0]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
            </div>
            <div class="card-body">
                <?php
                    if (isset($_SESSION['status'])){
                        echo '<h2>'.$_SESSION['status'].'</h2>';
                        unset($_SESSION['status']);
                    }
                ?>
            </div>
            <div class="row">
                <!-- FORM for adding doctor -->
                <div class="table-responsive table table-striped table-bordered table-hover">
                    <table id="clients" class="display" style="width : 100%">
                        <thead>
                            <tr>
                                <th>Doctor ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Registered</th>
                                <th>EDIT DETAILS</th>
                                <th>DELETE RECORD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $sql = $conn-> query('SELECT docId, dFname, dLname, dEmail, dPassword, registered  FROM doctor');
                                while( $data = $sql-> fetch_array()){
                                    echo '
                                    <tr>
                                        <td> '.$data['docId'].' </td>
                                        <td> '.$data['dFname'].'</td>
                                        <td> '.$data['dLname'].'</td>
                                        <td> '.$data['dEmail'].'</td>
                                        <td> '.$data['dPassword'].'</td>
                                        <td> '.$data['registered'].'</td>
                                        <td> 
                                            <form action = "doc_edit.php" method = "POST">
                                            <input type = "hidden" name = "did" value ='.$data['docId'].'>
                                        <button type = "submit" name = "editdoc" class = " btn btn-success">Edit</button> 
                                        </form>
                                        </td>
                                        <td> 
                                            <form action = "doc_delete.php" method = "POST">
                                            <input type = "hidden" name = "did" value ='.$data['docId'].'>
                                        <button type = "submit" name = "deletedoc" class = " btn btn-danger">DELETE</button> 
                                        </form>
                                        </td>
                                    </tr>
                                    ';
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <?php 
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>