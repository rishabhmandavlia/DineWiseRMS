<?php
include_once "../common-functions.php";
connectDB();
if (isset($_SESSION['customer_id'])) {
    $queryCheckVisit = "SELECT * FROM customer_visit WHERE DATE(visiting_datetime) = CURDATE() AND visit_finished = 0 AND cust_id = {$_SESSION['customer_id']}";
    if ($visitExist = mysqli_query($con, $queryCheckVisit)) {
        if (!empty($visitExist) && $visitExist->num_rows > 0) {
            // Please finish previous visit
            // echo "Please finish previous visit";
            header("location:view-booking.php");
        }
    }
}

if(isset($_SESSION['visit_id'])) {
    unset($_SESSION['visit_id']);
}
?>
<!DOCTYPE html>
<?php require ('top.php'); ?>

<div class="container-fluid py-5 bg-dark hero-header mb-5">
    <div class="container text-center">
    <h5 class="section-title ff-secondary text-center text-primary fw-normal" style="font-size:30px">Booking</h5>
    </div>
</div>
<!-- Navbar & Hero End -->

<!-- Reservation Start -->
<div class="container-fluid px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-12 col-sm-12 bg-dark d-flex align-items-center">
            <div class="container p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Book A Table Online</h1>
                <form method="post" id="booking-form" action="booking.php">
                    <div class="row g-3">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-floating">
                                <input type="number" name="contactNo" maxlength="10" class="form-control"
                                    id="contact-no" placeholder="Your Phone No"
                                    value="<?= (isset($_COOKIE['contact_no'])) ? $_COOKIE['contact_no'] : '' ?>">
                                <label for="number">Your Phone No (10 Digits)</label>
                            </div>
                            <div id="contact-message"></div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" readonly id="name" name="fullName"
                                    placeholder="Your Name"
                                    value="<?= (isset($_COOKIE['full_name'])) ? $_COOKIE['full_name'] : '' ?>">
                                <label for="name">Your Full Name</label>
                            </div>
                            <div id="name-message"></div>
                        </div>
                        <?php
                            $sqlGetMaxTableSize= "SELECT MAX(table_seats) FROM tables";
                            if($tableSize = mysqli_query($con, $sqlGetMaxTableSize)) {
                                if(!empty($tableSize) && $tableSize->num_rows > 0) {
                                    $tableSize = $tableSize->fetch_assoc();
                                    $tableSize = $tableSize['MAX(table_seats)'];
                                }
                            } else {
                                $tableSize = 15;
                            }
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="no-of-person" name="noOfPerson"
                                    placeholder="Number of person" max="<?= $tableSize ?>">
                                <label for="number">No. of person</label>
                                <div id="no-of-person-message"></div>

                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <input id="remember-me" class="form-check-input" type="checkbox" value="true"
                                name="rememberMe" checked />
                            <label for="remember-me" class="form-check-label text-light">Remember me</label>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->

<?php require ('footer.php'); ?>
<script src="../js-validation.js"></script>
<script>
    function checkUserExists() {
        let contactNo = $("#contact-no").val();
        let noOfPerson = $("#no-of-person").val();
        let name = $("#name").val();

        // Check if user already exists
        $.ajax({
            type: "post",
            url: "./check-user-exist.php",
            data: {
                contactNumber: contactNo
            },
            success: function (response) {
                resp = JSON.parse(response);
                console.log(resp)
                if (resp.status == 'found') {
                    $("#name").val(resp.cust_name);
                    $("#name").attr('readonly', 'true');
                } else if (resp.status == 'not found') {
                    if (contactNo.length > 9 && contactNo.length < 11) {
                        $("#name").removeAttr('readonly');
                    } else {
                        $("#name").attr('readonly', 'true');
                    }
                    $("#name").val('');
                }
            }
        });
    }


    $(document).ready(function () {

        $("#booking-form").on('submit', function (e) {
            let contactNo = $("#contact-no").val();
            let noOfPerson = $("#no-of-person").val();
            let name = $("#name").val();

            if (!checkContact(contactNo) && contactNo != '') {
                e.preventDefault();
                console.log("Invalid contactno")
                let message = "<span class='text-white'>Please enter a valid contact no</span>";
                $("#contact-message").html(message);
            } else if (!checkName(name) && name != '') {
                e.preventDefault();
                console.log("Invalid customer name")
                let message = "<span class='text-white'>Please enter a valid name</span>";
                $("#name-message").html(message);
            } else if (!isNumber(noOfPerson)) {
                e.preventDefault();
                console.log("Invalid no of person")
                let message = "<span class='text-white'>Please enter a valid number</span>";
                $("#no-of-person-message").html(message);
            } else {
                $("#booking-form").submit();
                $("#contact-no").val('');
                $("#no-of-person").val('');
                $("#name").val('');
            }
        });

        $("#contact-no").on('input', function (e) {
            let contactNo = this.value;
            if (contactNo.length > 9) {
                checkUserExists();
            } else if (contactNo.length > 10) {
                // Truncate the input to 10 characters
                this.value = contactNo.slice(0, 9);
                checkUserExists(); // Optionally, trigger function for 10 characters
            } else {
                $("#name").val('');
            }
            $("#contact-message").html('');
        });

    });
</script>

<?php
closeDB();
?>