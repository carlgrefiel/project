<?php

include '../components/connect.php';

session_start();

$author_id = $_SESSION['author_id'];

if(!isset($author_id)){
   header('location:author_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/authorStyling.css">

</head>
<body>

<?php include '../components/author_header.php' ?>

<!-- users accounts section starts  -->

<section class="accounts">

   <h1 class="heading">users account</h1>

   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `users`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 
            $user_id = $fetch_accounts['id']; 
            $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
            $count_user_comments->execute([$user_id]);
            $total_user_comments = $count_user_comments->rowCount();
            $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $count_user_likes->execute([$user_id]);
            $total_user_likes = $count_user_likes->rowCount();
   ?>
   <div class="box">
      <p> users id : <span><?= $user_id; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['firstname']; ?></span> </p>
      <p> total comments : <span><?= $total_user_comments; ?></span> </p>
      <p> total likes : <span><?= $total_user_likes; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>

<!-- users accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>