<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Prepare the SQL query to fetch all orders with a status of "payment approved"
  $sql = " 
  SELECT 
    o.Order_Id, 
    o.Amount, 
    o.Date_Payed, 
    o.Cust_Id, 
    o.service_Id, 
    o.Project_Id, 
    o.Status,
    o.delivery_fee,
    dl.Id, 
    dl.Receiver_name, 
    dl.phone_no, 
    dl.county, 
    dl.town, 
    dl.Nearest_landmark
  FROM 
    orders o
    INNER JOIN `delivery locations` dl ON o.Order_Id = dl.Order_id
  WHERE 
    o.Status = 'payment approved'
";
  $stmt = $conn->prepare($sql);

  $orders = [];
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $orderId = $row["Order_Id"];
      $order = [
        "orderId" => $orderId,
        "amount" => $row["Amount"],
        "datePayed" => $row["Date_Payed"],
        "status" => $row["Status"],
        "delivery_fee" => $row["delivery_fee"],
        "deliveryLocation" => [
          "id" => $row["Id"],
          "receiverName" => $row["Receiver_name"],
          "phoneNumber" => $row["phone_no"],
          "county" => $row["county"],
          "town" => $row["town"],
          "nearestLandmark" => $row["Nearest_landmark"],
        ],
        "products" => [],
      ];

      // Use a separate statement for the product query
      $productSql = " 
        SELECT 
          Product_Id, 
          Product_name, 
          Price, 
          Quantity
        FROM 
          products_ordered
        WHERE 
          Order_id = ?
      ";
      $stmt2 = $conn->prepare($productSql);
      $stmt2->bind_param("s", $orderId); // Bind the order ID to the query

      if ($stmt2->execute()) {
        $productResult = $stmt2->get_result();
        while ($productRow = $productResult->fetch_assoc()) {
          $order["products"][] = [
            "productId" => $productRow["Product_Id"],
            "productName" => $productRow["Product_name"],
            "price" => $productRow["Price"],
            "quantity" => $productRow["Quantity"],
          ];
        }
      } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to execute product query: " . $stmt2->error]);
        exit;
      }

      $orders[] = $order;
    }
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Failed to execute main query: " . $stmt->error]);
    exit;
  }
} else {
  http_response_code(405); // Method not allowed
  echo json_encode(["message" => "Invalid request method"]);
}

echo json_encode($orders);

// Close the database connection
mysqli_close($conn);
?>
