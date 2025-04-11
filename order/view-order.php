<?php
include_once "../common-functions.php";
connectDB();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>View Order</title>

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
        .active-yellow {
            background-color: #ffc107 !important;
            color: white !important;
        }

        .active-blue {
            background-color: #138496 !important;
            color: white !important;
        }

        .active-green {
            background-color: #218838 !important;
            color: white !important;
        }

        .status-cell {
            background-color: #f8fafb;
            color: black;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    include_once "../sidebar.php";
    include_once "../header.php";
    include_once "../right-sidebar.php";

    ?>


    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>View Order</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../order/view-order.php">Order</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        View Order
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <!--  Add content From here -->
                    <!-- Also manage breadcrumbs and Page title at line 73 and 76 -->
                    <div class="row">
                        <!-- Search bar -->
                        <div class="col-md-12 col-sm-12">
                            <p class="h5 py-3 px-2">Order Tracking</p>
                            <div class="">

                            </div>
                        </div>
                    </div>
                    <!-- <p class="font-weight-bold ml-3 m-0">Filtering</p>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <button class="btn btn-warning ml-3 text-white">Queue</button>
                            <button class="btn btn-info ml-2 text-white">Preparation</button>
                            <button class="btn btn-success ml-2 text-white">Completed</button>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" class="form-control my-2" placeholder="Search">
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-12" id="order-items-list">
                            <!-- Order item will appear here -->

                            <!-- Order will appear here -->
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>
        $(document).ready(function () {
            // setInterval(getOrders, 1000);
            getOrders();
            function getOrders() {
                $.ajax({
                    type: "post",
                    url: "../order/get-orders.php",
                    data: "data",
                    success: function (response) {
                        $("#order-items-list").html(response);
                    }
                });
            }

            $(document).on('click', '.prep', function () {
                let orderId = $(this).parent().attr('data-order-id');
                $.ajax({
                    type: "post",
                    url: "manage-order-status.php",
                    data: {
                        type: "prep",
                        orderId: orderId
                    },
                    success: function (response) {
                        if (response == "updated to prep") {
                            console.log(response)
                            getOrders();
                        }
                    }
                });
            });
            $(document).on('click', '.queue', function () {
                let orderId = $(this).parent().attr('data-order-id');
                $.ajax({
                    type: "post",
                    url: "manage-order-status.php",
                    data: {
                        type: "queue",
                        orderId: orderId
                    },
                    success: function (response) {
                        if (response == "updated to queue") {
                            console.log(response)
                            getOrders();
                        }
                    }
                });
            });
            $(document).on('click', '.completed', function () {
                let orderId = $(this).parent().attr('data-order-id');
                $.ajax({
                    type: "post",
                    url: "manage-order-status.php",
                    data: {
                        type: "completed",
                        orderId: orderId
                    },
                    success: function (response) {
                        if (response == "updated to completed") {
                            console.log(response)
                            getOrders();
                        }
                    }
                });
            });

            $(document).on('click', '.pending', function () {
                let orderId = $(this).parent().attr('data-order-id');
                $.ajax({
                    type: "post",
                    url: "manage-order-status.php",
                    data: {
                        type: "pending",
                        orderId: orderId
                    },
                    success: function (response) {
                        if (response == "updated to pending") {
                            console.log(response)
                            getOrders();

                        }
                    }
                });
            });

            $(document).on('click', '.done', function () {
                let orderId = $(this).parent().attr('data-order-id');
                $.ajax({
                    type: "post",
                    url: "manage-order-status.php",
                    data: {
                        type: "done",
                        orderId: orderId
                    },
                    success: function (response) {
                        if (response == 'updated to done') {
                            getOrders();
                        }
                    }
                });
            });

            <?php
            if (isset($_GET['searchOrder'])) {
                $id = $_GET['searchOrder'];
                echo "$('html, body').animate({
                    scrollTop: $('div[data-order-id=$id]').offset().top
                }, 1000);";                
            }
            ?>

        });
    </script>
</body>

</html>