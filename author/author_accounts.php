<?php

include '../components/connect.php';

session_start();

$author_id = $_SESSION['author_id'];

if(!isset($author_id)){
   header('location:author_login.php');
}

if(isset($_POST['delete'])){
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE author_id = ?");
   $delete_image->execute([$author_id]);
   while($fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC)){
      unlink('../uploaded_img/'.$fetch_delete_image['image']);
   }
   $delete_posts = $conn->prepare("DELETE FROM `posts` WHERE author_id = ?");
   $delete_posts->execute([$author_id]);
   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE author_id = ?");
   $delete_likes->execute([$author_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE author_id = ?");
   $delete_comments->execute([$author_id]);
   $delete_admin = $conn->prepare("DELETE FROM `authors` WHERE id = ?");
   $delete_admin->execute([$author_id]);
   header('location:../components/author_logout.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/authorStyling.css">

</head>
<body>

<?php include '../components/author_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Authors account</h1>

   <div class="box-container">



   <?php
      $select_account = $conn->prepare("SELECT * FROM `authors`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 

            $count_author_posts = $conn->prepare("SELECT * FROM `posts` WHERE author_id = ?");
            $count_author_posts->execute([$fetch_accounts['id']]);
            $total_author_posts = $count_author_posts->rowCount();

   ?>
   <div class="box" style="order: <?php if($fetch_accounts['id'] == $author_id){ echo '-1'; } ?>;">
      <p> Author id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> Firstname : <span><?= $fetch_accounts['firstname']; ?></span> </p>
      <p> Lastname : <span><?= $fetch_accounts['lastname']; ?></span> </p>
      <p> Email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <p> Birthdate : <span><?= $fetch_accounts['birthdate']; ?></span> </p>
      <p> Contact_number : <span><?= $fetch_accounts['contact_number']; ?></span> </p>
      <p> Address : <span><?= $fetch_accounts['address']; ?></span> </p>
      <p> Total posts : <span><uthortotal_admin_posts; ?></span> </p>
      <div class="flex-btn">
         <?php
            if($fetch_accounts['id'] == $author_id){
         ?>
            <a href="update_profile.php" class="option-btn" style="margin-bottom: .5rem;">update</a>
            <form action="" method="POST">
               <input type="hidden" name="post_id" value="<?= $fetch_accounts['id']; ?>" on>
               <button type="submit" name="delete"onclick="return confirm('delete the account?');" class="delete-btn" style="margin-bottom: .5rem;">delete</button>
            </form>
         <?php
            }
         ?>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>

<!-- admins accounts section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>