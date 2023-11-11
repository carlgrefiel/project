<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_author = $conn->prepare("SELECT * FROM `authors` WHERE email = ? AND password = ?");
   $select_author->execute([$email, $pass]);
   
   if($select_author->rowCount() > 0){
      $fetch_author_id = $select_author->fetch(PDO::FETCH_ASSOC);
      $_SESSION['author_id'] = $fetch_author_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login || Author</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/authorStyling.css">

   
</head>
<body style="padding-left: 0 !important;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<section class="form-container">

   <form action="" method="POST">
      <h3>login as Author</h3>
      <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login" name="submit" class="btn">
      <p>don't have an account? <a href="register_author.php">Register now</a></p>
  
   </form>
   
</section>

</body>
</html>