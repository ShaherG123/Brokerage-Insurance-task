<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Task Brokerage Insurance</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="frontend/css/customStyles.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!-- Begin page -->
        <div id="wrapper">
            @include('components.topbar')
            @include('components.sidebar')
            <main>@yield('content')</main>
        </div>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- fullcalendar plugins -->
        <script src="assets/libs/moment/moment.js"></script>
        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/libs/fullcalendar/fullcalendar.min.js"></script>

        <!-- fullcalendar js -->
        <script src="assets/js/pages/fullcalendar.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables/buttons.print.min.js"></script>
        <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
        <!-- third party js ends -->
        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>
        <!-- Modal-Effect -->
        <script src="{{url('assets/libs/custombox/custombox.min.js')}}"></script>

        @if($type == 'users')
            <script src="/frontend/datatables/users.js"></script>
            <script src="/frontend/actions/users.js"></script>
        @elseif($type == 'customers')
            <script src="/frontend/actions/customers.js"></script>
            <script src="/frontend/datatables/customers.js"></script>
        @endif
        <script src="/frontend/actions.js"></script>
    </body>
</html>