<?php
include("connect.php");
if(isset($_POST['submit'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpass'];
    

    $sql="SELECT * FROM shuka WHERE username='$username'";
    $result =mysqli_query($conn,$sql);
    $count_user=mysqli_num_rows($result);
    
    $mysql="SELECT * FROM shuka WHERE email='$email'";
    $myresult=mysqli_query($conn,$mysql);
    $count_email=mysqli_num_rows($myresult);

   if($count_user==0 && $count_email==0){ 
    if($password==$cpassword){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO shuka(username,email,password) VALUES ('$username', '$email', '$hash')";
        $result=mysqli_query($conn,$sql);
        

        if($result){
            header("location:LOGIN.php");
            exit();
        }
    }
    }
    else{
        if($count_user>0){
            echo"<script>
            window.location.href='index.php';
            alert('Username already exists!!');
            </script>";
        }
        if($count_email>0){
            echo"<script>
            window.location.href='index.php';
            alert('Email already exists!!');
            </script>";
        }
    }

}
?>
