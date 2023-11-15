<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['reader_id'])){
   $reader_id = $_SESSION['reader_id'];
}else{
   $reader_id = '';
   header('location:index.php');
};

if(isset($_POST['submit'])){

   $firstname = $_POST['firstname'];
   $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);

   if(!empty($firstname)){
      $update_firstname = $conn->prepare("UPDATE `readers` SET firstname = ? WHERE id = ?");
      $update_firstname->execute([$firstname, $reader_id]);
   }

   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);

   if(!empty($lastname)){
      $update_lastname = $conn->prepare("UPDATE `readers` SET lastname = ? WHERE id = ?");
      $update_lastname->execute([$lastname, $reader_id]);
   }

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($email)){
      $update_email = $conn->prepare("UPDATE `readers` SET email = ? WHERE id = ?");
      $update_email->execute([$email, $reader_id]);
   }

   $birthdate = $_POST['birthdate'];
   $birthdate = filter_var($birthdate, FILTER_SANITIZE_STRING);

   if(!empty($birthdate)){
      $update_birthdate = $conn->prepare("UPDATE `readers` SET birthdate = ? WHERE id = ?");
      $update_birthdate->execute([$birthdate, $reader_id]);
   }

   $contact_number = $_POST['contact_number'];
   $contact_number = filter_var($contact_number, FILTER_SANITIZE_STRING);

   if(!empty($contact_number)){
      $update_contact_number = $conn->prepare("UPDATE `readers` SET contact_number = ? WHERE id = ?");
      $update_contact_number->execute([$contact_number, $reader_id]);
   }
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   if(!empty($address)){
      $update_address = $conn->prepare("UPDATE `readers` SET address = ? WHERE id = ?");
      $update_address->execute([$address, $reader_id]);
   }

   $message[] = 'Updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/userStyling.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
      <h3>update profile</h3>
      <label>Firstname:</label>
      <input type="text" name="firstname" value="<?= $fetch_profile['firstname']; ?>" class="box" maxlength="50">
      <label>Lastname:</label>
      <input type="text" name="lastname" value="<?= $fetch_profile['lastname']; ?>" class="box" maxlength="50">
      <label>Email:</label>
      <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <label>Birthdate:</label>
      <input type="date" class="box" name="birthdate" value="<?= $fetch_profile['birthdate']; ?>" >
      <label>Contact Number:</label>
      <input type="text" name="contact_number" value="<?= $fetch_profile['contact_number']; ?>" class="box" maxlength="50">
      <label>Address:</label>
      <input type="text" name="address" value="<?= $fetch_profile['address']; ?>" class="box" >
      <input type="submit" value="update now" name="submit" class="btn">
   </form>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>