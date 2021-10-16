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

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                                            placeholder="Quick Search..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="assets\img\receptionist.png">
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
                <!-- <?php
                if((isset($_SESSION['snippetSent'])) == 1){
                        echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check">Email successfully sent.</i></h4>
                        </div>';
                }
                    unset($_SESSION['snippetSent']);
                ?> -->
                <!-- End of Topbar -->
                <div  class="loader-wrapper">
                    <div class="loader-inner"></div>
                </div>
                <!-- Begin Page Content -->
                
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SEND SNIPPETS <?php date_default_timezone_set('Australia/ACT');  echo date("j/M/y") ?> </h1>
                        <a href="rDashboard.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i> GO BACK</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Remaining</div>
                                                <?php
                                                $snippet = "No";
                                                $query = $conn->prepare("SELECT COUNT(snippet) FROM clientinfo WHERE snippet = ?");
                                                $query->bind_param("s",$snippet);
                                                $query->execute();
                                                $stmt = $query->get_result()->fetch_row();
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stmt[0]?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>   

                    <div  class ="table-responsive table table-striped table-bordered table-hover" >
                        <table id = "clients" class = "display" style ="width : 100%">
                            <thead>
                                <tr>
                                    <th>Cid</th>
                                    <th>Client Name</th>
                                    
                                    <th>Reason</th>
                                    <th>Pet Name</th>
                                    <th>Seen By Doctor</th>
                                    <th>Pet Type</th>
                                    <th>Breed</th>
                                    <th>SELECT</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $snippet ="No";

                                $query = $conn->prepare("SELECT  DISTINCT clientinfo.clientId, clientinfo.title, clientinfo.firstName, clientinfo.surName, clientinfo.checkinDate, petinfo.reason, petinfo.petKey, petinfo.petName, petinfo.petType, petinfo.breed, clientinfo.viewed
                                FROM clientinfo JOIN petinfo ON clientinfo.clientId=petinfo.petKey WHERE clientinfo.snippet = ? ORDER BY clientinfo.clientId DESC");
                                $query->bind_param("s",$snippet);
                                $query->execute();
                                $result = $query->get_result();
                                while( $data = $result-> fetch_assoc()){
                                    echo '
                                    <tr>
                                        <td> '.$data['clientId'].'</td>
                                        <td> '.$data['title'].' '.$data['firstName'].' '.$data['surName'].'</td>
                                        
                                        <td> '.$data['reason'].'</td>
                                        <td> '.$data['petName'].'</td>
                                        <td> '.$data['viewed'].'</td>
                                        <td> '.$data['petType'].'</td>
                                        <td> '.$data['breed'].'</td>
                                        <td> 
                                            <form action = "rFetch_links.php" method = "POST">
                                            <input type = "hidden" name = "cid" value ='.$data['clientId'].'>
                                            <input type = "hidden" name = "cname" value ='.$data['firstName'].'>
                                        <button type = "submit" name = "selectarticle" class = " btn btn-success">SELECT ARTICLES</button> 
                                        </form>
                                        </td>
                                        
                                    </tr>
                                    ';
                                }
                                ?>

                            </tbody>
                        </table>
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

    

  

