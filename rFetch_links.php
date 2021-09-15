<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'simple_html_dom.php';
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['selectarticle']))
    {
        $id = $_POST['cid'];
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php
            if(isset($_POST['selectarticle']))
            {
                $cid = $_POST['cid']; 
                
            }
            ?>
                <h1 class="h3 mb-0 text-gray-800">CLIENT ID : <?php   echo $id ?> </h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                                        CLIENT NAME</div>
                                    <?php
                                        $space = " ";
                                        $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                                        $query = $conn->prepare("SELECT title, firstName, surName, addComments FROM clientinfo WHERE clientId = ?");
                                        $query->bind_param("s",$id);
                                        $query->execute();
                                        $stmt1 = $query->get_result()->fetch_row();
                                        ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stmt1[0], $space,$stmt1[1], $space, $stmt1[2]?></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
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
                                        style="font-size:1.2vw;">
                                        REASON FOR VISIT</div>
                                    <?php
                                        $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                                        $query = $conn->prepare("SELECT reason from petinfo where petKey = ?");
                                        $query->bind_param("s",$cid);
                                        $query->execute();
                                        $stmt = $query->get_result()->fetch_row();
                                        ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stmt[0]?></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-comment fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
        if(isset($_POST['selectarticle']))
            {
                $cid = $_POST['cid'];
                $space = " ";
            }
                $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                $query = $conn->prepare("SELECT petKey, reason, petName, petType, breed, sex, age, petWeight FROM petinfo WHERE petKey = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();
            ?>

        <form method="" action="">
            <input type="hidden" name="petkey" value="<?php echo $stmt[7]?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Pet Name</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="petname" value="<?php echo $stmt[2]?>" class="form-control"
                                                placeholder="First Name"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Pet Type</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="pettype" value="<?php echo $stmt[3]?>" class="form-control"
                                                placeholder="Last Name"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Breed</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="breed" value="<?php echo $stmt[4]?>" class="form-control"
                                                placeholder="email"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Sex</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="sex" value="<?php echo $stmt[5]?>" class="form-control"
                                                placeholder="Username"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Age</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="age" value="<?php echo $stmt[6]?>" class="form-control"
                                                placeholder="Password"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Pet Weight</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="petweight" value="<?php echo $stmt[7]?>" class="form-control"
                                                placeholder="Registered"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">Doctor's Comments</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text"
                                                name="petweight" value="<?php echo $stmt1[3] ?>" class="form-control"
                                                placeholder="Registered"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-md-6 mb-4 align-items-center">
                        <div class="card border-primary shadow h-100 py-2 align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 align-items-center" style="font-size:1.5vw;">SELECT LINKS</div>  
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid ">
            <div class="table-responsive table table-striped table-bordered table-hover">
            <form method = "POST" action = "rSendEmail.php">
                <table id="linktable" class="display" style="width : 100%">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Links</th>
                            <th>Title</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_POST['selectarticle'])){
                            $cid = $_POST['cid'];   
                        }
                        
                function returnLinks($searchQ){
                    $arrayL = array();
                    $search = 'https://www.google.co.in/search?q=';
                    $searchF = $search.$searchQ;
                    $html = file_get_html($searchF);
                    foreach($html->find("div.kCrYT") as $h){
                        foreach($h->find("h3.zBAuLc") as $title){
                            foreach($h->find('a[href^=/url?q]') as $links){
                                $li = $links->getAttribute('href');
                                if(strlen(trim($li)) == 0){
                                    continue;
                                    }
                                if($li[1] == 'u'){
                                    $count = 0;
                                    $cutRes = "";
                                    while($li[$count] != '&'){
                                        $count++;
                                        $cutRes = substr($li, 7, $count-7);
                                    }
                                }
                            }
                            array_push($arrayL,$cutRes);
                        }
                    }
                return $arrayL;
                }
                
                function returnTitle($searchQ){
                    $arrayT = array();
                    $search = 'https://www.google.co.in/search?q=';
                    $searchF = $search.$searchQ;
                    $html = file_get_html($searchF);
                    foreach($html->find("div.kCrYT") as $h){
                        foreach($h->find("h3.zBAuLc") as $title){
                            foreach($h->find('a[href^=/url?q]') as $links){
                                $li = $links->getAttribute('href');
                                    array_push($arrayT,$title);
                            }
                        }
                        }
                    return $arrayT;
                }

                    function makeSearchString($type, $breed, $sex, $age, $reason){
                        $search = $sex."+".$breed."+".$type."+".$reason;
                        return $search;
                    }

                    $ctype = $stmt[3];
                    $cbreed = $stmt[4];
                    $csex = str_replace(' ','+', $stmt[5]);
                    $cage = $stmt[6];
                    $creason = str_replace(' ', '+', $stmt[1]);

                    $searchQuery = makeSearchString($ctype,$cbreed, $csex, $cage, $creason);

                    echo $searchQuery;

                    $dataL = array();
                    $dataT = array();
                    $dataL =  returnLinks($searchQuery);
                    $dataT =  returnTitle($searchQuery);

                    $it = new MultipleIterator();
                    $it->attachIterator(new ArrayIterator($dataL));
                    $it->attachIterator(new ArrayIterator($dataT));

                        foreach($it as $a){
                    echo '
                    <tr>
                        <td> <input type = "checkbox" name = "check_list[]" value = '. $a[0] .' ></td>
                        <td> '. $a[0] .'</td>
                        <td> '. $a[1] .'</td>
                        
                    </tr>
                    ';
                }
                ?>
                    </tbody>
                </table>
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center">
                                <button type="submit" name = "sendEmail" class=" btn btn-success justify-content-center" method = "POST" action = "">PREVIEW EMAIL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type = "hidden" name = "cid" value = "<?php echo $id?>">
            </form>
                
        </div>
        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center">
                            <buttontype="button" class=" btn btn-warning"onclick="location.href='rSendsnippet.php'" ;>GO BACK</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
    include('includes/scripts.php');
    ?>

<script>

    function toggleSelectedLinks(box){
        //alert("testing");
        var linkArray = new array();
        var links = $(box).attr("value");
        if($(box).prop("checked") == true){
            //array_push(linkArray, links);
            print(links);
        }
        
        return linkArray;
        
    }
 

</script>

<?php
include('includes/footer.php');
?>