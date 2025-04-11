<?php
include_once "../common-functions.php";
connectDB();
include_once "../functions-manager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $firstname = $con->real_escape_string($_POST['firstname']);
    $lastname = $con->real_escape_string($_POST['lastname']);
    $email = $con->real_escape_string($_POST['email']);
    $contactno = $con->real_escape_string($_POST['contactno']);
    $gender = $con->real_escape_string($_POST['gender']);
    //$userid = $con->real_escape_string($_POST['userid']);
    $password = $con->real_escape_string($_POST['password']);
    $address = $con->real_escape_string($_POST['address']);
    $cpassword = $con->real_escape_string($_POST['confpassword']);
    ;

    $sqlCheckEmail = "SELECT * FROM manager WHERE mgr_emailid = '$email'";
    if ($resultCheckEmail = mysqli_query($con, $sqlCheckEmail)) {
        if (mysqli_num_rows($resultCheckEmail) > 0) {
            echo '<script type="text/javascript">';
            echo 'alert("Email already exists")';
            echo '</script>';
        } else {
            // Insert into database
            if ($password == $cpassword) {
                //$hash = password_hash($password, PASSWORD_DEFAULT);
                $encpass = md5($password);
                $sql = "INSERT INTO manager (mgr_firstname, mgr_lastname, mgr_emailid, mgr_phone_number, mgr_gender, mgr_password, mgr_address) 
            VALUES ('$firstname', '$lastname', '$email', '$contactno', '$gender', '$encpass', '$address')";

                if ($con->query($sql) === TRUE) {
                    header("Location: ../login/login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("In proper details for password")';
                echo '</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login - RMS</title>

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
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <style>
        .form-main {
            align-self: right;
            padding-top: 20px;
            padding-left: 350px;
            padding-right: 350px;
            padding-bottom: auto;
        }

        .invalid {
            color: #E43915 !important;
            font-size: 14px;
        }

        .message {
            color: #8ed06c !important;
            font-size: 14px;
        }
    </style>
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
    <!--Validation Start-->
    <script>
        // First Name validation
        function validateFirstName() {
            var firstName = document.forms["myForm"]["firstname"].value.trim();
            var firstNameError = document.getElementById("firstNameError");
            firstNameError.innerHTML = "";

            if (firstName === "") {
                firstNameError.innerHTML = "First Name must not be empty";
            } else if (!/^[a-zA-Z'-]+$/.test(firstName)) {
                firstNameError.innerHTML = "First Name can only contain letters, hyphens, and apostrophes";
            } else if (firstName.length < 2) {
                firstNameError.innerHTML = "First Name must be at least 2 characters long";
            }
        }

        // Last Name validation
        function validateLastName() {
            var lastName = document.forms["myForm"]["lastname"].value.trim();
            var lastNameError = document.getElementById("lastNameError");
            lastNameError.innerHTML = "";

            if (lastName === "") {
                lastNameError.innerHTML = "Last Name must not be empty";
            } else if (!/^[a-zA-Z'-]+$/.test(lastName)) {
                lastNameError.innerHTML = "Last Name can only contain letters, hyphens, and apostrophes";
            } else if (lastName.length < 2) {
                lastNameError.innerHTML = "First Name must be at least 2 characters long";
            }
        }

        // Email validation
        function validateEmail(input) {
            var email = input.value.trim();
            var emailError = document.getElementById("emailError");
            emailError.innerHTML = "";

            // Regular expression for email validation
            var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

            if (!emailRegex.test(email)) {
                emailError.innerHTML = "Invalid Email Address";
                //input.classList.add("is-invalid"); // Optionally mark the input as invalid
            } else {
                //input.classList.remove("is-invalid"); // Remove any previous validation error styles
            }
        }

        // Contact Number validation
        function validateContactNumber(event) {
            // Get the input value after the keypress
            var contactNumber = event.target.value.trim();
            var contactError = document.getElementById("contactError");
            contactError.innerHTML = "";
            // Check if the key pressed is a number or not
            var charCode = event.which ? event.which : event.keyCode;
            if (charCode < 48 || charCode > 57) {
                event.preventDefault(); // Prevent non-numeric characters from being entered
                return;
            }
            // Additional validation for length
            if (contactNumber.length >= 10) {
                event.preventDefault(); // Prevent further characters from being entered
            }
            if (contactNumber == "") {
                alert("Contact Number must be filled out with numeric characters only");
                return false;
            }

        }

        function validatePassword() {
            var password = document.getElementById("password").value;
            var passwordMessage = document.getElementById("passwordMessage");

            if (password == "") {
                passwordMessage.innerHTML = "Password must not be empty";
            } else if (password.length < 8) {
                passwordMessage.innerHTML = "Password must be at least 8 characters long";
            } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)) {
                passwordMessage.innerHTML = "Password must not be empty";
            }

        }

        function validateConfirmPassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confpassword").value;
            var confPasswordMessage = document.getElementById("confPasswordMessage");

            if (confirmPassword !== password) {
                confPasswordMessage.innerHTML = "Passwords do not match";
            } else {
                confPasswordMessage.innerHTML = "";
            }
        }


        function validateAddress(input) {
            var address = input.value.trim();
            var addressError = document.getElementById("addressError");
            addressError.innerHTML = "";

            if (address === "") {
                addressError.innerHTML = "Address must not be empty";
            }
        }
    </script>

    <!--Validation ends-->
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.php">
                    <img src="vendors/images/deskapp-logo.svg" alt />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="../login/login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="form-main">
        <div class="pd-20 card-box mb-30">
            <div class="login-title">
                <h2 class="text-center text-primary">Register Form</h2>
            </div><br>
            <form action="#" method="post" name="myForm" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname" onkeyup="validateFirstName()"
                                required>
                            <div id="firstNameError" class="error-message" style="color: #E43915; font-size: 14px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname" onkeyup="validateLastName()"
                                required>
                            <div id="lastNameError" class="error-message" style="color: #E43915; font-size: 14px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" onblur="validateEmail(this)" required>
                            <div id="emailError" class="error-message" style="color: #E43915; font-size: 14px;"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="contactno"
                                onkeypress="validateContactNumber(event)" required>
                            <div id="contactError" class="error-message" style="color: #E43915; font-size: 14px;"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-inline" type="radio" name="gender" value="Male"
                                    id="gendermale" checked>
                                <label class="form-check-label" for="gendermale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Female"
                                    id="genderfemale">
                                <label class="form-check-label" for="genderfemale">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" onkeypress="validateAddress(this)"
                                required>
                            <div id="addressError" class="error-message" style="color: #E43915; font-size: 14px;"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Password<span style="color:red;"></span></label>
                            <input type="password" class="form-control" name="password" maxlength="16"
                                id="passwordInput">
                            <div class="message" id="lengthMsg"></div>
                            <div class="message" id="alphaMsg"></div>
                            <div class="message" id="specialMsg"></div>
                            <div class="message" id="numberMsg"></div>
                            <!-- <div id="passwordMessage" style="color: red; font-size: 14px;"></div> -->
                        </div>
                    </div>
                    <script>
                        const passwordInput = document.getElementById('passwordInput');
                        const lengthMsg = document.getElementById('lengthMsg');
                        const alphaMsg = document.getElementById('alphaMsg');
                        const specialMsg = document.getElementById('specialMsg');
                        const numberMsg = document.getElementById('numberMsg');

                        passwordInput.addEventListener('keyup', function () {
                            const password = passwordInput.value;
                            let valid = true;

                            lengthMsg.textContent = (password.length >= 6 && password.length <= 16) ? 'Password length is valid.' : 'Password length should be between 6 and 16 characters.';
                            lengthMsg.className = (password.length >= 6 && password.length <= 16) ? 'valid' : 'invalid';
                            valid = valid && (password.length >= 6 && password.length <= 16);

                            alphaMsg.textContent = /[A-Za-z]/.test(password) ? 'Contains alphabets.' : 'Should contain alphabets.';
                            alphaMsg.className = /[A-Za-z]/.test(password) ? 'valid' : 'invalid';
                            valid = valid && /[A-Za-z]/.test(password);

                            specialMsg.textContent = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password) ? 'Contains special symbols.' : 'Should contain special symbols.';
                            specialMsg.className = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password) ? 'valid' : 'invalid';
                            valid = valid && /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);

                            numberMsg.textContent = /\d/.test(password) ? 'Contains numbers.' : 'Should contain numbers.';
                            numberMsg.className = /\d/.test(password) ? 'valid' : 'invalid';
                            valid = valid && /\d/.test(password);

                            if (valid) {
                                passwordInput.style.borderColor = 'green';
                            } else {
                                passwordInput.style.borderColor = 'red';
                            }
                        });
                    </script>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Confirm password<span style="color:red;"></span></label>
                            <input type="password" class="form-control" name="confpassword" id="confpassword"
                                onkeyup="validateConfirmPassword()" required>
                            <!-- <div id="confPasswordMessage" style="color: red; font-size: 14px;"></div> -->
                        </div>
                    </div>
                </div>
                <div class="input-group mb-0">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit"
                        onclick="return validateForm()">
                </div>
            </form>


        </div>
    </div>
    <!-- success Popup html Start -->
    <!-- success Popup html End -->
    <!-- welcome modal start -->
    <!-- welcome modal end -->
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="vendors/scripts/steps-setting.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
<?php
closeDB();
?>