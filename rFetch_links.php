<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'simple_html_dom.php';
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['selectarticle']))
    {
        $id = $_POST['cid'];
        $_SESSION['id'] = $id;
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
        
        <img src="assets\img\giphy.gif" id="loading" class="hidden">
        
        <script>
            document.getElementById("loading").className="visible";
            var hide=function(){
                document.getElementById("loading").className="hidden"};
            var oldLoad=window.onload;
            var newLoad=oldLoad?
            function(){
                hide.call(this);
                oldLoad.call(this)
            }
            :hide;
            window.onload=newLoad; 
        </script>
        <div class="container-fluid">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <?php
                ?>
                    <h1 class="h3 mb-0 text-gray-800">CLIENT ID : <?php echo  $_SESSION['id'] ?> </h1>
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
                                            $query->bind_param("s", $_SESSION['id']);
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
                                            $query->bind_param("s", $_SESSION['id']);
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
                        $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                        $query = $conn->prepare("SELECT petKey, reason, petName, petType, breed, sex, age, petWeight FROM petinfo WHERE petKey = ?");
                        $query->bind_param("s", $_SESSION['id']);
                        $query->execute();
                        $stmt = $query->get_result()->fetch_row();
                    ?>

                
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
                                                        placeholder="None given by doctor."></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                

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
                                    <th>Page Preview</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_POST['selectarticle'])){
                                    $cid = $_POST['cid'];   
                                    $count = 1;  
                                }
                                
                                function returnGoogleTitleLinks($searchF){
                                    $arrayLinks = array();
                                    $arrayTitle = array();
                                    $search = 'https://www.google.com/search?q=';
                                    $start = "&start=";
                                    $searchF = $search.$searchF.$start;
                            
                                    for($i=0;$i<2;$i++){
                                    
                                        $searchF = $searchF.$i."0";
                                        $curl = curl_init();
                                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                                        curl_setopt($curl, CURLOPT_HEADER, false);
                                        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                                        curl_setopt($curl, CURLOPT_URL, $searchF);
                                        curl_setopt($curl, CURLOPT_REFERER, $searchF);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                                        $str = curl_exec($curl);
                                        curl_close($curl);
                                        try {
                                            if($str == null)
                                            {
                                                throw new exception("0");
                                            }
                                        }
                                        catch (exception $e){
                                            return $e->getMessage();
                                        }
                            
                                        $htmlDom = new simple_html_dom();
                                        $htmlDom->load($str);
                                        echo '<br>';
                                        foreach($htmlDom->find("div.kCrYT") as $h){
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
                                                    array_push($arrayLinks,$cutRes);
                                                }
                                            } 
                                            foreach($h->find("h3.zBAuLc") as $title){
                                                $title->find('.BNeawe UPmit AP7Wnd');
                                                array_push($arrayTitle, $title->plaintext); 
                                            }
                                        }   
                                    }
                                    $it = new MultipleIterator();
                                    $it->attachIterator(new ArrayIterator($arrayLinks));
                                    $it->attachIterator(new ArrayIterator($arrayTitle));
                                    return $it;
                                }       
                                function returnBingTitleLinks($searchF){
                                    $arrayLinks = array();
                                    $arrayTitle = array();
                                    $start = "&first=";
                                    $bing = 'http://www.bing.com/search?q='.$searchF.$start;
                                    
                                    for($i=0;$i<2;$i++){
                                        $bing = $bing.$i."0";
                                        $curl = curl_init();
                                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                                        curl_setopt($curl, CURLOPT_HEADER, false);
                                        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                                        curl_setopt($curl, CURLOPT_URL, $bing);
                                        curl_setopt($curl, CURLOPT_REFERER, $bing);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                                        $str = curl_exec($curl);
                                        curl_close($curl);
                                        try {
                                            if($str == null)
                                            {
                                                throw new exception("0");
                                            }
                                        }
                                        catch (exception $e){
                                            
                                            return $e->getMessage();
                                        }
                                        $htmlDom = new simple_html_dom();
                                        $htmlDom->load($str);
                            
                                        $linkObjs = $htmlDom->find('li h2 a');
                                        
                                        foreach ($linkObjs as $linkObj) {
                                            $title = trim($linkObj->plaintext);
                                            $link  = trim($linkObj->href);
                            
                                            if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
                                                $link = $matches[1];
                                            } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
                                                continue;    
                                            }
                                            array_push($arrayTitle, $title);
                                            array_push($arrayLinks, $link);
                                        }
                                    }
                                    $it = new MultipleIterator();
                                    $it->attachIterator(new ArrayIterator($arrayLinks));
                                    $it->attachIterator(new ArrayIterator($arrayTitle));
                                    return $it;
                                }
                                function makeSearchString($type, $breed, $sex, $age, $reason){         
                                    if($reason == 'General'){
                                        $search = "How+to+take+care+of+".$age."+year+old+".$breed;
                                        return $search;
                                    }
                                    else if($reason == 'Health+Check'){
                                        $search = "How+to+look+after+".$age."+year+old+".$breed."+puppy";
                                        return $search;
                                    }
                                    else if($reason == 'Nail+Clipping'){
                                        $search = "How+to+care+for+".$breed."+after+nail+clipping";
                                        return $search;
                                    }
                                    else if($reason == 'Microchipping'){
                                        $search = "Everything+to+look+after+microchip+".$breed;
                                        return $search;
                                    }
                                    else if($reason == 'Dentstry'){
                                        $search = "Caring+for+".$breed."+after+dental+care";
                                        return $search;
                                    }
                                    else if($reason == 'New+puppies/kittens'){
                                        $search = "Looking+after+new".$breed;
                                        return $search;
                                    }
                                    else if($reason == 'Laboratory+Test'){
                                        $search = "Lab+tetst+for+".$breed;
                                        return $search;
                                    }
                                    else if($reason == 'Surgery'){
                                        $search = "Everything+you+need+to+know+before+pet+surgery";
                                        return $search;
                                    }
                                    else if($reason == 'Hospitalization'){
                                        $search = "Everything+you+need+to+know+for+pet+hosptalization";
                                        return $search;
                                    }
                                    else if($reason == 'Parasite+Prevention'){
                                        $search = "Everything+you+need+to+know+for+parasite+prevention+for+".$type;
                                        return $search;
                                    }
                                    else if($reason == 'Medicine'){
                                        $search = "Important+information+about+pet+medicine";
                                        return $search;
                                    }
                                    else if($reason == 'Behavioural+Advice'){
                                        $search = "behavioural+advice+for+".$breed;
                                        return $search;
                                    }
                                    else if($reason == 'Nutritional+Advice'){
                                        $search = "Nutritional+advice+for+".$breed;
                                        return $search;
                                    }
                                }

                                $ctype = $stmt[3];
                                $cbreed = str_replace(' ','+', $stmt[4]);
                                $csex = str_replace(' ','+', $stmt[5]);
                                $cage = $stmt[6];
                                $creason = str_replace(' ', '+', $stmt[1]);

                                $searchQuery = makeSearchString($ctype, $cbreed, $csex, $cage, $creason);

                                echo $searchQuery.'<br>';
                                echo $creason.'<br>';
                                echo $ctype.'<br>';
                                echo $cbreed.'<br>';

                                $dataGoogle = returnBingTitleLinks($searchQuery);

                                foreach($dataGoogle as $a){
                                    ?>
                                    <tr>
                                        <td> <input type = "checkbox" name = "check_list[]" value = "<?php echo $a[0] ?>" ></td>
                                        <td> <?php echo $a[0] ?></td>
                                        <td style = "font-size : 16px;"> <?php echo $a[1] ?></td>
                                        <td>
                                            <button type = "button" class="btn btn-primary justify-content-center" data-toggle="modal" data-target="#previewpage<?php echo $count;?>">Preview Page</button>

                                            <div id="previewpage<?php echo $count; $count++;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title justify-content-center" id="exampleModalLabel">Page Preview</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type = "hidden" name="links" value = <?php echo $a[0] ?> class="form-control">
                                                            </div>
                                                            <div>
                                                            <iframe style = "height : 600px; width : 1100px;" src="<?php echo $a[0] ?>"></iframe>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
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
                                        <input type = "hidden" name = "cid" value = "<?php echo $_SESSION['id']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center">
                                    <button type="button" class=" btn btn-warning"onclick="location.href='rSendsnippet.php'" ;>GO BACK</button>
                                </div>
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
    $(window).on('load', function () {
        setTimeout(removeLoader, 2000);
    });
function removeLoader(){
    $( "#loading" ).fadeOut(500, function() {
      // fadeOut complete. Remove the loading div
      $( "#loading" ).remove(); //makes page more lightweight 
  });  
}
</script>
</script>

<?php
include('includes/footer.php');
?>