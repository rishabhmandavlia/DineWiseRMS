<?php
include_once "../common-functions.php";
connectDB();
include_once "../functions-manager.php";

if (isset ($_POST["approv"])) {
    $id = $_POST['id'];

    $select = "UPDATE manager SET mgr_status='1' WHERE mgr_id='$id'";
    $result = mysqli_query($con, $select);

    echo '<script type="text/javascript">';
    echo 'alert("User is Approved")';
    echo '</script>';
    // header("Location: ../registration/approval.php");
    // exit();
}
if (isset ($_POST["deny"])) {
    $id = $_POST['id'];

    $select = "UPDATE manager SET mgr_status='0' WHERE mgr_id='$id'";
    $result = mysqli_query($con, $select);

    echo '<script type="text/javascript">';
    echo 'alert("User is Denyed")';
    echo '</script>';
    header("Location: ../registration/approval.php");
    // exit();
}
if (isset ($_POST["accept"])) {
    $id = $_POST['id'];

    $select = "UPDATE manager SET mgr_status='1' WHERE mgr_id='$id'";
    $result = mysqli_query($con, $select);

    echo '<script type="text/javascript">';
    echo 'alert("User request is Accepted")';
    echo '</script>';
    // header("Location: ../registration/approval.php");
    // exit();
}
if (isset ($_POST["reject"])) {
    $id = $_POST['id'];

    $select = "SELECT * FROM manager WHERE mgr_id='$id'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);
    $email = $row['emailid'];
    $pass = $row['mgr_password'];

    $sql = "INSERT INTO rejected_person (email, password) VALUES ('$email','$pass')";
    mysqli_query($con, $sql);

    $delete_sql = "delete from manager where mgr_id='$id'";
    mysqli_query($con, $delete_sql);

    echo '<script type="text/javascript">';
    echo 'alert("User is rejected")';
    echo '</script>';
    // header("Location: ../registration/approval.php");
    // exit();
}

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


    if (isset ($_SESSION['usertype']) && $_SESSION['usertype'] != 'admin') {
        header('location:../login/login.php');
        die();
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
                            <h4>Request Approval</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Request Approval
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box pb-10" style="padding: 5px;">
                <div class="h5 pd-20 mb-0">Users list</div>
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>

                    <!--table end-->

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="data-table table nowrap dataTable no-footer dtr-inline"
                                id="DataTables_Table_0" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="table-plus sorting_asc" tabindex="0"
                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                            aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                            Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Gender: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Gender: activate to sort column ascending">Contact
                                            no</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Weight: activate to sort column ascending">Gender
                                        </th>
                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="Actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    // $i = 1;
                                    
                                    $sql = "select * from manager";
                                    if ($res = mysqli_query($con, $sql)) {

                                        while ($row = mysqli_fetch_assoc($res)) { ?>

                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">
                                                    <div class="name-avatar d-flex align-items-center">
                                                        <div class="avatar mr-2 flex-shrink-0">
                                                            <div class="weight-600">
                                                                <?php echo $row['mgr_firstname'] ?>
                                                            </div>
                                                            <!--<img src="<php// echo '../mvendors/itemimages/' . $row['image'] ?>" class="border-radius-100 shadow" width="50" height="50" alt="">-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="txt">
                                                        <div class="weight-600">
                                                            <?php echo $row['mgr_emailid'] ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="txt">
                                                        <div class="weight-600">
                                                            <?php echo $row['mgr_phone_number'] ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $row['mgr_gender'] ?>
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        <form action="#" method="post">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $row['mgr_id']; ?>">
                                                            <?php if ($row['mgr_status'] == "") { ?>
                                                                <input type="submit" class="btn btn-outline-primary" value="Accept"
                                                                    name="accept">
                                                                <input type="submit" class="btn btn-outline-danger" value="Reject"
                                                                    name="reject">
                                                            <?php } else if ($row['mgr_status'] == "0") { ?>
                                                                    <input type="submit" class="btn btn-outline-primary" value="Enable"
                                                                        name="approv">
                                                            <?php } else if ($row['mgr_status'] == "1") { ?>
                                                                        <input type="submit" class="btn btn-outline-danger" value="Disable"
                                                                            name="deny">
                                                                        <input type="submit" class="btn btn-outline-danger" value="Delete"
                                                                            name="reject">
                                                            <?php } ?>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
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