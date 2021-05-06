<?php
  if(isset($_POST['submit'])){
    $conn=new mysqli("localhost", "root", "", "databasename");
      if($conn->connect_error){
          die("Connection error");
      }
      else{
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['pwd'];
        $rptpassword=$_POST['pwd-repeat'];
      if(empty($name) || empty($email) || empty($password) || empty($rptpassword)){
          header("Location: ../signupform.php?error=emptyfields&name=".$name."&email=".$email);
          exit();
      }
      else{
        if(!preg_match("/^[a-zA-Z0-9_ ]*$/",$name)){
            header("Location: ../signupform.php?error=invalidname");
            exit();
        }
          else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signupform.php?error=invalidmail");
                exit();
            }
              else{
                    if($password !== $rptpassword){
                        header("Location: ../signupform.php?error=pwdnotmatch&name=".$name."&email=".$email);
                        exit();
                      }
                      else{
                          $sql="SELECT user_name FROM users WHERE user_name=?";
                            $stmt=$conn->prepare($sql);
                            $stmt->bind_param("s",$name);
                            $stmt->execute();
                            $stmt->store_result();
                            $resultCheck=$stmt->num_rows;
                            if($resultCheck > 0){
                               header("Location: ../signupform.php?error=usertaken&email=".$email);
                               exit();
                            }
                          else{
                            $sql="SELECT user_email FROM users WHERE user_email=?";
                            $stmt=$conn->prepare($sql);
                            $stmt->bind_param("s",$email);
                            $stmt->execute();
                            $stmt->store_result();
                            $resultCheck=$stmt->num_rows;
                            if($resultCheck > 0){
                               header("Location: ../signupform.php?error=emailtaken&name=".$name);
                               exit();
                            }
                            else{
                          $sql= "INSERT INTO users (user_name, user_email, user_pwd) VALUES (?, ?, ?)";
                          $stmt=$conn->prepare($sql);
                          $hashedPwd= password_hash($password, PASSWORD_DEFAULT);
                          $stmt->bind_param("sss", $name, $email, $hashedPwd);
                          $stmt->execute();
                          header("Location: ../signupform.php?signup=success");
                           exit();
                            }   
                        }
                      }
                  }
              }
          }
      }
      $stmt->close();
      $conn->close();
  }
  else{
      header("Location: ../signupform.php");
      exit();
  }
