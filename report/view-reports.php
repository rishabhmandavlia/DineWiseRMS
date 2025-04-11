<?php
include_once "../common-functions.php";
connectDB();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>RMS Reports</title>

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
                                <h4>View reports</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../report/view-reports.php">Reports</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        View reports
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <form id="selection-form" action="">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="form-label">Select report</label>
                                <select name="report-type" id="select-report" class="custom-select col-12"
                                    onchange="changeUrl()" required>
                                    <option value="default" selected>Choose...</option>
                                    <option value="../report/item-sold-by-month-report.php">Items sold by month (current
                                        year)</option>
                                    <option value="../report/orders-by-date-report.php">Total orders of each date
                                    </option>
                                    <option value="../report/top-selling-item-report.php">Top selling items report
                                    </option>
                                    <option value="../report/revenue-by-month-report.php">Revenue by month report
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="submit" class="btn btn-primary my-2" />
                            </div>
                        </div>
                    </form>
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
        function changeUrl() {
            var url = document.querySelector("#select-report").value;
            var form = document.getElementById("selection-form");
            form.action = url;
        }

        document.getElementById('selection-form').addEventListener('submit', function (event) {
            var selectElement = document.getElementById('select-report');
            var selectedValue = selectElement.value;
            var defaultValue = "default"; // Change this if the default value is different

            if (selectedValue === defaultValue) {
                event.preventDefault(); // Prevent form submission
                alert('Please select a report type.'); // Show an alert or any other validation message
            }
        });
    </script>
</body>

</html>
<?php
closeDB();
?>