<?php
include_once "../common-functions.php";
connectDB();

if (!isset($_SESSION['customer_id'])) {
    header("location:table-booking.php");
}



?>
<!DOCTYPE html>
<?php
require ('top.php');
?>
<div class="container-fluid bg-dark hero-header py-5 mb-5">
    <div class="container text-center">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal" style="font-size:30px">Order History
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



<!-- About Start -->
<div class="container-fluid my-2">
    <div class="container">
        <div class="row align-items-center">
            <h2 class="ff-secondary mb-4">Recent History</h2>
            <?php
            $lastFetchedDate = '';
            $queryGetCustomerOrders = "SELECT order_id, order_datetime, order_status, payment_status FROM orders WHERE cust_id = $_SESSION[customer_id] ORDER BY order_datetime DESC";
            if ($resultGetCustomerOrders = mysqli_query($con, $queryGetCustomerOrders)) {
                if (!empty($resultGetCustomerOrders) && mysqli_num_rows($resultGetCustomerOrders) > 0) {
                    $itr = 0;
                    $totalOrders = mysqli_num_rows($resultGetCustomerOrders);
                    while ($rowGetCustomerOrders = mysqli_fetch_assoc($resultGetCustomerOrders)) {
                        $order_id = $rowGetCustomerOrders['order_id'];
                        $order_datetime = $rowGetCustomerOrders['order_datetime'];

                        if (isset($order_id) && isset($order_datetime)) {
                            $formattedDate = date('Y-m-d', strtotime($order_datetime));

                            // Check if the date is different from the last fetched date or if it's the first iteration
                            if ($formattedDate != $lastFetchedDate || $lastFetchedDate == '') {
                                // If the date is different or it's the first iteration, create a new accordion
            
                                if ($itr > 0) {
                                    echo "</div>";  // accordion-end
                                }

                                echo "<h5 class='m-0 text-dark'>Date: $formattedDate</h5>";
                                echo "<div class='mt-1 mb-4 rounded accordion accordion-flush' id='accordionFlush$itr'>";  // accordion-start
                                $lastFetchedDate = $formattedDate; // Update the last fetched date
            
                            }

                            echo "<div class='accordion-item rounded'>";
                            echo "<h2 class='accordion-header' id='flush-heading$itr'>
                                       <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse'
                                         data-bs-target='#flush-collapse$itr' aria-expanded='false' aria-controls='flush-collapse$itr'>
                                           Order No. : " . date('Ymd', strtotime($order_datetime)) . "$order_id
                                       </button>
                                  </h2>";

                            echo "<div id='flush-collapse$itr' class='accordion-collapse collapse' aria-labelledby='flush-heading$itr'
                                      data-bs-parent='#accordionFlush$itr'>
                                        <div class='item-div pt-2'>
                                            <table class='table'>
                                                <tr class='bg-primary text-white'>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price/Unit</th>
                                                </tr>";

                            $queryGetItem = "SELECT  item_name,	quantity, price_per_unit FROM order_items oi 
                                     LEFT JOIN menu_item mi ON mi.item_id = oi.item_id WHERE order_id = $order_id";
                            $totalAmount = 0;
                            if ($resultGetItem = mysqli_query($con, $queryGetItem)) {
                                if (!empty($resultGetItem) && $resultGetItem->num_rows > 0) {
                                    while ($rowGetItem = mysqli_fetch_assoc($resultGetItem)) {
                                        echo "<tr class='text-dark'>
                                                 <td>";
                                        echo ($rowGetItem['item_name'] != '') ? $rowGetItem['item_name'] : "Removed item";
                                        echo "</td>
                                                 <td>{$rowGetItem['quantity']}</td>
                                                 <td>₹{$rowGetItem['price_per_unit']}</td>
                                             </tr>";
                                        $totalAmount += $rowGetItem['price_per_unit'] * $rowGetItem['quantity'];
                                    }
                                }
                            }

                            echo "<tr class='text-dark table-active'></tr>
                                    <th colspan='2'>Total Amount</th>
                                    <th>₹$totalAmount.00</th>
                                  </tr>
                                  <tr class='text-dark table-active'></tr>
                                    <th colspan='2'>Order status</th>
                                    <th>";
                            echo ($rowGetCustomerOrders['order_status'] == 0 ? 'In queue' : ($rowGetCustomerOrders['order_status'] == 1 ? 'Preparing' :
                                ($rowGetCustomerOrders['order_status'] == 2 ? 'Completed' : '')));
                            echo "</th>
                                              </tr>
                                              <tr class='text-dark table-active'></tr>
                                    <th colspan='2'>Payment status</th>
                                    <th>";
                            echo ($rowGetCustomerOrders['payment_status'] == 0 ? 'Pending' : ($rowGetCustomerOrders['payment_status'] == 1 ? 'Paid' : ''));
                            echo "</th>
                                              </tr>
                                  
                                                </table>
                                            </div>
                                        </div>
                                </div>";

                            if ($itr == $totalOrders - 1) {
                                echo "</div>";  // accordion-end
                            }
                        }
                        $itr++;
                    }
                }
            }
            ?>


        </div>
    </div>
</div>

<?php require ('footer.php'); ?>
</body>

</html>