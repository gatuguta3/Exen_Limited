<?php
require_once("connect.php");
$sql1 = "SELECT * FROM customer_details";
$result1 = $conn->query($sql1);

?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customers</title>
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
   $(document).ready(function(){
  // jQuery methods go here...

        $('#customer_table').on('click', '.viewbtn ', function(event) {
            var table = $('#customer_table').DataTable();
            var trid = $(this).closest('tr').attr('Cust_Id');
            // console.log(selectedRow);
            var id = $(this).data('Cust_Id');
           

            $.ajax({
              url: "php_files\Page_functions\Fetch_Cust.php",
              data: {
                id: id
              },
              type: 'post',
              success: function(data) {
                var json = JSON.parse(data);             
                $('#ID').val(id);              
              }
            })
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
<p class="h2">Customers</p>
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
</nav><br>
  
    <div id="Customers" class="container-fluid container-xl">
                        <div class="row">
                          <div class="col">
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Search customer">
                              <button class="btn btn-outline-dark" type="submit">
                                <span class="bi bi-search"></span>
                              </button>
                            </div> 
                            <div class="container-responsive mt-3">
                                      
                              <table id="customer_table" class="table">
                                <thead class="table-dark">
                                  <tr>
                                    <th>Customer Id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Phone number</th>
                                    <th>Location</th>
                                    <th>Email address</th>
                                    <th>Date of birth</th>
                                    <th>Id number</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                          echo "<tr>";                                         
                                          echo "<td>" . $row1["Cust_Id"] ."</td>";
                                          echo "<td>" . $row1["Cust_Firstname"] ."</td>";
                                          echo "<td>" . $row1["Cust_Lastname"] ."</td>";
                                          echo  "<td>" . $row1["Cust_Phonenumber"] ."</td>";
                                          echo"<td>" . $row1["Cust_Location"] ."</td>";
                                          echo"<td>" . $row1["Cust_Email"] ."</td>";
                                          echo"<td>" . $row1["Cust_Dateofbirth"] ."</td>";
                                          echo"<td>" . $row1["Cust_National_Idno"] ."</td>";
                                          echo "<td>" ;
                                          echo "
                                          <button type='button' class='btn btn-outline-dark '>
                                          <i class='bi bi-eye'></i> View
                                          </button>
                                               ";                   
                                              
                                          echo "</td>";
                                          echo "</tr>";                                               
                                          }
                                    
                                    }else{
                                        echo "<tr><td colspan='3'>No data found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                              </table>
                            </div>

                          </div>                      
                        </div>
                                                
    </div>

 <!-- the view customer details Modal  -->
    <div class="modal" id="View_Modal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content ">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Customer details</h4>
            
          </div>

          <!-- Modal body -->
          <div class="modal-body">
     
          <form>      
          <input type="text" class="form-control mt-3" placeholder="id" id="ID">
                          <input type="text" class="form-control mt-3" placeholder="First name" >
                          <input type="text" class="form-control mt-3" placeholder="Last name">
                          <input type="text" class="form-control mt-3" placeholder="National id number">
                          <input type="text" class="form-control mt-3" placeholder="Phone number">
                          <input type="text" class="form-control mt-3" placeholder="Email address">
                          <input type="date" class="form-control mt-3" id="datepicker"> 
                          <input type="text" class="form-control mt-3" placeholder="Email address">
                          <input type="text" class="form-control mt-3" placeholder="Email address">
                          </div>  
                          
                        </form>  
          <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        </div></div>
    </div>

</main>
  
</body>
</html>