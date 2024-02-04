<!DOCTYPE html>
    <head>
        <title>signup test</titile>
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
            height: 40px;
          }
          input:focus {
            outline-color: green;
          }
          input[type ="submit"]{
            background-color: 4caf50;
            color: #fff;
            cursor: pointer;
        
          }

         .confirm{
             width: 20px;
            height: 20px;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
            
          }
          .error{
            color: red;
          }
          .login{background-color: green;
                padding: 10px;
                
            }
            .login a{
                text-decoration: none;
                color: white;
            }
            #submit{
                font-size: 20px
            }
            </style>
        
</head>
<body>
  <?php 
      $conn = mysqli_connect("localhost","root","","hna");
      function test_input($data){
          $data  = trim($data);
          $data  = stripslashes($data);
          $data  = htmlspecialchars($data);
          return $data;
      }

       $error_email = $error_password = $error_password2 = $error_confirm ="";
       $email = $password = $password2 = $confirm = "";
        
       if($_SERVER["REQUEST_METHOD"] === "POST"){

            if(empty($_POST["email"])){
                $error_email = "email is  required";
            }else {
                $email = test_input($_POST["email"]);
            }
        
            if(empty($_POST["password"])){
                $error_password = "Password is required";
            }else {
                $password = test_input($_POST["password"]);
                $password2 = test_input($_POST["password2"]);
            }
        
            if(!isset($_POST["confirm"])){
                $error_confirm = "agreed to the terms and conditions";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error_email = "invalid email format";
            }

            if($password !== $password2){
                $error_password = "password is not the same";
            }
            if(strlen($password) < 6 ){
                $error_password = "password length cannot be less that six ";
            }

            if(empty($error_email)  && empty($error_password)){
          
            if($conn === false){
                die("Error: could not connet".
                mysqli_connect_error());
            }
            $sql = "INSERT INTO signuptest VALUES('$email','$password')";

            if(mysqli_query($conn, $sql)){
                echo '<style>'. '#myForm{display: none}'.'</style>';
                echo "form has been submitted successfully";
                echo '<button class ="login">' . '<a href = "./index.php">' . 'click here to login'. '<a/>'. '</button>';
            }else{
                echo  "error submitting form";
            }

            }
        
        }

     mysqli_close($conn);
  ?>
    
    <form id = "myForm" method ="post" action = "<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]);?>"> 
        <label for ="email"> Email </label>
        <input type = "text" name ="email" id ="email">
        <span class ="error"><?php echo $error_email?></span>

        <label for ="password"> Password </label>
        <input type = "password" name ="password" id ="password">
        <span class ="error"><?php echo $error_password?></span>

        <label for ="password2"> Confirm password </label>
        <input type = "password" name ="password2" id ="password2">
        <span class ="error"><?php echo $error_password2?></span>


        <input type ="checkbox" name = "confirm" id ="confirm" class="confirm">
        <span style = "color:blue">I agree to the terms of service and privacy policy</span>
        <span class ="error"><?php echo $error_confirm?></span>

         <input type ="submit" value ="create account" id ="submit">
    </form>
</body>
</htm>