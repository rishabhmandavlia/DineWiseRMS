<?php
include_once "../common-functions.php";
include_once "../functions-manager.php";
connectDB();

//add image$file_name1 = '';

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $filesize = $_FILES['image']['size'];
    $filetype = $_FILES['image']['type'];
    $temp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    // Check if file is uploaded without errors
    if ($error !== UPLOAD_ERR_OK) {
        die('File upload error.');
    }

    // Validate file type
    $allowed_types = array('image/jpeg', 'image/png');
    if (!in_array($filetype, $allowed_types)) {
        die('Invalid file type. Only JPEG and PNG files are allowed.');
    }

    // Validate file size (limit to 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB in bytes
    if ($filesize > $max_size) {
        die('File size exceeds the limit. Maximum size allowed is 5MB.');
    }

    // Set directory
    $directory = 'item-image';

    // Check if the directory doesn't exist
    if (!is_dir($directory)) {
        // Create the directory
        if (!mkdir($directory, 0777, true)) {
            die('Failed to create directory');
        }
    }

    // Generate unique file name to avoid overwriting existing files
    $unique_filename = uniqid() . '_' . $file_name;

    // Move uploaded file to directory
    if (!move_uploaded_file($temp_name, "../item/item-image/" . $unique_filename)) {
        die('Failed to upload file.');
    }

    // Assign the unique file name
    $file_name1 = $unique_filename;
}


$message = "";
// echo $item_name . " ";
try {
    if (isset($_POST['additem'])) {
        $itemName = mysqli_real_escape_string($con, $_POST['itemName']);
        $itemImage = mysqli_real_escape_string($con, ("../item/item-image/$file_name1"));
        $itemDescription = mysqli_real_escape_string($con, $_POST['description']);
        $categoryId = mysqli_real_escape_string($con, ($_POST['categoryId']));
        $price = mysqli_real_escape_string($con, ($_POST['price']));



        if ($itemName == "") {
            echo '<script>alert("Please fill item name.")</script>';
        } elseif ($itemImage == "") {
            echo '<script>alert("Please select an item image")</script>';
            $message = "";
        } elseif ($categoryId == "default") {
            echo '<script>alert("Please select category for item.")</script>';
        } elseif ($itemDescription == "") {
            echo '<script>alert("Please fill item description")</script>';
        } elseif ($price == "") {
            echo '<script>alert("Please fill item price")</script>';
        } else {
            mysqli_query($con, "INSERT INTO `menu_item` (`category_id`, `item_name`, `item_image`, `item_description`, `price`) VALUES ('$categoryId','$itemName','$itemImage','$itemDescription','$price')") or die('query failed');
            echo '<script>alert("Add item successfully!")</script>';

            header('location:items.php');
        }
    }
} catch (Exception $e) {
    die($e);
}
// }

?>
<!DOCTYPE html>
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

    <!-- Added extra libs cdn here  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
                            <h4>Add Item</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Item
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
                            <div class="h5 pd-20 mb-0">Add Items</div>
                            <div class="pd-20">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text"
                                                onkeypress="return event.charCode >= 65 && event.charCode <= 123 || event.charCode == 32"
                                                placeholder="Enter Name" name="itemName" id="item-name" required>
                                        </div>
                                    </div>
                                    <script>
                                        const iname = document.getElementById('item-name');

                                        iname.addEventListener('input', function () {
                                            const nameValue = iname.value;

                                            if (nameValue.length > 0) {
                                                const capitalized = nameValue.charAt(0).toUpperCase() + nameValue.slice(1);
                                                iname.value = capitalized;
                                            }
                                        });
                                    </script>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Category</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12" name="categoryId">
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text"
                                                onkeypress="return event.charCode >= 65 && event.charCode <= 123 || event.charCode == 32"
                                                maxlength="" placeholder="Enter Description" name="description">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Price</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="100" type="text"
                                                onkeypress="return event.charCode >= 47 && event.charCode <= 57"
                                                name="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Item image</label>
                                        <!-- <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div> -->
                                        <div class="custom-file col-sm-12 col-md-10">
                                            <input type="file" name="image" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary btn-sm scroll-click" name="additem"
                                            value="Add Item">
                                    </div>
                                </form>
                            </div>
                            <!-- tab end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

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