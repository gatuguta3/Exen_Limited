<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
require_once 'connect.php';

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        >
   </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
   />
   <script>
        $(document).ready(function() {
            $("#Search_btn").click(function() {
                var query = $("#Search_txt").val();
                $.ajax({
                    url: "Transactions_search.php",
                    type: "POST",
                    data: { query: query },
                    success: function(response) {
                        $("#transactions_table tbody").html(response);
                    }
                });
            });
        });

</script>
<!-- Bootstrap JavaScript Libraries -->
<script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
</head>
<body>
    <header>
            <!-- This section contains the logo and admin heading -->
    <nav class="navbar text-bg-dark">
                <div class="container-fluid">

                    <a class="navbar-brand" href="#">
                        <img src="E1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
                      </a>
                      <p class="h3"> Administrator</p>
                                     
                </div>
              </nav>
    </header>
    <main>
    <nav class="navbar">
<div class="container">
<p class="h2">Transactions</p>
<div class="dropdown dropstart ">                                                         
<button type="button" class="btn btn-outline-dark dropdown-toggle" id="Dashboard_btn" data-bs-toggle="dropdown"><i class="bi bi-list"></i></button>
<ul class="dropdown-menu">
    <li><a class="dropdown-item"  href='Dashboard.php' >Dashboard</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href='Customers.php' >Customers</a></li>
    <li><a class="dropdown-item" href="Employees.php">Employees</a></li>
    <li><a class="dropdown-item"  href="Suppliers.php">Suppliers</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href="Products.php">Products</a></li>
    <li><a class="dropdown-item" href="Supplies.php">Supplies</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href="Transactions.php">Transactions</a></li>
    <li><a class="dropdown-item" href="Deliveries.php">Deliveries</a></li>
    <li><a class="dropdown-item" href="Orders.php">Orders</a></li>
    <li><a class="dropdown-item" href="Services.php">Services</a></li>
    <li><a class="dropdown-item"href="Feedback.php">Feedback</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"href="Projects.php">Projects</a></li>
  </ul>
</div></div>
</nav>

<div id="Deliveries" class="container-fluid d-flex container-xl" style="border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);">
                   
                      <div class="col"><br>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search delivery by location" id="Search_txt" name="Search_txt">
                          <button class="btn btn-outline-dark" type="submit" id="Search_btn" name="Search_btn">
                            <span class="bi bi-search"></span>
                          </button><br>
                        </div> 
                        <div class="container-responsive ">
                                  
                          <table class="table " id="transactions_table">
                            <thead class="table-dark">
                              <tr>
                                <th>Transaction Id</th>
                                <th>Customer Id</th>
                                <th>Transaction purpose</th>
                                <th>Sevice Id</th>
                                <th>Order Id</th>
                                <th>Amount</th>
                                <th>Date Payed</th>
                                <th>Approval date</th>
                                <th>Status</th>                                
                              </tr>
                            </thead>
                            <tbody>

                                <?php 
                                  //`Transaction_Id`, `Cust_Id`, `Trasaction_Type`, `Serv_Id`,
                                  // `Order_Id`, `Amount`, `Date_Payed`, `Date_Approved`, `Status`
                                  $sql="SELECT * FROM transactions";
                                  $result = mysqli_query($conn,$sql);
                                  if($result->num_rows >0){ 
                                    while ( $row = mysqli_fetch_assoc($result)){
                                      ?>
                                      <tr>
                                      <td><?php echo $row["Transaction_Id"]?></td>
                                      <td><?php echo $row["Cust_Id"]?></td>
                                      <td><?php echo $row["Trasaction_Type"]?></td>
                                      <td><?php echo $row["Serv_Id"]?></td>
                                      <td><?php echo $row["Order_Id"]?></td>
                                      <td><?php echo $row["Amount"]?></td>
                                      <td><?php echo $row["Date_Payed"]?></td>
                                      <td><?php echo $row["Date_Approved"]?></td>
                                      <td><?php echo $row["Status"]?></td>
                                      </tr>
                                      <?php
                                  }

                                  }else{
                                    echo "<tr><td colspan='9'>No results found</td></tr>";
                                  }
                              
                                ?>                            
                            
                              </tbody>
                          </table>
                        </div>

                      </div>                     
                                  
</div>


        
    </main>
    <footer></footer>
</body>
</html>