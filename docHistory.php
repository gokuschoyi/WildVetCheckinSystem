<?php
include('includes\header.php');
include('includes\navbarDoc.php');

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
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["docEmail"]; ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">CLIENTS TODAY
                    <?php date_default_timezone_set('Australia/ACT');  echo date("j/M/y") ?> </h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                                        CLIENTS TODAY</div>
                                    <?php
                                            
                                                $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                                                $_SESSION['qEmail'] = $_SESSION['docEmail'];
                                                $query1 = $conn->prepare("SELECT dFname from doctor WHERE dEmail = ?");
                                                $query1->bind_param("s", $_SESSION['qEmail']);
                                                $query1->execute();
                                                $result = $query1->get_result();
                                                while($row = $result->fetch_assoc()){
                                                $qname = "$row[dFname]";}
                                                echo $qname;
                                                $_SESSION['docname'] = $qname;
                                                    $viewed = "Yes";
                                                $query = $conn->prepare("SELECT COUNT(assignedDoc) FROM clientinfo WHERE assignedDoc = ? AND viewed = ?");
                                                $query->bind_param("ss",$qname ,$viewed);
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
            </div>

            <div class="table-responsive table table-striped table-bordered table-hover">
                <table id="clients" class="display" style="width : 100%">
                    <thead>
                        <tr>
                            <th>Cid</th>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Pet Name</th>
                            <th>Pet Type</th>
                            <th>Breed</th>
                            <th>EDIT DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $registered = "Yes";
                                $stmt = $conn->prepare("SELECT dFname FROM doctor WHERE registered = ?");
                                $stmt->bind_param("s",$registered);
                                $stmt->execute();
                                $res = $stmt->get_result();
                                $options = "";
                                    while($resu = mysqli_fetch_array($res))
                                    {
                                        $options = $options."<option>$resu[0]</options>";
                                    }
                                    echo $options;
                                    
                                date_default_timezone_set('Australia/ACT');
                                
                                $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                                    $viewed = "Yes";
                                $query = $conn->prepare("SELECT  DISTINCT clientinfo.clientId, clientinfo.title, clientinfo.firstName, clientinfo.surName, clientinfo.assignedDoc, clientinfo.checkinDate, clientinfo.mobileNo, clientinfo.email ,petinfo.petKey, petinfo.petName, petinfo.petType, petinfo.breed 
                                FROM clientinfo JOIN petinfo ON clientinfo.clientId=petinfo.petKey WHERE clientinfo.assignedDoc = ? AND viewed = ? ");
                                $query->bind_param("ss",$qname, $viewed);
                                $query->execute();
                                $result = $query->get_result();
                                while( $data =  mysqli_fetch_array( $result)){
                                    $name = $data[1]." ".$data[2]." ".$data[3];
                                    ?>
                        <tr>
                            <td> <?php echo $data[0] ?></td>
                            <td> <?php echo $name ?> </td>
                            <td> <?php echo $data[6] ?></td>
                            <td> <?php echo $data[7] ?></td>
                            <td> <?php echo $data[9] ?></td>
                            <td> <?php echo $data[10] ?></td>
                            <td> <?php echo $data[11] ?></td>
                            <td>
                                <form action="doc_clientview.php" method="POST">
                                    <input type="hidden" name="cid" value=<?php echo $data[0] ?>>
                                    <input type="hidden" name="cname" value=<?php echo $data[2] ?>>
                                    <button type="submit" name="edituser" class=" btn btn-success">View</button>
                                </form>
                            </td>
                        </tr>
                        <?php   
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
    include('includes\scripts.php');
    include('includes\footer.php');
    ?>