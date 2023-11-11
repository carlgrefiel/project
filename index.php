<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blogify</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <style>
      :root {
         --blue: #604fcf;
         --white: #fff;
         --green: #46af2c;
         --light-color: #f0f0f0;
      }
      
      body {
         background-color: var(--green);
         padding-bottom: 7rem;
         display: flex;
         align-items: center;
         justify-content: center;
         height: 100vh;
         margin: 0;
      }

      .container {
         width: 50%;
         height: 50%;
         border: 0.2rem solid #1d610c;
         background-color: var(--light-color);
         border-radius: 10px;
         text-align: center; 
         padding: 20px; 
      }

      h1 {
         color: var(--green);
         font-size: 60px;
      }

      p {
         padding-left: 50px;
         font-size: 24px;
      }
      .div-container {
         display: flex;
         justify-content: space-around;
         margin-top: 20px;
      }
      .button-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         margin-top: 20px;
      }

      .button {
         margin-top: 10px;
         padding: 10px 20px;
         font-size: 18px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
      }

      .author-button:hover {
         background-color: var(--green); 
         color: var(--white); 
      }
      .user-button:hover {
         background-color: var(--blue); 
         color: var(--white); 
      }

      .label {
         font-size: 24px;
         color: #333;
      }

      .author-button {
         background-color: #1d610c;
         color: var(--white);
      }

      .user-button {
         background-color: #007bff;
         color: var(--white);
      }
   </style>
</head>
<body>
   <div class="container">
     <h1>Blogify</h1>
     <p>Blogify is a user-friendly blogging platform where individuals can effortlessly share their thoughts and experiences. 
      Blogify provides a dynamic space for both seasoned writers and aspiring storytellers to connect and express themselves.</p>

     <div class="div-container">
         <div class="button-container">
            <label class="label" for="author-button">Login as Authors</label>
            <a href="author/author_login.php">
               <button id="author-button" class="button author-button">Click here</button>
            </a>  
         </div>
        <div class="button-container">
             <label class="label" for="user-button">Login as Users</label>
             <a href="login.php">
                <button id="user-button" class="button user-button">Click here</button>
             </a>
            
         </div>
      </div>
   </div>

   <script src="js/script.js"></script>
</body>
</html>
