<?php
include_once "../common-functions.php";
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
    <style>
        /* It is used to add show on the containers that has contains details and views for each table */
        .col-mod {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            border-radius: 15px;
        }

        .table-container {
            /* margin: 15px; */
            height: auto;
            width: auto;
            /* min-width: 150px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .table-outline {
            height: auto;
            width: auto;
        }

        .table-row {
            /* TABLE COLOR */
            height: 40px;
            width: auto;
            background-color: white;
            margin-top: 3px;
            margin-bottom: 3px;
            border: 2px solid #000;
            border-radius: 5px;
        }

        .chair-row-top {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chair-row-bottom {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chair {
            background-color: #FFF;
            margin-left: 5px;
            margin-right: 5px;
            width: 20px;
            height: 20px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .neon-red {
            box-shadow: 0 0 5px 1px #f50000;
        }

        .red-border {
            box-shadow: 0 0 5px 1px rgba(255, 0, 0, 1);
        }

        .red-border:hover {
            background-color: rgba(255, 0, 0, 0.1);
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
                                <h4>Manage Tables</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Manage</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Tables
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
                        <div class="col-md-12">
                            <?php
                            if ($_SESSION['usertype'] == 'manager') {
                                ?>
                                <div class="">
                                    <strong>Actions</strong>
                                    <div class="row me-1">
                                        <div class="mx-1 btn btn-small btn-light" data-toggle="modal"
                                            data-target="#add-table-modal">
                                            <i class="icon-copy mx-2 bi bi-plus-circle-fill" data-toggle="tooltip"
                                                title="Add New Table"></i>
                                        </div>
                                        <div id="delete-table-mode" class="mx-1 btn btn-small btn-light"
                                            data-toggle="tooltip" title="Delete mode">
                                            <i class="icon-copy mx-2 fa fa-remove" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                </div>
                                <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col pt-2">
                                    <strong>Status info</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12 ml-3 d-flex align-items-center justify-content-left"
                                    style="color:#ff7929;">
                                    Occupied -
                                    <div class="ml-1" style="background-color:#ff7929;width:15px;height: 15px;"></div>
                                </div>

                                <div class="col-md-3 col-sm-12 ml-3 d-flex align-items-center justify-content-left"
                                    style="color:#328bff;">
                                    Reserved -
                                    <div class="ml-1" style="background-color:#328bff;width:15px;height: 15px;"></div>
                                </div>

                                <div class="col-md-3 col-sm-12 ml-3 d-flex align-items-center justify-content-left"
                                    style="color:#28a745;">
                                    Unoccupied -
                                    <div class="ml-1"
                                        style="background-color:#FFF;border:1px solid black;width:15px;height: 15px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col pt-2">
                                    <strong>Tables</strong>
                                </div>
                                <div id="action-info-text" class="d-flex align-items-center justify-content-left pt-2">

                                </div>
                            </div>

                            <div id="tables-view" class="row px-3">
                                <!-- Ajax data will show here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade bs-example-modal-lg" id="add-table-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Add new table
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add new table's form -->
                    <form id="add-table-form">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Table no.</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" id="table-no" name="tableNo" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">No. of seats</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" id="table-seats-count" name="tableSeatCount" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Location</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" id="table-location" name="tableLocation" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                            <div class="col-sm-12 col-md-10">
                                <input type="submit" class="btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="add-table-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Confirmation
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <h1 class="text-success">Table Added</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="table-deleted-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Confirmation
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <h1 class="text-success">Table Deleted</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete table model -->
    <div class="modal fade bs-example-modal-lg" id="delete-table-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Delete Confirmation
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <p>Are you sure you want to delete <span id="table-no-to-delete"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" data-tableid="" id="delete-table-button">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="deallocate-table-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Confirmation
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <p>Are you sure you want to free <span id="table-no-to-deallocate"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" data-tableid="" id="deallocate-table-button">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
    <script src="../js-validation.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>

        // Table allocator ajax call is in core.js

        function showTables() {
            $.ajax({
                type: "post",
                url: "./ajax-show-tables.php",
                data: "data",
                success: function (response) {
                    $('#tables-view').html(response);
                    console.log("Updated tables view");
                }
            });
        }


        $(document).ready(function () {

            showTables();


            $(document).on('click', ".table-container", function () {
                let tableStatus = $(this).attr('data-status');
                let tableId = $(this).attr('data-tableid');
                let tableNo = $(this).attr('data-tableno');
                // console.log(tableStatus)
                // console.log(tableId)
                // console.log(tableNo)
                if (tableStatus == 1) {
                    $("#deallocate-table-button").attr("data-tableid", tableId);
                    $("#table-no-to-deallocate").html('<b>table no.' + tableNo + '</b>');
                    $("#deallocate-table-confirmation-modal").modal("show");
                }
            });


            $("#add-table-form").on('submit', function (e) {
                e.preventDefault();
                let tableNo = $("#table-no").val();
                let tableSeatsCount = $("#table-seats-count").val();
                let tableLocation = $("#table-location").val();
                console.log(tableNo + " " + tableSeatsCount + " " + tableLocation);
                if (!isNumber(tableNo)) {
                    alert("Invalid table no");
                } else if (!isNumber(tableSeatsCount)) {
                    alert("Invalid seats count");
                } else if (!isValidString(tableLocation)) {
                    alert("Invalid location");
                } else {
                    $.ajax({
                        type: "post",
                        url: "./add-table-to-db.php",
                        data: $("#add-table-form").serialize(),
                        // data: $("#add-table-form").serialize(),
                        success: function (response) {
                            $("#add-table-modal").modal('hide');
                            $("#add-table-confirmation-modal").modal('show');
                            setTimeout(function () {
                                $("#add-table-confirmation-modal").modal('hide');
                                location.reload();
                            }, 1200)
                            $("#table-no").val('');
                            $("#table-seats-count").val('');
                            $("#table-location").val('');
                        }
                    });

                }
            });

            // Code to handle deletion of table
            $("#delete-table-mode").on('click', function (e) {
                if ($("#delete-table-mode").hasClass('bg-danger')) {
                    closeDeleteMode();
                } else {
                    openDeleteMode();
                }
            });

            function closeDeleteMode() {
                $("#delete-table-mode").removeClass('bg-danger');
                $("#delete-table-mode").removeClass('text-white');
                $("#delete-table-mode").removeClass('neon-red');
                $(".col-mod").removeClass("red-border");
                $("#action-info-text").html('');
                toggleInterval();
            }

            function openDeleteMode() {
                const deleteInfo = `
                <span class="my-1 mr-3 p-2 bg-danger text-white border rounded-pill">
                    <i class="icon-copy fi-trash"></i>
                    Click on table to delete
                </span>
                `;
                $("#delete-table-mode").addClass('bg-danger');
                $("#delete-table-mode").addClass('text-white');
                $("#delete-table-mode").addClass('neon-red');
                $(".col-mod").addClass("red-border");
                $("#action-info-text").html(deleteInfo);
                toggleInterval();
            }

            $(document).on('click', ".deletable", function (e) {
                // console.log(e.target.parentElement)
                // console.log(e.target.children[1].children[0]) // will return Table No. 1
                value = $(this).find('.table-num').text();
                tableId = $(this).attr('data-tableid');
                $("#delete-table-button").attr('data-tableid', tableId); // Setting table id to modal's delete button

                if ($("#delete-table-mode").hasClass("bg-danger")) { // Setting table no to modal info text
                    $("#delete-table-confirmation-modal").modal("show");
                    $("#table-no-to-delete").html('<b>' + value + '</b>');
                }
            });

            $("#delete-table-button").on('click', () => {
                if ($("#delete-table-mode").hasClass("bg-danger")) {
                    $.ajax({
                        type: "post",
                        url: "./delete-table-db.php",
                        data: {
                            tableId: $("#delete-table-button").attr('data-tableid')
                        },
                        success: function (response) {
                            $("#delete-table-confirmation-modal").modal("hide");

                            if (response == "table deleted") {
                                $("#table-deleted-confirmation-modal").modal("show");
                                setTimeout(function () {
                                    $("#table-deleted-confirmation-modal").modal('hide');
                                    location.reload();
                                }, 1200);
                            } else {
                                alert("Some error occured while deleting table");
                            }
                        }
                    });
                }
            });
            $("#deallocate-table-button").on('click', () => {
                $.ajax({
                    type: "post",
                    url: "./deallocate-table.php",
                    data: {
                        tableId: $("#deallocate-table-button").attr("data-tableid")
                    },
                    success: function (response) {
                        if (response == "deleted") {
                            $("#deallocate-table-confirmation-modal").modal("hide");
                        } else {
                            alert("Some error occured while deallocating table");
                        }
                    }
                });
            });

        });

        let intervalId;
        startInterval();
        function startInterval() {
            intervalId = setInterval(showTables, 1000);
        }

        function stopInterval() {
            clearInterval(intervalId);
        }

        let isIntervalRunning = true;

        function toggleInterval() {
            if (isIntervalRunning) {
                stopInterval();
                isIntervalRunning = false;
                console.log("Interval stopped.");
            } else {
                startInterval();
                isIntervalRunning = true;
                console.log("Interval started.");
            }
        }



    </script>
</body>

</html>