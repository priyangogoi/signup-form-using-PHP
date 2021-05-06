<html>
<head>
<style>
 .sform{
     padding-top:30px;
     padding-left:10px;
     text-align:center;
   }
   input{
      display:block;
      margin:0 auto; 
   }
   .signuperror{
      color:#FF0000;
   }
   .signupsuccess{
      color:#00ff00;
   }
   
</style>
<title>
Sign up
</title>
</head>
<body>
     <div class="sform">
        <h2>Signup</h2>
        <div class="stats">
        <?php
        if(isset($_GET['error'])){
          if($_GET['error']=="emptyfields"){
             echo '<p class="signuperror">Fill in all the fields</p>';
          }
          else if($_GET['error']=="invalidname"){
             echo '<p class="signuperror">Invalid username(*cannot use space and special character)</p>';
          }
          else if($_GET['error']=="invalidmail"){
            echo '<p class="signuperror">Invalid e-mail</p>';
         }
         else if($_GET['error']=="pwdnotmatch"){
            echo '<p class="signuperror">Your password do not match! </p>';
         }
         else if($_GET['error']=="usertaken"){
            echo '<p class="signuperror">User name is already taken</p>';
         }
         else if($_GET['error']=="emailtaken"){
            echo '<p class="signuperror">Try another E-mail this one is already taken</p>';
         }
      }
      else if($_GET['signup']=="success"){
         echo '<p class="signupsuccess">Sign up successful</p>';
      }
      else if($_GET['sign']=="signupfirstorlogin"){
         echo '<p class="signuperror">Please signup first or login if you already have an account</p>';
      }
      ?>
   </div>
       <form action="signupdb.php" method="POST">
       <?php
        if(isset($_GET['name'])){
            $name=$_GET['name'];
            echo '<input type="text" name="name" placeholder="User name" value="'.$name.'"></input>';
                  }
                  else{
                     echo '<input type="text" name="name" placeholder="User name"></input>';
                  }
                   if(isset($_GET['email'])){
                        $email=$_GET['email'];
                        echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'"></input>';
                     }
                      else{
                        echo '<input type="text" name="email" placeholder="E-mail"></input>';
                         }
                   ?>
       <input type="password" name="pwd" placeholder="Password"></input>
       <input type="password" name="pwd-repeat" placeholder="Repeat password"></input>
       <button type="submit" name="submit">Sign up</button> 
       </form> 
      </div>
</body>
</html>
