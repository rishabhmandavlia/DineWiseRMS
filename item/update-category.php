<!DOCTYPE html>
<?php
include_once ('../common-functions.php');
include_once ('../functions-manager.php');
connectDB();
$name = '';
$msg = '';
$categoryData = null;

// Check if itemId is set
if (isset($_GET['categoryId'])) {
    $id = $_GET['categoryId'];

    // Select item data from database
    $sql = "SELECT * FROM `item_category` WHERE category_id = {$id}";
    $result = mysqli_query($con, $sql);

    // Check if item exists
    if (mysqli_num_rows($result) > 0) {
        $categoryData = mysqli_fetch_assoc($result);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = get_safe_value($con, $_POST['categoryName']);
    $categoryId = get_safe_value($con, $_POST['categoryId']);




    $image = ''; // Initialize image variable

    // Check if image is uploaded
    if ($_FILES['catImage']['type'] != '') {
        // Check if image format is valid
        if ($_FILES['catImage']['type'] != 'image/png' && $_FILES['catImage']['type'] != 'image/jpg' && $_FILES['catImage']['type'] != 'image/jpeg') {
            $msg = "Please select only png, jpg, and jpeg image formats";
        } else {
            // Generate unique image name
            $image = rand(111111111, 999999999) . '_' . $_FILES['catImage']['name'];

            // Move uploaded image to destination directory
            move_uploaded_file($_FILES['catImage']['tmp_name'], 'item-image/' . $image);
        }
    }
    // Update category query
    if ($image != '') {
        $image = '../item/item-image/' . $image;
        // If new image uploaded, update image column
        mysqli_query($con, "UPDATE item_category SET category_name='$name', category_image='$image' WHERE category_id='$categoryId'");
    } else {
        // If no new image uploaded, update only name
        mysqli_query($con, "UPDATE item_category SET category_name='$name' WHERE category_id='$categoryId'");
    }
    echo '<script>alert("Category updated successfully!")</script>';
    header("location:../item/add-category.php");
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
    <style>
        .table {
            table-layout: auto;
        }
    </style>
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
                                <h4>Update Category</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="add-category.php">Category</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Update Category
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-5">
                    <div class="h5 ">Update Category</div>

                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Category Name</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" placeholder="Enter name" name="categoryName"
                                    required value="<?php echo $categoryData['category_name'] ?>">
                                    <input type="hidden" name="categoryId" value="<?= $_GET['categoryId'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Image</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" value="50" type="file" name="catImage">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                            <div class="col-sm-12 col-md-10">
                                <input type="submit" class="btn btn-primary btn-sm scroll-click" value="Submit">
                            </div>
                        </div>

                        <div class="field_error">
                            <?php echo $msg ?>
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
</body>

</html>