<?php
include "Connect.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
file_put_contents("php://stderr", print_r($_POST, true)); // Log the $_POST data




// Validate if required parameters are present
// 'user_id', 
$required_params = ['user_id','Order_Id', 'amount', 'name', 'phone', 'address', 'landmark', 'town', 'county', 'mpesa_no', 'mpesa_transaction_id', 'bank_id', 'cart_items']; // Added 'cart_items'

// Validate if required parameters are present
foreach ($required_params as $param) {
    if (!isset($_POST[$param])) {
        echo json_encode(["success" => "false", "message" => "$param is missing"]);
        return;
    }
}

// Extract values from the POST request
$cus_Id = $_POST['user_id'];
$order_id = $_POST['Order_Id'];
$amount = $_POST['amount'];
$receiver_name = $_POST['name'];
$phone_no = $_POST['phone'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];
$town = $_POST['town'];
$county = $_POST['county'];
$mpesa_no = $_POST['mpesa_no'];
$transaction_id = $_POST['mpesa_transaction_id'];
$bank_id = $_POST['bank_id'];

$cart_items = json_decode($_POST['cart_items'], true); // Decode the cart items JSON into an array

$date = date('Y-m-d');
$time = date('H:i:s');
$status = 'pending';

try {
    $conn->begin_transaction();

    // Insert delivery location
    $sql = "INSERT INTO `delivery locations`(`Cust_Id`, `Receiver_name`, `phone_no`, `county`, `town`, `Nearest_landmark`) 
            VALUES ('$cus_Id', '$receiver_name', '$phone_no', '$county', '$town', '$landmark')";
    if (!$conn->query($sql)) {
        $conn->rollback(); // Rollback the transaction on error
        die("Error inserting delivery location: " . $conn->error);
    }
    
    // Insert order into orders table
    $sql = "INSERT INTO `orders`(`Order_Id`, `Amount`, `Date_Payed`, `Cust_Id`, `Status`) 
            VALUES ('$order_id', '$amount', '$date', '$cus_Id', '$status')";
    if (!$conn->query($sql)) {
        $conn->rollback();
        die("Error inserting order: " . $conn->error);
    }
    
    // Insert into mpesa_payments table
    $sql = "INSERT INTO `mpesa_payments`(`Order_id`, `mpesa_number`, `mpesa_code`) 
            VALUES ('$order_id', '$mpesa_no', '$transaction_id')";
    if (!$conn->query($sql)) {
        $conn->rollback();
        die("Error inserting mpesa payment: " . $conn->error);
    }
    
    // Insert into bank_payments table if bank_id is provided
    if (!empty($bank_id)) {
        $sql = "INSERT INTO `bank_payments`(`Order_id`, `Acc_no`, `transaction_id`) 
                VALUES ('$order_id', '$mpesa_no', '$transaction_id')";
        if (!$conn->query($sql)) {
            $conn->rollback();
            die("Error inserting bank payment: " . $conn->error);
        }
    }
    
    // Insert each cart item into the products_ordered table
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];      // Assuming cart item contains 'product_id'
        $product_name = $item['product_name'];  // Assuming cart item contains 'product_name'
        $price = $item['product_price'];                // Assuming cart item contains 'price'
        $quantity = $item['quantity'];          // Assuming cart item contains 'quantity'
    
        $sql = "INSERT INTO `products_ordered`(`Order_Id`, `Product_Id`, `Product_name`, `Price`, `Quantity`) 
                VALUES ('$order_id', '$product_id', '$product_name', '$price', '$quantity')";
        if (!$conn->query($sql)) {
            $conn->rollback();
            die("Error inserting product ordered: " . $conn->error);
        }
    }
    
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();

    // Error response
    echo json_encode(["success" => "false", "message" => "Error: " . $e->getMessage()]);
}

// Close connection
$conn->close();



/*
INSERT INTO `delivery locations`(`Id`, `Cust_Id`, `Receiver_name`, `phone_no`,
 `county`, `town`, `Nearest_landmark`) VALUES()

INSERT INTO `products_ordered`(`Order_id`, `Product_Id`, `Price`, `Quantity`) VALUES

INSERT INTO `orders`(`Order_Id`, `Amount`, `Date_Payed`, `Cust_Id`, `service_Id`,
 `Project_Id`, `Status`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')

INSERT INTO `mpesa_payments`(`Order_id`, `mpesa_number`, `mpesa_code`) VALUES ('[value-1]','[value-2]','[value-3]')

INSERT INTO `bank_payments`(`Order_id`, `Acc_no`, `transaction_id`) VALUES ('[value-1]','[value-2]','[value-3]')

 */


    /*
        'user_id':widget.userId,
        'Order_Id': uniqueId.toString(),
        'amount': widget.totalPrice.toString(),

        'name':nameController.text,
        'phone':phoneController.text,
        'address':addressController.text,
        'landmark':landmarkController.text,
        'town':townController.text,
        'county':selectedCounty,

        'mpesa_no':numberController.text,
        'mpesa_transaction_id':Mpesa_Tranasaction_Controller.text,
        'bank_id':Bank_Id_Controller.text,    
    */


 /*   $required_params= ['user_id','Order_Id','amount','name','phone','address','landmark','town',
                        'county','mpesa_no','mpesa_transaction_id','bank_id',];
    foreach ($required_params as $param) {
            if (!isset($_POST[$param])) {
                echo json_encode(["success" => "false", "message" => "$param is missing"]);
                return;
            }
    }

    $cus_Id=$_POST['user_id'];
    $order_id=$_POST['Order_Id'];
    $amount=$_POST['amount'];

    $receiver_name=$_POST['name'];
    $phone_no=$_POST['phone'];
    $address=$_POST['address'];
    $landmark=$_POST['landmark'];
    $town=$_POST['town'];
    $county=$_POST['county'];

    $mpesa_no=$_POST['mpesa_no'];
    $transaction_id=$_POST['mpesa_transaction_id'];
    $bank_id=$_POST['bank_id'];

    $date=date('Y-m-d');
    $time=date('H:i:s');
    $status='pending';



echo($cus_Id);
$conn->close(); */