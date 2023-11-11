<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $firstname = $_POST['firstname'];
   $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);

   $birthdate = $_POST['birthdate'];
   $birthdate = filter_var($birthdate, FILTER_SANITIZE_STRING);
   $contact_number = $_POST['contact_number'];
   $contact_number = filter_var($contact_number, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(firstname, lastname, email, birthdate, contact_number, address, password) VALUES(?,?,?,?,?,?,?)");
         $insert_user->execute([$firstname,$lastname, $email, $birthdate, $contact_number, $address, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
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
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_Style.css">

</head>
<body>
   
<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <label>Firstname:</label>
      <input type="text" name="firstname" required placeholder="Enter your firstname" class="box" maxlength="50">
      <label>Lastname:</label>
      <input type="text" name="lastname" required placeholder="Enter your lastname" class="box" maxlength="50">
      <label>Email:</label>
      <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <label>Birthdate:</label>
      <input type="date" class="box" name="birthdate" placeholder="Enter your birthdate" >
      <label>Contact Number:</label>
      <input type="text" name="contact_number" placeholder="Enter your contact number" class="box" maxlength="50">
      <label>Address:</label>
      <input type="text" name="address" placeholder="Enter your address" class="box" >
      <label>Password:</label>
      <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <label>Confirm Password:</label>
      <input type="password" name="cpass" required placeholder="Confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>