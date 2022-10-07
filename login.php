<?php 

    session_start();

?>

<html>

<head>
    <?php include 'css/style.php'?>
    <?php include 'links/links.php'?>
    <?php include 'db.connection.php'?>

</head>

<body>
    <?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = "select * from registration where email = '$email' ";
    $query = mysqli_query($connection, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {
        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['password'];
        $_SESSION['username'] = $email_pass['username'] ;

        $pass_decode = password_verify($password, $db_pass);
        if ($pass_decode) {
        ?>
        <script>
            alert("Login Successfull");
            location.replace("home.php");
        </script>
        <?php
        }
        else {
        ?>
        <script>
            alert("Password Incorrect!");
        </script>
        <?php
        }
    }
    else {
        ?>
        <script>
            alert("Invalid Email!");
        </script>
        <?php
    }
}

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-6 login-box my-5 ">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    LOGIN FORM
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" name="submit"
                                        class="btn btn-outline-primary mx-auto d-block">LOGIN NOW</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>
            <div class="col-lg-3 col-md-3"></div>

        </div>

</body>

</html>