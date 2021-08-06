<?php 
    include '../includes/dbconnect.php';
    $php_errormsg = $name = $email = $number = null;
    if(isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if(strcmp($password,$cpassword)) {
            $php_errormsg = 'Password does not match!';
        } else {
            // check if email exists
            $check = "SELECT * FROM user WHERE email = '$email'";
            $exists = $conn -> query($check);
            if($exists-> num_rows) {
                $php_errormsg = 'Email already exists!';
            } else {
                $pwd = md5($password);
                $query = "INSERT INTO user VALUES ('','user','$name','$email','$number','$pwd')";
                $result = $conn -> query($query);
                $last_id = $conn->insert_id;
                $exec = $conn->query("INSERT INTO shipping VALUES ('','$last_id','','','','','')");
                session_start();
                $_SESSION['message'] = 'User registered! Login to continue!';
                header('Location: /auth/login');
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>A4R BookStore | Register</title>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="container">
        <?php
            if($php_errormsg) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $php_errormsg ?>
            </div>
        <?php
            }
        ?>
        <div class="register-div">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name <span style="color:red">*</span></label>
                    <input type="text" name="name" id="name" required value="<?php if($name) { echo $name; } ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email Address <span style="color:red">*</span></label>
                    <input type="email" name="email" id="email" required value="<?php if($email) { echo $email; } ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="number">Contact Number <span style="color:red">*</span></label>
                    <input type="number" name="number" id="number" required value="<?php if($number) { echo $number; } ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password <span style="color:red">*</span></label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password <span style="color:red">*</span></label>
                    <input type="password" name="cpassword" id="cpassword" required class="form-control">
                </div>
                <button class="btn btn-success" style="width:100%" name="register">Register</button>
            </form>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>


<style>
    .nav-link {
        color: black !important
    }
</style>