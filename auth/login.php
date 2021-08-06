<?php 
    include '../includes/dbconnect.php';
    session_start();
    $php_errormsg = $email = null;
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check = "SELECT * FROM user WHERE email = '$email'";
        $exists = $conn -> query($check);
        if($exists->num_rows) {
            $pwd = md5($password);
            $query = "SELECT * FROM user WHERE email = '$email' AND password = '$pwd'";
            $result = $conn -> query($query);
            if($result->num_rows) {
                $data = $result->fetch_assoc();
                $_SESSION['role'] = $data['role'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['uid'] = $data['id'];
                if($data['role'] == 'admin') {
                    header('Location: ../admin/dashboard');
                } else {
                    header('Location: ../');
                }
            } else {
                $php_errormsg = 'Password does not match!';
            }
        } else {
            $php_errormsg = 'Email does not exist!';
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
    <title>A4R BookStore | Login</title>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="container">
    <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message'] ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php } ?>
        <?php if(isset($_SESSION['info'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_SESSION['info'] ?>
                <?php unset($_SESSION['info']); ?>
            </div>
        <?php } ?>
        <?php if($php_errormsg) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $php_errormsg ?>
            </div>
        <?php } ?>
        <div class="login-div">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email Address <span style="color:red">*</span></label>
                    <input type="email" name="email" id="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password <span style="color:red">*</span></label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <button class="btn btn-success" style="width:100%" name="login">Sign In</button>
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