<!DOCTYPE html>
<html>
<?php
require ('top.php');
include_once ('../common-functions.php');
connectDB();

$sql = "SELECT * FROM `menu_item`";
$result = mysqli_query($con, $sql);

?>
<style>
    html,
    body {
        height: 100%;
        width: 100%;
    }

    .horizontal-scroll {
        width: auto;
        height: 80px;
        background-color: #FFFFFF;

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        transition: 2s;
    }

    .horizontal-scroll .btn-scroll {
        background-color: #FFFFFF;
        color: #999;
        box-shadow: 0 0 10px #999;
        padding: 5px 8px;
        border: 0;
        border-radius: 50%;
        margin: 0 5px;
        z-index: 1;
        cursor: pointer;
    }

    .story-container {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        position: absolute;
        left: 0;
        transform: 0.5s all ease-out;
    }

    .story-circle {
        width: 52px;
        height: 52px;
        margin: 15px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .story-circle img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .story-button {
        background-color: #FEA116;
        width: 100px;
        height: 40px;
        color: #fff;
        border: #fff;

    }

    .align-items-left {
        flex: 1;
    }

    .align-items-right {
        /* You can add any additional styling as needed */
    }

    .circular--portrait {
        position: relative;
        width: 50px;
        height: 50px;
        overflow: hidden;
        border-radius: 50%;
    }

    .circular--portrait img {
        width: 100%;
        height: auto;
    }

    .scrollable-div {
        height: 400px;
        overflow-y: auto;
    }

    .show-order-button {
        position: fixed;
        font-size: 30px;
        right: 6%;
        bottom: 5%;
        z-index: 99;
    }

    /* Hide scrollbar for Chrome, Safari and Opera */
    #order-details ::-webkit-scrollbar {
        display: none;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    #order-details {
        position: fixed;
        z-index: 1000;
        height: 100%;
        width: 100%;
        background-color: rgb(245, 245, 245);
        top: 100%;
    }

    #place-order-div {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        background-color: white;
    }

    #place-order-div-inner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .quantity-modifier {
        height: auto;
        width: 100px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .quantity-inner-divs {
        flex: 1;
        text-align: center;
        padding: 10px;
        background-color: rgb(254, 175, 57);
        color: white;
    }

    .quantity-inner-divs:first-child {
        border-right: 1px solid whitesmoke;
        border-radius: 5px 0 0 5px;
    }

    .quantity-inner-divs:last-child {
        border-left: 1px solid whitesmoke;
        border-radius: 0 5px 5px 0;
    }

    .item-discard-button {
        padding-left: 3px;
        padding-right: 3px;
        height: auto;
        width: 9%;
        position: relative;
        left: 22px;
        top: -10px;
        background-color: #de3e44;
        color: #FFF;
        border-bottom-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .item-div {
        cursor: pointer;
    }
</style>

<body>

    <div class="container-fluid py-5 bg-dark hero-header mb-5">
        <div class="container text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal" style="font-size:30px">Food Menu
            </h5>
            <h3 class="h3 text-white my-3 animated slideInDown">
                <?php
                if (isset($_SESSION['full_name'])) {
                    echo $_SESSION['full_name'];
                }
                ?>
            </h3>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Menu Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="text-center wow fadeInUp mb-3" data-wow-delay="0.1s">

            </div>

            <div class="container-fluid">
                <div class="row">
                    <?php
                    $queryGetCategories = "SELECT * FROM item_category ORDER BY category_name ASC";
                    if ($resultCategory = mysqli_query($con, $queryGetCategories)) {
                        if (!empty($resultCategory) && $resultCategory->num_rows > 0) {
                            while ($categoryData = mysqli_fetch_assoc($resultCategory)) {
                                // Query to check if there are any items associated with the category
                                $queryCountItems = "SELECT COUNT(*) AS total_items FROM menu_item WHERE category_id = {$categoryData['category_id']}";
                                if ($resultCountItems = mysqli_query($con, $queryCountItems)) {
                                    $countItemsData = mysqli_fetch_assoc($resultCountItems);
                                    $totalItems = $countItemsData['total_items'];
                                    // Only print the category section if there are items associated with it
                                    if ($totalItems > 0) {
                                        echo "<div class='col-md-6 col-sm-12 mb-3 py-4 rounded'>"; //1
                                        echo '<div class="w-100 d-flex align-items-center">';//2
                                        echo '<div class="circular--portrait">';
                                        echo "<img src='{$categoryData['category_image']}' alt='{$categoryData['category_name']}' />";
                                        echo "</div>";
                                        // echo "<span class='ms-3 text-dark h1' style='font-size:40px'></span>";
                                        echo "<h5 class='ms-3 ff-secondary text-center 
                                        text-dark fw-normal' style='font-size:30px'>{$categoryData['category_name']}</h5>";
                                        echo "</div>";//2
                                        $queryGetItems = "SELECT item_id, category_id, item_name, item_image, 
                                       item_description, price, status FROM menu_item WHERE category_id = {$categoryData['category_id']}";
                                        if ($resultItems = mysqli_query($con, $queryGetItems)) {
                                            if (!empty($resultItems) && $resultItems->num_rows > 0) {
                                                while ($itemData = mysqli_fetch_assoc($resultItems)) {
                                                    ?>
                                                    <div class="my-2 card border-warning rounded rounded-3 item-container">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-3 col-sm-3" style="position:relative;">
                                                                <!-- <div style="height:100%;width:100%;"> -->
                                                                <img class="item-image"
                                                                    style="height:185px;width:100%;object-fit:cover;overflow:hidden;"
                                                                    src="<?= $itemData['item_image'] ?>" alt="" />
                                                                <!-- </div> -->
                                                            </div>

                                                            <div class="col-md-9 col-sm-9">
                                                                <div class="card-body p-3">
                                                                    <h5 class="card-title">
                                                                        <a class="text-dark item-name">
                                                                            <?= $itemData['item_name'] ?>
                                                                        </a>
                                                                    </h5>
                                                                    <p class="text-muted d-block text-truncate item-description">
                                                                        <?= $itemData['item_description'] ?>
                                                                    </p>
                                                                    <p class="text-end text-primary h4 ff-secondary d-block text-truncate item-price">
                                                                        Price: ₹
                                                                        <?= $itemData['price'] ?>
                                                                    </p>
                                                                    <div class="d-flex align-item-center justify-content-end">
                                                                        <button type="button" class="btn btn-primary mb-1 mx-1 read-more-button">Read
                                                                            more</button>
                                                                        <?php
                                                                        if ($itemData['status'] == 1) { // 1 means disabled
                                                                            echo "<button class='btn btn-light text-dark mb-1 mx-1'>Unavailable</button>";
                                                                        } else {
                                                                            if (isset($_SESSION['customer_id']) && isset($_SESSION['seated']) && $_SESSION['seated'] == true) {
                                                                                echo "<button type='button' class='btn btn-primary mb-1 mx-1' 
                                                                                data-item-name='" . $itemData['item_name'] . "' 
                                                                                data-item-id='" . $itemData['item_id'] . "' 
                                                                                data-item-price='" . $itemData['price'] . "' 
                                                                                data-item-status='" . $itemData['status'] . "' 
                                                                                onclick='addToOrder(this)'>Add to order</button>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                // No items found
                                                // echo "No items found";
                                            }
                                        } else {
                                            // Query failed to run
                                            echo "Query failed to run";
                                        }
                                        echo "</div>"; //1
                                    }
                                }
                            }
                        }
                    }


                    ?>


                </div>
            </div>

        </div>
    </div>
    <!-- Menu End -->

    <!-- Order List start -->
    <div id="order-details" class="container-fluid">
        <div class="row mt-2">
            <div class="col-11">
                <h2 class="h2 ff-secondary">Order Summary</h2>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <i id='close-order-details' class="icon-copy bi bi-arrow-left-circle" style='font-size:30px;'></i>
            </div>
        </div>
        <hr class='mb-0 mx-0 mt-1'>
        <div class="row mt-2" style="height:100%;">
            <div class="col-12" style="height:70%;">
                <div id='items-list' style="overflow-x: hidden; overflow-y:auto;height:100%;">
                    <?php
                    //   Item will appear in this div
                    ?>
                </div>
            </div>
            <div class="col-12 pt-2" id="place-order-div" style="height:20%">
                <div id="place-order-div-inner">
                    <div class="container-fluid d-flex justify-content-between align-item-center">
                        <p class="h1 ff-secondary">Total Amount:</p>
                        <p class="h1 ff-secondary" id="total-amount">₹0</p>
                    </div>
                    <div class="container-fluid">
                        <button id="place-order-button" class="btn btn-primary w-100 mb-5">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order List end -->

    <!-- Success modal for order placed -->
    <div class="modal" id="order-placed-success-modal" tabindex="10">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ff-secondary">Order placed!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your order has been placed. Please wait while we prepare it for you.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Read more about item modal -->
    <div class="modal" data-bs-dismiss="modal" aria-label="Close" id="read-more-modal" tabindex="10">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                </div> -->
                <div class="modal-body">
                    <h5 class="modal-title h1 mb-3"></h5>

                    <div class="" style="width:100%; height:50%">
                        <img src="" class="modal-item-image" style="object-fit:contain;width:100%"
                            alt="No image available" />
                    </div>
                    <p class="modal-item-price text-primary h1 mt-2 ff-secondary"></p>
                    <p class="text-dark h5 mt-2">Description:</p>
                    <p class="modal-item-desc text-dark"></p>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <?php
    require ('footer.php');
    if (isset($_SESSION['customer_id']) && isset($_SESSION['seated']) && $_SESSION['seated'] == true) {
        echo "<button class='btn btn-primary show-order-button'><i class='icon-copy bi bi-cart-check-fill'></i></button>";
    }
    ?>


    <script>
        $(document).ready(function () {

            document.addEventListener('selectstart', function (e) {
                e.preventDefault(); // Prevent text selection
            });

            // change color of back button on click of close drawer
            $("#close-order-details").click(function () {
                // Toggle background color of the button
                $(this).removeClass('text-dark');
                $(this).addClass('text-primary');
                setTimeout(() => {
                    $(this).removeClass('text-primary');
                    $(this).addClass('text-dark');
                }, 500);
            });

            $(document).on('click', '.addOne', function () {
                var $quantity = $(this).prev('.item-quantity');
                var $price = $(this).closest('.mx-4').find('.price');
                var $subTotal = $(this).closest('.mx-4').find('.sub-total');

                var quantity = parseInt($quantity.text()) + 1;
                $quantity.text(quantity);

                var price = parseInt($price.text());
                var subtotal = quantity * price;
                $subTotal.text(subtotal);

                calculateTotal();
            });

            $(document).on('click', '.subOne', function () {
                var $quantity = $(this).next('.item-quantity');
                var $price = $(this).closest('.mx-4').find('.price');
                var $subTotal = $(this).closest('.mx-4').find('.sub-total');

                var quantity = parseInt($quantity.text());
                if (quantity > 1) {
                    quantity -= 1;
                    $quantity.text(quantity);

                    var price = parseInt($price.text());
                    var subtotal = quantity * price;
                    $subTotal.text(subtotal);
                }
                calculateTotal();
            });

            // changes color for animation
            $(document).on("click", ".subOne, .addOne", function () {
                var originalColor = $(this).css("background-color");

                var $element = $(this);
                $element.css("background-color", "white");
                $element.css("color", "black");
                setTimeout(function () {
                    $element.css("background-color", "rgb(254, 175, 57)");
                    $element.css("color", "white");
                }, 50);
            });

            $(document).on("click", ".read-more-button", function () {
                let itemContainer = $(this).closest('.item-container');
                let itemName = itemContainer.find('.item-name').text();
                let itemDesc = itemContainer.find('.item-description').text();
                let itemPrice = itemContainer.find('.item-price').text();
                let itemImage = itemContainer.find('.item-image').attr("src");

                // console.log(itemName, itemDesc, itemPrice, itemImage);

                // Calculate 40% of the screen height in pixels
                var fortyPercentHeight = $(window).height() * 0.4;

                // Set the height of the modal-item-image element
                $("#read-more-modal .modal-item-image").css("height", fortyPercentHeight + "px");

                $("#read-more-modal .modal-title").text(itemName);
                $("#read-more-modal .modal-item-image").attr("src", itemImage);
                $("#read-more-modal .modal-item-price").text(itemPrice);
                $("#read-more-modal .modal-item-desc").text(itemDesc);

                $("#read-more-modal").modal("show");
            });


            // Show order summary drawer
            $(".show-order-button").click(function () {
                $("#order-details").animate({
                    top: '0%' // Target value of 'top'
                }, {
                    duration: 1000, // Duration in milliseconds
                    easing: 'easeInBounce' // Bounce effect
                });
            });

            // Close order summary drawer
            $("#close-order-details").click(function () {
                $("#order-details").animate({
                    top: '100%' // Target value of 'top'
                }, {
                    duration: 1000, // Duration in milliseconds
                    easing: 'easeOutBounce' // Bounce effect
                });
            });

            // Function to place order
            $("#place-order-button").click(function () {
                itemIds = [];
                itemQuantities = [];
                // Storing data of each item to array
                $(".item-div").each(function () {
                    var itemId = $(this).attr("data-item-id");
                    var itemQuantity = $(this).find('.item-quantity').text();
                    // console.log(itemId);
                    // console.log(itemQuantity);

                    itemIds.push(itemId);
                    itemQuantities.push(itemQuantity);

                });
                if (itemIds.length > 0) {
                    $.ajax({
                        type: "post",
                        url: "place-order.php",
                        data: {
                            itemIds: itemIds,
                            itemQuantities: itemQuantities
                        },
                        success: function (response) {
                            orderResponse = JSON.parse(response);
                            if (orderResponse.status == true) {
                                // console.log(orderResponse.message);
                                $("#order-placed-success-modal").modal("show");
                                setTimeout(function () {
                                    $("#order-placed-success-modal").modal("hide");
                                }, 2000);

                                $("#order-details").animate({
                                    top: '100%'
                                }, {
                                    duration: 1500,
                                    easing: 'easeOutBounce'
                                });

                                $("#items-list").empty();
                                $("#total-amount").text("₹0");
                                updateButtonStatus();
                                showNoItemsMessage();
                            } else {
                                console.log(orderResponse.message);
                                console.log("Order failed");
                            }
                        }
                    });
                }
                // console.log(itemIds)
                // console.log(itemQuantities)
            });
        });

        // Add item to order list
        function addToOrder(button) {
            // Get data attributes from the button
            var itemName = button.getAttribute('data-item-name');
            var itemId = button.getAttribute('data-item-id');
            var itemPrice = button.getAttribute('data-item-price');
            var itemStatus = button.getAttribute('data-item-status');

            var existingItem = document.querySelector('.item-div[data-item-id="' + itemId + '"]');
            if (existingItem) {
                // If item already exists, don't add again
                // console.log("Item with ID " + itemId + " already exists.");
                return;
            }
            if (itemStatus == 1) {
                // If item is unvailable, don't add
                return;
            }

            // Count the number of existing items
            var itemCount = document.querySelectorAll('.item-div').length + 1;

            // Create the div element with the provided data attributes
            var newDiv = document.createElement('div');
            newDiv.classList.add('container-fluid', 'bg-white', 'px-0', 'py-2', 'my-2', 'item-div');
            newDiv.setAttribute('style', 'border-radius:15px;');
            newDiv.setAttribute('data-item-name', itemName);
            newDiv.setAttribute('data-item-id', itemId);
            // newDiv.setAttribute('data-item-price', itemPrice);

            // Add content to the newly created div
            newDiv.innerHTML = `
                <div class="container-fluid py-1 d-flex align-item-center justify-content-between">
                    <div>
                        <span class="h5 me-2 item-count-display"></span>
                        <span class="h5 me-2">${itemName}</span>
                    </div>
                    <div class="item-discard-button">
                        <i class="icon-copy bi bi-x-circle"></i>
                    </div>
                </div>
                <div class="mx-4 container-fluid d-flex justify-content-between align-item-center">
                    <div class="quantity-modifier mx-2">
                        <div class="quantity-inner-divs subOne border-right">-</div>
                        <div class="quantity-inner-divs item-quantity">1</div>
                        <div class="quantity-inner-divs addOne border-left">+</div>
                    </div>
                    <div class="mx-2">
                        <span class="h6 text-right">Price:<span class="ms-2 h5">₹<span class='price'>${itemPrice}</span></span></span><br>
                        <span class="h6 text-right">Sub-total:<span class="ms-2 h5">₹<span class='sub-total'>${itemPrice}</span></span></span>
                    </div>
                </div>
            `;

            // Append the new div to the items list
            if (itemCount == 1) {
                $('#items-list').html(newDiv);
            } else {
                document.getElementById('items-list').appendChild(newDiv);
            }
            calculateTotal();
            updateButtonStatus();
            fillItemCounts();
        }

        // Discard item from order list
        $('#items-list').on('click', '.item-discard-button', function () {
            var parentItemDiv = $(this).closest('.item-div');
            if (parentItemDiv.length > 0) {
                parentItemDiv.remove();
                calculateTotal();
                updateButtonStatus();
            }
            showNoItemsMessage();
            fillItemCounts();
        });

        function showNoItemsMessage() {
            if (document.querySelectorAll('.item-div').length == 0) {
                $("#items-list").html("<center><p class='ff-secondary my-5'>Start adding items to your order!</p></center>");
            }
        }

        showNoItemsMessage();

        function calculateTotal() {
            var subtotals = document.querySelectorAll('.sub-total');
            var total = 0;

            // Loop through each subtotal and sum them up
            subtotals.forEach(function (subtotalElement) {
                total += parseInt(subtotalElement.textContent);
            });

            // Update the total amount
            document.getElementById('total-amount').textContent = '₹' + total;
        }

        // Reassign number of items
        function fillItemCounts() {
            $('.item-count-display').each(function (index, element) {
                // console.log(element);
                $(element).text((index + 1) + '.');
            });
        }

        // For UI changes
        function updateButtonStatus() {
            // Get all the buttons in the menu
            var buttons = document.querySelectorAll('.btn[data-item-id]');

            buttons.forEach(function (button) {
                // Get the data attributes from the button
                var itemId = button.getAttribute('data-item-id');

                // Check if an item-div with the same data-item-id exists
                var itemDiv = document.querySelector('.item-div[data-item-id="' + itemId + '"]');

                if (itemDiv) {
                    // Update button text and background color
                    button.textContent = 'ADDED';
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-success');
                } else {
                    button.textContent = 'ADD TO ORDER';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                }
            });
        }

    </script>
</body>

</html>