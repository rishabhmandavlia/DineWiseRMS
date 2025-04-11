<!DOCTYPE html>
<?php
include_once "../common-functions.php";
include_once "../functions-manager.php";
connectDB();
// delete
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);

        $queryGetImagePath = "SELECT item_image FROM menu_item WHERE item_id = $id";
        if ($res = mysqli_query($con, $queryGetImagePath)) {
            if (!empty($res) && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $image = $row['item_image'];
                $image = str_replace("../item/", "", $image);

                // Debugging: Echo out the modified image path
                // echo "Image Path: $image <br>";

                // Uncomment the following line after ensuring $image is correct
                // unlink($image);
            } else {
                // echo "No rows found for item_id: $id";
            }
        } else {
            // echo "Error executing query: " . mysqli_error($con);
        }

        $queryDeleteItem = "DELETE FROM menu_item WHERE item_id = $id";
        if (mysqli_query($con, $queryDeleteItem)) {
            // echo "Item deleted successfully";
        } else {
            // echo "Error deleting item: " . mysqli_error($con);
        }
    } else {
        // echo "<h1>Nothing deleted</h1>";
    }

    if ($type == 'available') {
        $id = get_safe_value($con, $_GET['id']);
        $updateStatusAvailable = "UPDATE menu_item SET status = '0' WHERE item_id=$id";
        mysqli_query($con, $updateStatusAvailable);
    }

    if ($type == 'unavailable') {
        $id = get_safe_value($con, $_GET['id']);
        $updateStatusAvailable = "UPDATE menu_item SET status = '1' WHERE item_id=$id";
        mysqli_query($con, $updateStatusAvailable);
    }

} else {
    // echo "<h1>Nothing sEt</h1>";
}


?>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>RMS HOME</title>

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
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
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

    if (isset($_SESSION['login'])) {
    } else {
        header('location: ../login/login.php');
        exit();
    }

    include_once "../sidebar.php";
    include_once "../header.php";
    include_once "../right-sidebar.php";

    ?>
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>View items</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    View item
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box pb-10" style="padding: 5px;">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <!--tab start-->

                    <div class="tab">
                        <!-- <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-selected="true">Items</a>
                            </li>
                        
                        </ul> -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel">
                                <div class="pd-20">
                                    <!--table -->
                                    <div class="h4">Items List</div>

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="data-table table table-auto nowrap dataTable no-footer dtr-inline"
                                                id="DataTables_Table_0" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="table-plus sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-sort="ascending">Item
                                                            Image</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Name</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Weight: activate to sort column ascending">Price</th>
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1"
                                                            colspan="1" aria-label="Actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    // $i = 1;
                                                    // show menu
                                                    $sql = "SELECT * FROM menu_item mi, item_category c WHERE mi.category_id = c.category_id";
                                                    if ($res = mysqli_query($con, $sql)) {
                                                        if (!empty($res) && $res->num_rows > 0) {
                                                            while ($row = mysqli_fetch_assoc($res)) { ?>
                                                                <tr role="row" class="odd">
                                                                    <td class="table-plus sorting_1 justify-content-left align-items-right"
                                                                        tabindex="0">
                                                                        <div class="name-avatar d-flex align-items-center">
                                                                            <div class="avatar mr-2 flex-shrink-0">
                                                                                <img style="width:70px;height:70px"
                                                                                    src="<?php echo $row['item_image'] ?>"
                                                                                    class="border-radius-100 shadow" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="txt">
                                                                            <div class="weight-600">
                                                                                <?php echo $row['item_name'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['category_name'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['price'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-actions">
                                                                            <?php echo "<a href='update-item.php?itemId={$row['item_id']}' title='Update' data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-edit2'></i></a>" ?>
                                                                            <?php echo "<a href='?type=delete&id=" . $row['item_id'] . "' title='Delete' data-color='#e95959' style='color: rgb(233, 89, 89);'><i class='icon-copy dw dw-delete-3'></i></a>" ?>
                                                                            <?php
                                                                            if ($row['status'] == 0) {
                                                                                echo "<a href='?type=unavailable&id=" . $row['item_id'] . "' title='Make unvailable' data-color='#111' style='color: rgb(233, 89, 89);'><i class='icon-copy bi bi-cart-x-fill'></i></a>";

                                                                            } else if ($row['status'] == 1) {
                                                                                echo "<a href='?type=available&id=" . $row['item_id'] . "' title='Make available' data-color='#111' style='color: rgb(233, 89, 89);'><i class='icon-copy bi bi-cart-check'></i></a>";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            <?php }
                                                        } else {
                                                            echo "<tr><td colspan='4'><center><h3>No items are added.</h3></center></td></tr>";
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--table end-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--tab end-->

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
</body>

</html>


<?php
closeDB();
?>