<!DOCTYPE html>
    <head>
        <meta name = "viewpoint" content = "width=device-width, initial-scale=1.0">
        <style>
          body{
            margin:0;
            padding:0;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4
          }
          form{
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 75%;
            align-self: center;
            margin: 0 auto;
            margin-top: 20px
          
          }
          label{
            display: block;
            margin-bottom: 8px;
          }
          input{
            width:100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius : 4px;
            color: blue;
          }
          input:focus {
            outline-color: green;
          }
          input[type ="submit"]{
            background-color: 4caf50;
            color: #fff;
            cursor: pointer;
          

          }
          .error{
            color: red;
          }
          #submit{
                font-size: 20px
            }
          .success{
            background-color: smoke-white;
            color: green; 
            font-size: 25px;
            text-align: center;
          }
            </style>
        
</head>
<body>
    <?php 
        $error_password = $error_email = $error_message = "";
        $email = $password = "";

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(empty($_POST["email"])){
                $error_email = "Username is required";
            }else {
                $email = test_input($_POST['email']);
            }

             if(empty($_POST["password"])){
                 $error_password = "Password is required";
             }else {
                 $password = test_input($_POST['password']);
             }

             if(empty($error_email)  && empty($error_password)){
                 $conn = mysqli_connect("localhost","root","","hna");

               if($conn === false){
                   die("Error: could not connet".
                mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM signuptest WHERE email = '$email' AND  
        password ='$password'";

        $result = $conn->query($sql);

        if($result->num_rows > 0) {
          echo '<style>'. '#myForm{display: none}'.'</style>';
          
          echo "<div class ='success'>" . "Hurray!!! you login successfull". "</div>";
                   
        }else{
          $error_message = "wrong username or password";
        }
         
        mysqli_close($conn);
        }
      }

      function test_input($data){
        $data  = trim($data);
        $data  = stripslashes($data);
        $data  = htmlspecialchars($data);
        return $data;

      }

  
  ?>
    <form id = "myForm" method = "post"  action = "<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]);?>">
        <label for ="email"> Email </label>
        <input type = "text" name ="email" id ="username">
        <span class ="error"><?php echo $error_email?></span>

        <label for ="password"> Password </label>
        <input type = "password" name ="password" id ="password">
        <span class ="error"><?php echo $error_password?></span>

        <span class ="error"><?php echo $error_message?></span>
        <input type ="submit" value ="submit" id ="submit">
    </form>
</body>
</htm>