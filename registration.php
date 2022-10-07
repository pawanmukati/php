<?php
 session_start();
 
?>

<html>

<head>
    <?php include 'css/style.php' ?>
    <?php include 'links/links.php' ?>
    <?php include 'db.connection.php' ?>
</head>

<body background="red">

<?php
    

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);

        // pass-hashing
        $pass = password_hash($password,PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword,PASSWORD_BCRYPT);

        // checking Email
        $emailquery = "select * from registration where email = '$email' ";
        $query = mysqli_query($connection,$emailquery);

        $emailcount = mysqli_num_rows($query);
      
        
        if($emailcount > 1){
            
            // echo "<p class="text-danger" >Email already exists</p>";
            echo '<span id="modal_errors_1" class="text-danger text-center mx-auto">Email already exists</span>';

            // first-way--
            // $insertdata = "insert into registration( username, email, mobile, password, cpassword) values('$username','$email','$mobile','$password','$cpassword')";
            // echo $insertdata ;
            // $inserteduserdata = mysqli_query($connection,$insertdata)

            // second-way--
            if (isset($_GET['email'])) {
                // update fields
                $user_email = $_GET['email']; 

                $sql = "SELECT * FROM `registration` WHERE `email`='$user_email'";

                $result = $conn->query($sql); 

                if ($result->num_rows > 0) {        

                    while ($row = $result->fetch_assoc()) {
                         $username = $row['username'];
                         $email = $row['email'];
                         $mobile = $row['mobile'];
                         $password  = $row['password'];
                         $cpassword = $row['cpassword'];
                    }
                    
                }else{
                   
                }
            }
            ?>
            <!-- <script>
                alert("Email already exists");
            </script> -->

            <?php
        }else{
            if($password === $cpassword){

                $insertquery = "insert into registration( username, email, mobile, password, cpassword) values('$username','$email','$mobile','$pass','$cpass')";
                $iquery = mysqli_query($connection,$insertquery);

                if($iquery){
                    ?>
                    <script>
                        alert("Inserted Successfully");
                    </script>
                    <?php
                    // reset($iquery);
                }else{
                    ?>
                    <script>
                        alert("No Inserted");
                    </script>
                    <?php
                }

            }else{
                ?>
                    <script>
                        alert("Password are not matching");
                    </script>
                    <?php
            }
            ?>
            <script>
                alert("Register Successfull");
                location.replace("login.php");
            </script>
            <?php
        }
    }else{
        
    }
 ?>
 

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-6 login-box ">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    REGISTRATION FORM
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">Full Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php  echo $email ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Phone Number</label>
                                <input type="number" name="mobile" class="form-control" value="<?php echo $mobile; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Create Password</label>
                                <input type="password" name="password" class="form-control" value="<?php  echo $password; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Repeat Password</label>
                                <input type="password" name="cpassword" class="form-control" value="<?php  echo $cpassword; ?>" required>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-12">
                                    <!-- error-message -->
                                    <!-- <p class="text-danger">Email already exists</p> -->
                                 
                                </div>
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="" name="submit" style="display:block !important;" class="btn btn-outline-primary mx-auto ">Create Account</button>
                                    <p class="text-white text-center my-2 d-block" style="display:block !important;">Have an account? <a href="login.php">Log In</a> </p>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
            <div class="col-lg-3 col-md-3"></div>
        </div>






</body>

</html>