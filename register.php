<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $tel = mysqli_real_escape_string($conn, $_POST['tel']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `users`(name, email, password, image,tel,address) VALUES('$name', '$email', '$pass', '$image','$tel','$address')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font-awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- swiper slider cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>
</head>
<body>
<!-- header section starts -->

<header class="header">

    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="/" class="logo"><span>max</span>wheels </a>

    <nav class="navbar">

        <a href="#home">Home</a>
        <a href="#vehicles">Vehicles</a>
        <a href="#services">Services</a>
        <a href="#featured">Featured</a>
        <a href="#reviews">Reviews</a>
        <a href="#contact">Contact</a>

    </nav>

</header>

<div class="login-form-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>user registeration</h3>
        <?php
        if(isset($message)){
         foreach($message as $message){
            echo '<p>'.$message.'</p>';
         }
      }
      ?>
        <input type="text" name="name" id="name" class="box" placeholder="Full Name">
        <input type="tel" name="tel" id="tel" class="box" placeholder="Phone Number">
        <input type="text" name="address" id="address" class="box" placeholder="Address">
        <input type="email" name="email" id="email" class="box" placeholder="Email">
        <input type="password" name="password" id="password" class="box" placeholder="Password">
        <input type="password" name="cpassword" id="cpassword" class="box" placeholder="Re-enter Password">
        <input type="file" name="image" id="image" class="box" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" name="submit" value="Register" class="btn">
        <p>already have an account <a href="login.php">login</a></p>

    </form>
</div>


<!-- footer section starts -->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>our branches</h3>
            <a href=""><i class="fas fa-map-marker-alt"></i>India</a>
            <a href=""><i class="fas fa-map-marker-alt"></i>France</a>
            <a href=""><i class="fas fa-map-marker-alt"></i>Africa</a>
            <a href=""><i class="fas fa-map-marker-alt"></i>Australia</a>
            <a href=""><i class="fas fa-map-marker-alt"></i>Russia</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href=""><i class="fas fa-arrow-right"></i>Home</a>
            <a href=""><i class="fas fa-arrow-right"></i>Vehicles</a>
            <a href=""><i class="fas fa-arrow-right"></i>Services</a>
            <a href=""><i class="fas fa-arrow-right"></i>Featured</a>
            <a href=""><i class="fas fa-arrow-right"></i>Reviews</a>
            <a href=""><i class="fas fa-arrow-right"></i>Contact</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href=""><i class="fas fa-phone"></i>+123-456-7890</a>
            <a href=""><i class="fas fa-phone"></i>+123-456-7890</a>
            <a href=""><i class="fas fa-envelope"></i>abcd@gmail.com</a>
            <a href=""><i class="fas fa-map-marker-alt"></i>mumbai, india -400104</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href=""><i class="fab fa-facebook"></i>facebook</a>
            <a href=""><i class="fab fa-twitter"></i>twitter</a>
            <a href=""><i class="fab fa-instagram"></i>instagram</a>
            <a href=""><i class="fab fa-linkedin"></i>linkedin</a>
            <a href=""><i class="fab fa-pinterest"></i>pinterest</a>

        </div>
    </div>

    <div class="credit">created by mr. web designer | all rights reserved</div>
</section>
<!-- footer section ends -->





    
<!-- slider swiper link -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!-- custom js link -->
    <script src="js/script.js"></script>
</body>
</html>