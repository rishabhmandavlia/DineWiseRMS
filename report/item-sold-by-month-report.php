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
                                    <li class="breadcrumb-item">
                                        <a href="../report/view-reports.php">View reports</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Items sold by month
                                        (<?= (isset($_POST['YEAR'])) ? $_POST['YEAR'] : date("Y"); ?>)
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST">
                                <select name="YEAR" class="form-control">
                                    <option value="default">Select Year</option>
                                    <?php
                                    $initYear = 2000;
                                    while ($initYear <= 2100) {
                                        if (isset($_POST['YEAR']) && $_POST['YEAR'] == $initYear) {
                                            echo '<option value="' . $initYear . '" selected>' . $initYear . '</option>';
                                        } else if ($initYear == date("Y")) {
                                            echo '<option value="' . $initYear . '" selected>' . $initYear . '</option>';
                                        } else {
                                            echo '<option value="' . $initYear . '">' . $initYear . '</option>';
                                        }
                                        $initYear++;
                                    }
                                    ?>
                                </select>
                                <input type="submit" class="btn btn-primary my-2" />
                            </form>
                            <p class="text-dark h2">Items sold by month
                                (<?= (isset($_POST['YEAR'])) ? $_POST['YEAR'] : date("Y"); ?>)</p>
                            <table id="report-table" class="table">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <td>Month</td>
                                        <td>Category</td>
                                        <td>Item Name</td>
                                        <td>Quantity</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT
                                   DATE_FORMAT(orders.order_datetime, '%M') AS sale_month,
                                   menu_item.item_name,
                                   item_category.category_name,
                                   SUM(order_items.quantity) AS total_quantity
                               FROM
                                   orders
                               INNER JOIN order_items ON orders.order_id = order_items.order_id
                               INNER JOIN menu_item ON order_items.item_id = menu_item.item_id
                               INNER JOIN item_category ON menu_item.category_id = item_category.category_id
                               WHERE ";

                                    if (isset($_POST['YEAR']) && $_POST['YEAR'] != 'default') {
                                        $sql .= "YEAR(orders.order_datetime) = " . $_POST['YEAR'];
                                    } else {
                                        $sql .= "YEAR(orders.order_datetime) = YEAR(CURDATE())";
                                    }

                                    $sql .= " GROUP BY
                                   sale_month, menu_item.item_name, item_category.category_name
                               ORDER BY
                                   sale_month ASC, category_name ASC;";
                                    if ($result = mysqli_query($con, $sql)) {
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?= $row['sale_month'] ?></td>
                                                    <td><?= $row['category_name'] ?></td>
                                                    <td><?= $row['item_name'] ?></td>
                                                    <td><?= $row['total_quantity'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td class='table-light' colspan='4'><center><span class='h2'>No records found</span></center></td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    <script src="../plugins/marge-table/jquery.table.marge.js"></script>
    <!-- Datatable Setting js -->
    <script src="../vendors/scripts/datatable-setting.js"></script>
    <script>
        $(document).ready(function () {
            $('#report-table').margetable({
                type: 2,
                colindex: [0, 1] // column 1, 2
            });
            $('table').css('border', '1px solid black').find('td, th').css('border', '1px solid black');
        });


    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
<?php
closeDB();
?>