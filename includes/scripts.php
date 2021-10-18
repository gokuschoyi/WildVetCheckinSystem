    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="js/chart.js/Chart.min.js"></script>
    <!-- <script src="vendor\bootstrap\js\bootstrap.min.js.map"></script>
    <script src="vendor\fontawesome-free\css\all.min.css"></script>
    <script src="vendor\jquery\jquery.min.js"></script>
    <script src="vendor\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="vendor\bootstrap\js\bootstrap.bundle.min.js.map"></script>
    <script src="vendor\fontawesome-free\css\all.min.css"></script> -->
    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="../allVendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../allVendor/sweetalert2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="js/GraphsAndCharts/app.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appA.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appB.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appCPieChart.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appDPieChart.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appEPieChart.js"></script>
    <script type="text/javascript" src="js/GraphsAndCharts/appERadar.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#clients').DataTable({
                "dom": '<"row"<"col-6"<"d-flex justify-content-left justify-content-left"<""l>>><"col-6"<"d-flex justify-content-end"<""f>>>>tp<"ml-4"i>',
                "scrollY": "420px",
                "scrollX": true,
                "paging": true,

                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": true
                }],

                "order": [
                    [0, "desc"]
                ]
            });

            $('a.toggle-vis').on('click', function(e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
            });
        });

        $(document).ready(function() {
            var table = $('#allclients').DataTable({
                "dom": '<"row"<"col-6"<"d-flex justify-content-left justify-content-left"<""l>>><"col-6"<"d-flex justify-content-end"<""f>>>>tp<"ml-4"i>',
                "scrollY": "420px",
                "scrollX": true,
                "paging": true,

                "columnDefs": [{
                    "targets": [0],
                    "visible": true,
                    "searchable": true
                }],
                "order": [
                    [0, "desc"]
                ]
            });

            $('a.toggle-vis').on('click', function(e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
            });
        });

        $(document).ready(function() {
            var table = $('#linktable').DataTable({
                "dom": '<"row"<"col-6"<"d-flex justify-content-left justify-content-left"<""l>>><"col-6"<"d-flex justify-content-end"<""f>>>>tp<"ml-4"i>',
                "scrollY": "680px",
                "scrollX": true,
                "paging": true,
                "pageLength": 20,
                "columnDefs": [{
                    "targets": [1],
                    "visible": false,
                    "searchable": true
                }],
                "order": [
                    [0, "desc"]
                ]
            });

        });

        
            $(window).on('load',function(){
                setTimeout(function(){ // allowing 3 secs to fade out loader
                $('.loader-wrapper').fadeOut('slow');
                },2000);
            });
        
    </script>

    <?php
        if((isset($_SESSION['status']) && $_SESSION['status']) !='')
        {
            ?>
            <script>
                Swal.fire({
                icon: '<?php echo $_SESSION['status_code']?>',
                title: '<?php echo $_SESSION['status']?>',
                
            })
            </script>
            <?php unset($_SESSION['status']);
        }
    ?>

<?php
        if((isset($_SESSION['statusDr']) && $_SESSION['statusDr']) !='')
        {
            ?>
            <script>
                Swal.fire({
                icon: '<?php echo $_SESSION['status_codeDr']?>',
                title: '<?php echo $_SESSION['statusDr']?>',
                
            })
            </script>
            <?php unset($_SESSION['statusDr']);
        }
    ?>

<script>
    $(document).ready(function(){
        // updating the view with notifications using ajax
        function load_unseen_notification(view = '')
        {
            $.ajax({
            url:"dataNotification.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
            $('.dropdown-list').html(data.notification);
            if(data.unseen_notification > 0)
            {
                $('.count').html(data.unseen_notification);
                $ct = data.unseen_notification;
            }
            
            }
            });
        }
        
        load_unseen_notification();
        // load new notifications
        $(document).on('click', '.dropdown-toggle', function(){
            $('.count').html('');
            load_unseen_notification('Yes');//Yes
            });
            setInterval(function(){
            load_unseen_notification();;
        }, 30000);
        });
</script>
    