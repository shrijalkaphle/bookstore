<?php
include '../includes/dbconnect.php';
session_start();
$book_count = 0;
$admin_count = 0;
$user_count = 0;
$book_sold = 0;
$user = $conn->query('SELECT * FROM user');
while($detail = $user->fetch_assoc()) {
    if($detail['role'] == 'admin') {
        $admin_count++;
    } else {
        $user_count++;
    }
}
$book = $conn->query('SELECT * FROM books');
while($detail = $book->fetch_assoc()) {
    $book_count = $book_count + $detail['count'];
}
$history = $conn->query('SELECT * FROM orderhistory');
while($detail = $history->fetch_assoc()) {
    $book_sold = $book_sold + $detail['qty'];
}
$user_result = $conn->query("SELECT * FROM user ORDER BY id DESC LIMIT 7");
$book_result = $conn->query("SELECT * FROM books ORDER BY id DESC LIMIT 7");
$order_result = $conn->query("SELECT * FROM orderhistory ORDER BY id DESC LIMIT 7");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php include 'includes/sidebar.php' ?>
        </div>
        <div id="body-content-wrapper" class="home-section">
            <div class="text">Dashboard</div>
            <hr>
            <div class="container-fluid home-container">
                <div class="status pt-2">
                    <div class="row align-items-stretch">
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Book Count</h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count"><?php echo $book_count ?></span>
                            </div>
                        </div>
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Book Sold</h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count"><?php echo $book_sold ?></span>
                            </div>
                        </div>
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Active User</h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count"><?php echo $user_count ?></span>
                            </div>
                        </div>
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Active Admin</h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count"><?php echo $admin_count ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row align-items-stretch">
                        <div class="col-lg-4">
                            <div class="card shadow-lg">
                                <div class="card-header"> Recent Added Book </div>
                                <div class="card-body" style="overflow: auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Count</th>
                                        </thead>
                                        <tbody>
                                            <?php while($book_detail = $book_result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $book_detail['title'] ?></td>
                                                <td><?php echo $book_detail['author'] ?></td>
                                                <td><?php echo $book_detail['count'] ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-lg">
                                <div class="card-header"> Recent User Registered </div>
                                <div class="card-body" style="overflow: auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </thead>
                                        <tbody>
                                            <?php while($user_detail = $user_result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $user_detail['name'] ?></td>
                                                <td><?php echo $user_detail['email'] ?></td>
                                                <td><i><?php echo $user_detail['role'] ?></i></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-lg">
                                <div class="card-header"> Recent Order </div>
                                <div class="card-body" style="overflow: auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>User Name</th>
                                            <th>Book Name</th>
                                            <th>Quantity</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                while($order_detail = $order_result->fetch_assoc()) :
                                                    $user_id = $order_detail['user_id'];
                                                    $user = $conn->query("SELECT * FROM user WHERE id = '$user_id'");
                                                    $data1 = $user->fetch_assoc();
                                                    $book_id = $order_detail['book_id'];
                                                    $book = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
                                                    $data2 = $book->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?php echo $data1['name'] ?></td>
                                                <td><?php echo $data2['title'] ?></td>
                                                <td><?php echo $order_detail['qty'] ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/js/dashboard.js"></script>