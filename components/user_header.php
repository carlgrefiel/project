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

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Blogify</a>

      <form action="search.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="search for blogs" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <nav class="navbar">
         <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
         <a href="posts.php"> <i class="fas fa-angle-right"></i> Posts</a>
         <a href="all_category.php"> <i class="fas fa-angle-right"></i> Category</a>
         <a href="authors.php"> <i class="fas fa-angle-right"></i> Authors</a>
         
      </nav>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `readers` WHERE id = ?");
            $select_profile->execute([$reader_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['firstname']; ?></p>
         <a href="update.php" class="btn">Update profile</a>
        
         <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
            <p class="name">Please login first!</p>
            <a href="login.php" class="option-btn">Login</a>
         <?php
            }
         ?>
      </div>

   </section>

</header>