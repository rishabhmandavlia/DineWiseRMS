<!DOCTYPE html>
<?php

include_once '../common-functions.php';
include_once '../functions-manager.php';
connectDB();
// Check if itemId is set
$itemData = null;
if (isset($_GET['itemId'])) {
    $id = $_GET['itemId'];

    // Select item data from database
    $sql = "SELECT * FROM `menu_item` WHERE item_id = '{$id}'";
    $result = mysqli_query($con, $sql);

    // Check if item exists
    if (mysqli_num_rows($result) > 0) {
        $itemData = mysqli_fetch_assoc($result);

        if (isset($_POST['additem'])) {
            // Sanitize inputs
            $itemName = mysqli_real_escape_string($con, $_POST['itemName']);
            $itemDescription = mysqli_real_escape_string($con, $_POST['description']);
            $categoryId = mysqli_real_escape_string($con, $_POST['categoryId']);
            $price = mysqli_real_escape_string($con, $_POST['price']);

            // Check if image file is uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && $_FILES['image']['size'] > 0) {
                $file_name = $_FILES['image']['name'];
                $temp_name = $_FILES['image']['tmp_name'];
                $file_path = "../item/item-image/" . $file_name;

                // Move uploaded file to destination
                if (move_uploaded_file($temp_name, $file_path)) {
                    $item_image = mysqli_real_escape_string($con, $file_path);
                    $updateImageSql = "UPDATE menu_item SET item_image = '$item_image' WHERE item_id = $id";
                    if (mysqli_query($con, $updateImageSql)) {
                        // If the image update query is successful
                    } else {
                        // If there's an error updating the image
                    }
                } else {
                    echo "Failed to move uploaded file.";
                    exit();
                }
            } else {
                // No file uploaded
            }

            // Update item in database
            $updateSql = "UPDATE menu_item SET item_name = '$itemName', item_description = '$itemDescription', 
    category_id = '$categoryId', price = '$price' WHERE item_id = $id";
            if (mysqli_query($con, $updateSql)) {
                echo '<script>alert("Updated item successfully!")</script>';
                header('location:items.php');
            } else {
                echo "Error updating item: " . mysqli_error($con);
            }
        }
    } else {
        echo "Item not found.";
        exit();
    }
} else {
    echo "ItemId not set.";
    exit();
}

?>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>RMS HOME</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

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

    if (isset($_SESSION['login']) && $_SESSION['usertype'] == 'manager') {
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
                            <h4>Update item details</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Manage item</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Update item details
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

                    <div class="card-box pb-10" style="padding: 5px;">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <!-- Add Item Form -->
                            <div class="h5 pd-20 mb-0">Update items</div>
                            <div class="pd-20">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" placeholder="Enter Name"
                                                name="itemName" value="<?= $itemData['item_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Category</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12" id="item-category" name="categoryId">
                                                <option selected value="default">Choose...</option>
                                                <?php
                                                $sql = "select * from item_category";
                                                $result = mysqli_query($con, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $row['category_id']; ?>">
                                                        <?= $row['category_name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                                <script>
                                                    function selectOptionByValue(value) {
                                                        // Get the select element
                                                        var selectElement = document.getElementById('item-category');

                                                        // Loop through each option
                                                        for (var i = 0; i < selectElement.options.length; i++) {
                                                            // If the option's value matches the given value, select it
                                                            if (selectElement.options[i].value == value) {
                                                                selectElement.selectedIndex = i;
                                                                break; // Stop the loop once the option is selected
                                                            }
                                                        }
                                                    }
                                                    selectOptionByValue("<?= $itemData['category_id'] ?>");

                                                </script>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" placeholder="Enter Description"
                                                name="description" value='<?= $itemData['item_description'] ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Price</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="<?= $itemData['price'] ?>" type="number"
                                                name="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Item image</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="file" id="image" name="image" value="">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary btn-sm scroll-click" name="additem"
                                            value="Update Item">
                                    </div>
                                </form>
                            </div>
                            <!-- tab end -->

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
</body>

</html>