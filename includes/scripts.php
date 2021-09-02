    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
        var table = $('#clients').DataTable( {
            "dom": '<"row"<"col-6"<"d-flex justify-content-left justify-content-left"<""l>>><"col-6"<"d-flex justify-content-end"<""f>>>>tp<"ml-4"i>',
            "scrollY": "420px",
            "scrollX": true,
            "paging": true,

            "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": true
            }
            ],
            
            "order": [[ 0, "desc" ]]
            } );

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

            // Get the column API object
            var column = table.column( $(this).attr('data-column') );

            // Toggle the visibility
            column.visible( ! column.visible() );
            } );
        } );

        $(document).ready(function() {
        var table = $('#allclients').DataTable( {
            "dom": '<"row"<"col-6"<"d-flex justify-content-left justify-content-left"<""l>>><"col-6"<"d-flex justify-content-end"<""f>>>>tp<"ml-4"i>',
            "scrollY": "420px",
            "scrollX": true,
            "paging": true,

            "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": true,
                "searchable": true
            }
            ],
            "order": [[ 0, "desc" ]]
            } ); 

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

            // Get the column API object
            var column = table.column( $(this).attr('data-column') );

            // Toggle the visibility
            column.visible( ! column.visible() );
            } );
        } );

    </script>