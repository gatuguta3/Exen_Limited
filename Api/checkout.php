<?php
include "Connect.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Get the JSON payload from the request body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate if required parameters are present
$required_params = ['user_id', 'Order_Id', 'amount', 'name', 'phone', 'address', 'landmark', 'town','delivery_fee','county', 'mpesa_no', 'mpesa_transaction_id', 'bank_id', 'cart_items'];

foreach ($required_params as $param) {
    if (!isset($data[$param])) {
        echo json_encode(["success" => "false", "message" => "$param is missing"]);
        return;
    }
}

// Extract values from the JSON payload
$cus_Id = $data['user_id'];
$order_id = $data['Order_Id'];
$amount = $data['amount'];
$receiver_name = $data['name'];
$phone_no = $data['phone'];
$address = $data['address'];
$landmark = $data['landmark'];
$town = $data['town'];
$delivery_fee=$data['delivery_fee'];
$county = $data['county'];
$mpesa_no = $data['mpesa_no'];
$transaction_id = $data['mpesa_transaction_id'];
$bank_id = $data['bank_id'];
$cart_items = $data['cart_items'];

$date = date('Y-m-d');
$time = date('H:i:s');
$status = 'pending';
$location_id = rand(1000, 9999);
$payId =rand(1000, 9999);

try {
    $conn->begin_transaction();

    // Insert delivery location
    $sql = "INSERT INTO `delivery locations`(`Id`,`Order_id`,`Cust_Id`, `Receiver_name`, `phone_no`, `county`, `town`, `Nearest_landmark`) 
            VALUES ('$location_id','$order_id','$cus_Id', '$receiver_name', '$phone_no', '$county', '$town', '$landmark')";
    if (!$conn->query($sql)) {
        $conn->rollback();
        echo json_encode(["success" => "false", "message" => "Error inserting delivery location: " . $conn->error]);
        return;
    }

    // Insert order into orders table
    $sql = "INSERT INTO `orders`(`Order_Id`, `Amount`, `Date_Payed`, `Cust_Id`,`delivery_fee`, `Status`) 
            VALUES ('$order_id', '$amount', '$date', '$cus_Id','$delivery_fee', '$status')";
    if (!$conn->query($sql)) {
        $conn->rollback();
        echo json_encode(["success" => "false", "message" => "Error inserting order: " . $conn->error]);
        return;
    }

   // Insert into payments table
   $method = !empty($bank_id) ? 'bank' : 'mpesa'; // Determine payment method
   $acc_no = !empty($bank_id) ? mysqli_real_escape_string($conn, $bank_id) : null; // Bank account number
   $sql = "INSERT INTO `payments`(`pay_id`,`Order_id`, `Method`, `Acc_no`, `mpesa_number`, `mpesa_code`,`Date_Paid`) 
           VALUES ('$payId','$order_id','$method', '$acc_no', '$mpesa_no', '$transaction_id', '$date')";
   
   if (!$conn->query($sql)) {
       $conn->rollback();
       echo json_encode(["success" => "false", "message" => "Error inserting payment: " . $conn->error]);
       return;
   }

    if (isset($data['cart_items'])) {
        $cart_items = json_decode($data['cart_items'], true);
        echo "Decoded cart items: ";
        var_dump($cart_items);
    } else {
        $cart_items = [];
        echo "cart_items not found.";
    }
    
    // Use a foreach loop if cart_items is an array
    if (is_array($cart_items)) {
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $product_name = $item['product_name'];
            $price = $item['product_price'];
            $quantity = (int)$item['quantity'];

            $newquantity1 = ($quantity == 0) ? 1 : $quantity;
    
            // Step 1: Fetch the current quantity of the product
            $query = "SELECT `Quantity` FROM `products` WHERE `Product_Id`='$product_id'";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                $currentQuantity = $row['Quantity'];
    
                // Step 2: Check if there is enough quantity to fulfill the order
                if ($currentQuantity >= $newquantity1) {
                    // Step 3: Deduct the ordered quantity from the current stock
                    $newQuantity = $currentQuantity - $newquantity1;
                    $updateQuery = "UPDATE `products` SET `Quantity`='$newQuantity' WHERE `Product_Id`='$product_id'";
                    
                    if (!$conn->query($updateQuery)) {
                        $conn->rollback();
                        echo json_encode(["success" => "false", "message" => "Error updating product quantity: " . $conn->error]);
                        return;
                    }
    
                    // Step 4: Insert the order details into the products_ordered table
                    $sql = "INSERT INTO `products_ordered`(`Order_id`, `Product_Id`, `Product_name`, `Price`, `Quantity`) 
                            VALUES ('$order_id', '$product_id', '$product_name', '$price', '$newquantity1')";
                    
                    if (!$conn->query($sql)) {
                        $conn->rollback();
                        echo json_encode(["success" => "false", "message" => "Error inserting product ordered: " . $conn->error]);
                        return;
                    }
                } else {
                    echo json_encode(["success" => "false", "message" => "Not enough quantity available for product ID: $product_id"]);
                    return;
                }
            } else {
                $conn->rollback();
                echo json_encode(["success" => "false", "message" => "Error fetching product quantity: " . $conn->error]);
                return;
            }
        }
    } else {
        echo "Error: cart_items is not an array.";
    }

    // Insert each cart item into the products_ordered table
    foreach ($cart_items as $item) {
       
    }

    // Commit transaction
    $conn->commit();

    // Success response
    echo json_encode(["success" => "true", "message" => "Order placed successfully"]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => "false", "message" => "Error: " . $e->getMessage()]);
}

$conn->close();
?>
