<?php
include_once "../common-functions.php";
connectDB();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>RMS Dashboard</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
    <style>
        .card:hover {
            transform: scale(1.10);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            z-index: 1;
            transition: 300ms;
        }
    </style>
</head>

<body>
    <?php
    include_once "../sidebar.php";
    include_once "../header.php";
    include_once "../right-sidebar.php";

    ?>


    <div class="main-container" id="dashboard-content">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Dashboard</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Overview of the restaurant -->

                <div class="row pb-10">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="pending-orders-count">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Pending Orders
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#ffc107">
                                        <i class="micon dw dw-clipboard1" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="unpaid-orders-count">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Unpaid Orders</div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#ffc107">
                                        <i class="micon dw dw-clipboard1" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="monthly-revenue">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Current Month Revenue</div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#09cc06">
                                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="customer-waiting-count">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Customers in waiting
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#00eccf">
                                        <i class="icon-copy bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="available-table-count">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Available tables
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#ff5b5b">
                                        <img src="../vendors/images/table-icon.png"
                                            style="height:50px;filter:invert(1);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark" id="occupied-table-count">
                                        Loading...
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Occupied tables
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon">
                                        <img src="../vendors/images/table-icon.png"
                                            style="height:50px;filter:invert(0.7);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pd-20 card-box">
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#waiting-list" role="tab"
                                    aria-selected="false">Waiting List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#unpaid-orders-list" role="tab"
                                    aria-selected="false">Unpaid Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pending-orders-list" role="tab"
                                    aria-selected="true">Pending Orders</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="waiting-list" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-12 overflow-auto">
                                        <table class="table table-auto nowrap dataTable no-footer dtr-inline"
                                            role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th class="table-plus sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        aria-sort="ascending">Visit No.</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1">Customer Name</th>
                                                    <th class="datatable-nosort sorting_disabled" rowspan="1"
                                                        colspan="1">Contact
                                                        No.</th>
                                                    <th class="datatable-nosort sorting_disabled" rowspan="1"
                                                        colspan="1">Booked For
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="customer-waiting-list">
                                                <tr>
                                                    <td class='table-light' colspan='4'>No bookings for today
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="unpaid-orders-list" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-12 overflow-auto">
                                        <table class="table table-auto nowrap dataTable no-footer dtr-inline"
                                            role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th>Customer Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Order Date</th>
                                                    <th>Order Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pending-payments-table">
                                                <tr>
                                                    <td class='table-light' colspan='4'>No payments are pending
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pending-orders-list" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-12 overflow-auto">
                                        <table class="table table-auto nowrap dataTable no-footer dtr-inline"
                                            role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th>Customer Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Order Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pending-orders-table">
                                                <tr>
                                                    <td class='table-light' colspan='4'>No orders are pending
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <!-- welcome modal end -->
    <!-- js -->
    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
    <script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="../vendors/scripts/datatable-setting.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>
        var ajaxInterval;

        function refreshContent() {
            $.ajax({
                type: "post",
                url: "customer-waiting-list.php",
                success: function (response) {
                    $("#customer-waiting-list").html(response);
                    if (response == "<tr><td class='table-light' colspan='4'>No bookings for today</td></tr>") {
                        $("#customer-waiting-count").html(0);
                    } else {
                        var rowCount = $("#customer-waiting-list tr").length;
                        $("#customer-waiting-count").html(rowCount);
                    }
                }
            });

            $.ajax({
                type: "post",
                url: "pending-payments.php",
                success: function (response) {
                    $("#pending-payments-table").html(response);
                }
            });

            $.ajax({
                type: "post",
                url: "pending-orders.php",
                success: function (response) {
                    $("#pending-orders-table").html(response);
                }
            });

            $.ajax({
                type: "post",
                url: "fetch-data.php",
                data: {
                    unpaidOrders: true,
                    pendingOrders: true,
                    monthlyRevenue: true,
                    availableTable: true,
                    occupiedTable: true,
                },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#unpaid-orders-count").html(data.unpaidOrders);
                    $("#pending-orders-count").html(data.pendingOrders);
                    $("#monthly-revenue").html(data.monthlyRevenue);
                    $("#available-table-count").html(data.availableTable);
                    $("#occupied-table-count").html(data.occupiedTable);

                }
            });
        }
        // setInterval(refreshContent, 1000);
        refreshContent();

        // Variable to store the interval ID
        let intervalId;

        // Start the interval initially
        intervalId = setInterval(refreshContent, 1000);

        // Function to pause interval
        function pauseInterval() {
            clearInterval(intervalId);
        }

        // Function to resume interval
        function resumeInterval() {
            intervalId = setInterval(refreshContent, 1000);
        }

        // Event listener for mouseenter and mouseleave events on the table
        document.querySelectorAll('table').forEach(table => {
            table.addEventListener('mouseenter', pauseInterval);
            table.addEventListener('mouseleave', resumeInterval);
        });

        // Event listener for scroll event on the window
        window.addEventListener('scroll', () => {
            if (document.querySelector('table:hover') !== null) {
                pauseInterval();
            } else {
                resumeInterval();
            }
        });


    </script>
</body>

</html>