<?php 
 require_once("connect.php");
$id= $_GET["id"];
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer details</title>
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
        <script>
            $(document).ready(function(){

                $(back_btn).click(function(){
                  window.location.href = "Customers.php";
                }); 
            });
        </script>
</head>
<body>
<header>
<nav class="navbar text-bg-dark">
          <div class="container-fluid">              
                 <img src="E1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
                 <h5>Customer details</h5>
                 <p class="h5"> Administrator</p>                                     
           </div>
     </nav>
</header><br>

<main>
    
    <?php 
        $sql="SELECT * FROM customer_details WHERE `Cust_Id` ='$id'"; 
        $result = mysqli_query($conn,$sql); 
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container" style="border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
                width:20vw;">
    <h6>Customer Id: <?php echo "$id" ?></h6>
    <h6>Name: <?php  echo $row['Cust_Firstname']; echo" "; echo $row['Cust_Lastname'] ?></h6> 
    </div><br>
    <div class="container" style="border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
                width:90vw;">        
        <button class="btn btn-outline-dark" id="back_btn"><i class="bi bi-arrow-90deg-left"></i></button>
        
        <h6 class="p-2" >More information :</h6>
            <div class="row" >
           
                <div class="col ">                                  
                    <h6> <?php  echo $row['Cust_Phonenumber']?></h6>
                    <h6> <?php  echo $row['Cust_Location']?></h6>
                    <h6> <?php  echo $row['Email']?></h6>                    
                </div>
                <div class="col">
                    <h6> <?php  echo $row['Cust_Dateofbirth']?></h6>
                    <h6> <?php  echo $row['Cust_Gender']?></h6>
                    <h6> <?php  echo $row['Cust_National_Idno']?></h6>
                </div>        
            </div><br><br>
            
            <div class="row ">
                <div class="col">
                    <h6 >Transaction History</h6>
                </div><br>
                <div class="col">
                    <h6>Delivery History</h6>
                </div><br>
                <div class="col">
                    <h6>Feedback History</h6>
                </div>
                <div class="col">
                    <h6>Order History</h6>
                </div>   
            </div>
            
            
    </div>
</main>
<footer>

</footer>    
</body>
</html>