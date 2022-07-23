<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['loggedIn'] = 'yes';
      header('location:index.php');
   }else{
      $message[] = 'incorrect email or password!';
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
    <form action="" method="POST">
        <h3>user login</h3>
        <?php
        if(isset($message)){
         foreach($message as $message){
            echo '<p>'.$message.'</p>';
         }
      }
      ?>
        <input type="email" name="email" id="email" class="box" placeholder="Email">
        <input type="password" name="password" id="password" class="box" placeholder="Password">
        <p>forget your password <a href="#">click here</a></p>
        <input type="submit" name='submit' value="login now" class="btn">
        <p>don't have an account <a href="register.php">create one</a></p>

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