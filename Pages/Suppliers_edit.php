<?php 
require_once("connect.php");

$id= $_GET["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
         body{                
                background: #f6f5f7;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: -20px 0 50px;
                margin-top: 20px;                
              }
    </style>
</head>
<body>

<h4>Edit Supplier details</h4>
    <div class="card bg-outline-dark p-2 my-4 d-flex justify-content-center" style="border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
                width:60vw;"> 
                <div class="container-fluid">
                    <a href="Suppliers.php" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i></a>                    
                </div>
                                                       
        <div class="card-body">
                <?php                                          
                    $sql6="SELECT * FROM supplier_details WHERE Supplier_Id = '$id'";
                    $result6 = mysqli_query($conn,$sql6); 
                    $row = mysqli_fetch_assoc($result6);
                ?>
            <form action="" method="post">
                <!-- `Supplier_Id`, `Name`, `Type`, `Location`, `Phonenumber`, `email_address`, `start_date`  -->

                  <input type="text" class="form-control mt-3" placeholder="Name" value="<?php echo $row['Name']?>" name="">                  
                  <input type="text" class="form-control mt-3" placeholder="Location" value="<?php echo $row['Location'] ?>" name="">
                  <input type="text" class="form-control mt-3" placeholder="Phone number" value="<?php echo $row['Phonenumber'] ?>" name="">
                  <input type="text" class="form-control mt-3" placeholder="Email address" value="<?php echo $row['email_address'] ?>" name="">
                  <input type="date" class="form-control mt-3" id="datepicker" placeholder="contract start date" 
                          value="<?php $date=$row['start_date']; 
                                       $date = date('Y-m-d', strtotime($date));
                                       echo htmlspecialchars($date);?>"><br>
                  <div class="form-group mb-3">
                    <label>Supplier type:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["Type"] == 'Company') ? "checked" : ""; ?>>
                    <label for="male" class="form-input-label">Company</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["Type"] == 'Individual') ? "checked" : ""; ?>>
                    <label for="female" class="form-input-label">Individual</label>
                  </div>
                  <button class="btn btn-outline-dark mt-3" type="button">Submit</button>
            </form>
        </div> 
    </div>
    
</body>
</html>