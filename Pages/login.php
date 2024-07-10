<?php

$host="Localhost";
$pass="";
$user="root";
$db="exen-limited";

$conn=mysqli_connect($host,$user,$pass,$db);

if($conn-> connect_error){
    echo "connection failed" .$conn-> connect_error;
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql="SELECT `Email`, `Password` FROM users WHERE Email='$email' AND Password='$password'";
    $result = $conn->query($sql);
   if($result->num_rows > 0) {
      $redirect_url = "Dashboard.php";
      header("Location: $redirect_url");
      exit;      
    } 
    else{
      $redirect_url = "Login.php";
      header("Location: $redirect_url");
    }
          
  }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>
          Admin Login
        </title>
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
             
             <style>
              body{
                font-family: 'Montserrat', sans-serif;
                background: #f6f5f7;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: -20px 0 50px;
                margin-top: 20px;
                
              }
              .Main{
                width: 520px;
                height: 437px;
                background: #0d0d0d;
                color: #f7f8f6;
                padding: 30px 40px;
                border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
                position: relative;
                overflow: hidden;   
                max-width: 100%;
                min-height: 480px;
              }
              .Main h1{
                font-size: 36px;
                text-align: center;

              }
              .Main h2{
                font-size: 36px;
                text-align: center;

              }
              .Main .Username {
                width: 90%;
                height: 50px;
                margin: 30px 0; 
                
              }
              .Main .Password {
                width: 90%;
                height: 50px;
                margin: 30px 0; 
              }
              .Username input{
                width: 100%;
                height: 100%;
                background: transparent;
                border: none;
                outline: none;
                border: 2px solid rgba( 255,255,255, .2);
                border-radius: 40px;
                font-size: 16px;
                color: rgb(255, 255, 255);
                padding-left: 20px;
              }
              .Password input{
                width: 100%;
                height: 100%;
                background: transparent;
                border: none;
                outline: none;
                border: 2px solid rgba( 255,255,255, .2);
                border-radius: 40px;
                font-size: 16px;
                color: white;
                padding-left: 20px;
                
              }
          
              .Main .submit{
                width: 93%;
                height: 45px;
                background: #cfcfde;
                border: none;
                outline: none;
                border-radius: 40px;
                box-shadow: 0 0 10px rgba(0,0,0 , .1);
                cursor: pointer;
                font-size: 16px;
                font-weight: 600;
               
              }
              .Main .submit :hover{
                background: #444446;
              }
              image{
                width: 40px;
                height: 40px;
              }
         
             </style>
             
             <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    </head>
    <body>
    
    <div class="Main">   
    <?php if (isset($_GET['error'])) : ?>
        <p style="color: red;">
            <?php echo ($_GET['error'] === 'email') ? 'Email does not exist.' : 'Incorrect Password.'; ?>
        </p>
    <?php endif; ?>   
      <form  method="POST" class="Login_Form">
          <h1>EXEN LIMITED</h1>
          <h2>Admin</h2>          
          <div class="Username">
            <input type="text" id="Username"  name="email" id="email" placeholder="Email" required>
        </div>
        <div class="Password">
          <input type="Password" id="password" name="password" id="password" placeholder="Password" required>
        </div><br><br>
        <button type="submit" class="submit ">Login</button>        
      </form><br>       
    </div>
    </body>
</html>