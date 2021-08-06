<?php
    include 'includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    $id =  $_GET['id'];
    $books = $conn->query("SELECT * FROM books WHERE id = '$id'");
    $detail = $books->fetch_assoc();
    if(isset($_POST['addCart'])) {
        $qty = $_POST['qty'];
        if($_SESSION['role']) {
            if($_SESSION['role'] == 'admin') {
                $err = 'Login through user to buy book!';
            } else {
                $uid = $_SESSION['uid'];
                // check if book is in cart
                $check = $conn->query("SELECT * FROM cart WHERE user_id = '$uid' AND book_id = '$id'");
                if($check->num_rows) {
                    $data = $check->fetch_assoc();
                    $qty = $qty + $data['qty'];
                    $cart_id = $data['id'];
                    $query = "UPDATE cart SET qty = '$qty' WHERE id = '$cart_id'";
                    $result = $conn->query($query);
                    $msg = 'Product Added to Cart!';
                } else {
                    $query = "INSERT INTO cart VALUES ('','$uid','$id','$qty')";
                    $result = $conn->query($query);
                    $msg = 'Product Added to Cart!';
                }
            }
        } else {
            $_SESSION['info'] = 'Login to continue shopping!';
            header('Location: /auth/login');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>
<body>
    <?php include 'includes/header.php' ?>
    <div class="container product-container">
        <?php if($msg){ ?>
            <div class="alert alert-success">
                <?php echo $msg ?>
            </div>
        <?php } ?>
        <?php if($err){ ?>
            <div class="alert alert-danger">
                <?php echo $err ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-5" style="text-align:center">
                <img src="/assets/images/books/<?php echo $detail['image'] ?>" style="width:95%">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h3><?php echo nl2br($detail['title']) ?></h3>
                    <h5><?php echo $detail['author'] ?> . <small><?php echo $detail['publishyear'] ?></small></h5>
                    ISBN: <?php echo $detail['isbn'] ?>
                    <p class="product-description">
                        <?php echo nl2br($detail['descpt']) ?>
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Available: <b><?php echo $detail['count'] ?></b>
                            <span style="float:right"><b>$<?php echo $detail['cost'] ?></b></span>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col">
                                        <select name="qty" id="qty" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-success" name="addCart" style="float:right">Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>

<style>
    .product-container {
        margin-top: 50px;
        padding: 20px;
        min-height: calc(100vh - 200px);
    }
    .product-container .card {
        background-color: whitesmoke;
        padding: 20px
    }
    .product-container .col-md-7 {
        padding-top: 20px
    }
    .product-description {
        margin-top: 20px;
    }
    .col-md-6 {
        margin-top: 10px
    }
</style>