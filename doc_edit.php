<?php
include 'includes/header.php';
include 'includes/navbar.php';
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['editdoc']))
    {
        $cid = $_POST['did'];
        $space = " ";
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
            <form
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['rname'];?></span>
                        <img class="img-profile rounded-circle"
                            src="assets\img\admin.png">
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
        <div  class="loader-wrapper">
            <div class="loader-inner"></div>
        </div>
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <?php
            if(isset($_POST['editdoc']))
            {
                $cid = $_POST['did'];
                $space = " ";
            }
            $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                $query = $conn->prepare("SELECT * FROM doctor WHERE docId = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();
            ?>
                <h1 class="h3 mb-0 text-gray-800">EDIT Doctor  ID : <?php   echo $cid ?> </h1>
                <a href="addDoctor.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"style="font-size:1.2vw;">
                                        DOCTOR NAME</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stmt[1], $space, $stmt[3]?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <?php
        if(isset($_POST['editdoc']))
            {
                $cid = $_POST['did'];
                $space = " ";
            }
                $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                $query = $conn->prepare("SELECT * FROM doctor WHERE docId = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();
            ?>

    <form method = "POST" action = "doc_update.php">
    <input type = "hidden" name = "docid" value = "<?php echo $stmt[0]?>">
        <div class = "container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">First Name</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "firstname" value = "<?php echo $stmt[1]?>" class = "form-control" placeholder="First Name" ></div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">Last Name</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "lastname" value = "<?php echo $stmt[3]?>" class = "form-control" placeholder="Last Name" ></div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">Email</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "email" value = "<?php echo $stmt[4]?>" class = "form-control" placeholder="email" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    
                </div>
        </div>

        <div class = "container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">Username</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "username" value = "<?php echo $stmt[2]?>" class = "form-control" placeholder="Username" ></div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">Password</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "password" value = "<?php echo $stmt[5]?>" class = "form-control" placeholder="Password" ></div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:1.2vw;">Registered</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type = "text" name = "postcode" value = "<?php echo $stmt[6]?>" class = "form-control" placeholder="Registered" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    
                </div>
                
        </div>
    
        <div class = "container-fluid ">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 align-items-center">  
                        <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center"><button type = "submit" name = "updatedoc" class = " btn btn-success">UPDATE</button></div>
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