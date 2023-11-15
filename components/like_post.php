<?php

if(isset($_POST['like_post'])){

   if($reader_id != ''){
      
      $post_id = $_POST['post_id'];
      $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
      $author_id = $_POST['author_id'];
      $author_id = filter_var($author_id, FILTER_SANITIZE_STRING);
      
      $select_post_like = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ? AND reader_id = ?");
      $select_post_like->execute([$post_id, $reader_id]);

      if($select_post_like->rowCount() > 0){
         $remove_like = $conn->prepare("DELETE FROM `likes` WHERE post_id = ?");
         $remove_like->execute([$post_id]);
         $message[] = 'removed from likes';
      }else{
         $add_like = $conn->prepare("INSERT INTO `likes`(reader_id, post_id, author_id) VALUES(?,?,?)");
         $add_like->execute([$reader_id, $post_id, $author_id]);
         $message[] = 'added to likes';
      }
      
   }else{
         $message[] = 'please login first!';
   }

}

?>