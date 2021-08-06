<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    $uid =  $_SESSION['uid'];
    if(isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];

        if($_POST['password']) {
            if(strcmp($_POST['password'],$_POST['cpassword'])) {
                $err = 'Password did not match!!';
            } else {
                $password = md5($_POST['password']);
                $sql = "UPDATE user SET name = '$name', email = '$email', number = '$number', password = '$password' WHERE id = '$uid'";
                $result = $conn->query($sql);
                $msg = 'User detail updated!!';
            }
        } else {
            $sql = "UPDATE user SET name = '$name', email = '$email', number = '$number' WHERE id = '$uid'";
            $result = $conn->query($sql);
            $msg = 'User detail updated!!';
        }
    }
    $user = $conn->query("SELECT * FROM user WHERE id = '$uid'");
    $detail = $user->fetch_assoc();
    
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
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>

<body>
    <?php include '../includes/header.php' ?>
    <div class="container profile-container">
        <?php if($msg) { ?>
        <div class="alert alert-success">
            <?php echo $msg ?>
        </div>
        <?php } ?>
        <?php if($err) { ?>
        <div class="alert alert-danger">
            <?php echo $err ?>
        </div>
        <?php } ?>
        <div class="card shadow-lg profile-card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" required value="<?php echo $detail['name'] ?>" id="name"
                            class="form-control">
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" required id="email" value="<?php echo $detail['email'] ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="number">Contact</label>
                            <input type="number" name="number" required id="number"
                                value="<?php echo $detail['number'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" disabled>
                                <option value="user" <?php if($detail['role'] == 'user') {  echo 'selected'; } ?>>User
                                </option>
                                <option value="admin" <?php if($detail['role'] == 'admin') {  echo 'selected'; } ?>>
                                    Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" id="cpassword" class="form-control">
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-primary" name="update">Update</button>
                    </center>
                </form>
            </div>
        </div>
        <div class="card shadow-lg profile-card">
            <div class="card-header">
                <h4>Order History</h4>
            </div>
            <div class="card-body" style='overflow-x:auto'>
                <table class="table">
                    <thead>
                        <th></th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Qty</th>
                        <th>Cost</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php
                            $history = $conn->query("SELECT * FROM orderhistory WHERE user_id = '$uid'");
                            while($data = $history->fetch_assoc()):
                                $book_id = $data['book_id'];
                                $book_result = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
                                $book = $book_result->fetch_assoc();
                        ?>
                        <tr>
                            <td>
                                <img src="../assets/images/books/<?php echo $book['image'] ?>" style="width:100px">
                            </td>
                            <td><?php echo $book['title'] ?></td>
                            <td><?php echo $book['author'] ?></td>
                            <td><?php echo $data['qty'] ?></td>
                            <td>
                                $<?php
                                    $amt = $book['cost']*$data['qty'];
                                    echo number_format((float)$amt, 2, '.', '') . '($' . $book['cost'] . 'x' . $data['qty'] . ')' 
                                ?>
                            </td>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($data['date'])) ?></td>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
</body>

</html>

<style>
.profile-container {
    padding: 20px;
    min-height: calc(100vh - 150px);
}

.profile-card {
    background: whitesmoke;
    border-radius: 20px;
    margin-bottom: 10px;
}
</style>