<?php
  include 'connect.php';
  $success = 0;
  $unsuccess = 0;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email =$_POST['email'];
    $password =$_POST['password'];
    $sql = "SELECT * FROM shuka WHERE email='$email'";
    $result = mysqli_query($conn, $sql);//checks connection to database
if ($result) {
  if (mysqli_num_rows($result)>0) {// checks if that record exists >1 means the record exists
      // check if password match
    //get password hash from db
    $shuka = mysqli_fetch_assoc($result);
    $password_hash = $shuka['password'];
    //password_verify ()-compares the hash password with the password the user has inputed
    if (password_verify($password, $password_hash)) {
     // echo"Login successful";
      //sessions-to store user data(in variables) across multiple pages
      session_start();//start user session
      $_SESSION['email']=$email;
      $_SESSION['id']=$shuka['id'];
      header("location:home.html");
      exit();
    } else{
     // echo"Invalid login";
      $unsuccess=1;
        }
     }
  }
}
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="LOGIN.CSS">
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <div class="text">
                    <p> SHUKA! <i>  Discover your perfect hairstyle with us  </i></p>
                </div>     
                <!-------------      image     ------------->
                
                
            </div>
            <div class="col-md-6 right">
                
                <div class="input-box">
                   
                   <header>Log into account</header>
                   <form method="post" action="">
                   <div class="input-field">
                        <input type="text" class="input" id="email"name="password" required="" autocomplete="off">
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" name="password" required="">
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" value="Login">
                   </div> 
</form>
                   <div class="signin">
                    <span>Dont  have an account? <a href="signup.php">Sign up here</a> </span>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>