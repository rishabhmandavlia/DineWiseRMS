<?php
include_once "../common-functions.php";
connectDB();

if (!isset($_SESSION['customer_id'])) {
    header("location:table-booking.php");
}


if (isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];
    $queryCheckVisit = "SELECT * FROM customer_visit WHERE visit_finished = 0 AND cust_id = {$customerId}";
    if ($visitExist = mysqli_query($con, $queryCheckVisit)) {
        if (!empty($visitExist) && $visitExist->num_rows > 0) {
            // There is a unfinished visit
            $_SESSION['visit_id'] = $visitExist->fetch_assoc()['visit_id'];
        }
    }
}



?>
<!DOCTYPE html>
<?php
require ('top.php');
?>
<div class="container-fluid bg-dark hero-header py-5 mb-5">
    <div class="container text-center">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal" style="font-size:30px">Booking</h5>
        <h3 class="h3 text-white my-3 animated slideInDown">
            <?php
            if (isset($_SESSION['full_name'])) {
                echo $_SESSION['full_name'];
            }
            ?>
        </h3>
    </div>
</div>



<!-- About Start -->
<div class="container-fluid my-2">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" id="booking-response">

            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg"
                            style="margin-top: 25%;">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- About End -->

<div class="modal" id="exit-confirmation-modal" tabindex="10">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ff-secondary">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel your booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="cancel-visit-button" class="btn btn-danger"
                    data-visit-id='<?= $_SESSION['visit_id'] ?>'>Cancel Booking</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal" id="finish-confirmation-modal" tabindex="10">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ff-secondary">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Thank you for dining with us! As you're leaving, would you like to confirm and finalize your booking?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="finish-confirmation-button" class="btn btn-success"
                    data-visit-id='<?= $_SESSION['visit_id'] ?>'>Finish</button>
            </div>
        </div>
    </div>
</div>

<?php require ('footer.php'); ?>
<script>
    $(document).ready(function () {
        // nav link active
        $("#booking-link").addClass("active");
        fetchStatus();
        // Show modal on booking cancellation
        $(document).on('click', "#exit-booking", function () {
            $("#exit-confirmation-modal").modal("show");
            // console.log("message")
        });
        $(document).on('click', "#finish-booking", function () {
            $("#finish-confirmation-modal").modal("show");
            // console.log("message")
        });

        $(document).on('click', "#confirm-booking", function () {
            $.ajax({
                type: "post",
                url: "table-status.php",
                data: {
                    action: "seated"
                },
                success: function (response) {
                    if (response == 'Seated Updated') {
                        fetchStatus();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', "#finish-confirmation-button", function () {

            $.ajax({
                type: "post",
                url: "table-status.php",
                data: {
                    action: "finish"
                },
                success: function (response) {
                    if (response == 'Visit finished') {
                        // fetchStatus();
                        setTimeout(location.reload(), 500);
                    } else {

                    }
                }
            });
        });

        // Cancel visit in modal
        $(document).on('click', "#cancel-visit-button", function (e) {
            visit_id = $(e.target).attr('data-visit-id');
            $.ajax({
                type: "post",
                url: "cancel-booking.php",
                data: {
                    visitId: visit_id
                },
                success: function (response) {
                    if (response == 'Cancelled') {
                        location.reload();
                    } else {

                    }
                }
            });
        });
    });

    function runAllocation() {
        $.ajax({
            type: "post",
            url: "table-allocator.php",
            success: function (response) {
                console.log("algorithm executed");
            }
        });
    }

    function fetchStatus() {
        $.ajax({
            type: "post",
            url: "booking-status.php",
            success: function (response) {
                console.log("Page updated");
                $("#booking-response").html(response);
            }
        });
    }

    function checkSession(){
        $.ajax({
            type: "post",
            url: "check-session.php",
            success: function (response) {
                if(response == "destoryed session"){
                    location.reload();
                }else {
                    console.log("nothing in respose")
                }
            }
        })
    }

    // setInterval(runAllocation, 1000 * 5);
    setInterval(fetchStatus, 1200 * 3);
    setInterval(checkSession, 2000);

</script>