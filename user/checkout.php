<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    $total_items = 0;
    $total = 0;
    $uid =  $_SESSION['uid'];
    if(isset($_POST['checkout'])) {
        $line1 = $_POST['line1'];
        $line2 = $_POST['line2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $cart = $conn->query("SELECT * FROM cart WHERE user_id = '$uid'");
        
        // generate order code
        $code = uniqid('', true);
        $ordercode = substr($code, strlen($code) - 4, strlen($code));

        while($detail = $cart->fetch_assoc()) {
            $id = $detail['id'];
            $book_id = $detail['book_id'];
            $qty = $detail['qty'];
            $today = date("Y-m-d");
            // update book count
            $books = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
            $detail = $books->fetch_assoc();
            $new_count = $detail['count'] - $qty;
            $update = $conn->query("UPDATE books SET count = '$new_count' WHERE id = '$book_id'");

            //add to history
            $sql = "INSERT INTO orderhistory VALUES ('','$uid','$book_id','$qty','$today')";
            $result = $conn->query($sql);
            $last_id = $conn->insert_id;

            // shipping
            $sql = "INSERT INTO shipping VALUES ('','$uid','$last_id','$ordercode','$line1','$line2','$city','$state')";
            $result = $conn->query($sql);

            // remove from cart
            $delete = $conn->query("DELETE FROM cart WHERE id = '$id'");
        }
        header('location: /thank-you/'.$ordercode);
    }
    $cart = $conn->query("SELECT * FROM cart WHERE user_id = '$uid'");
    $user = $conn->query("SELECT * FROM user WHERE id = '$uid'");
    $userdetail = $user->fetch_assoc();
    while($row = $cart->fetch_assoc() ) {
        $book_id = $row['book_id'];
        $total_items = $total_items + $row['qty'];
        $book = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
        $bookdetail = $book->fetch_assoc();
        $total = $total + ($row['qty'] * $bookdetail['cost']);
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
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="container cart-container">
        <?php if($msg) { ?>
            <div class="alert alert-success">
                <?php echo $msg ?>
            </div>
        <?php } ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-lg product-card">
                        <div class="card-body">
                            <h4>Shipping Details</h4> <br>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" value="<?php echo $userdetail['name'] ?>" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $userdetail['email'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="number">Contact</label>
                                    <input type="number" class="form-control" value="<?php echo $userdetail['number'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="card">Card</label>
                                    <input type="number" class="form-control" id="card" oninput="cardVerify(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="cvv">CVV</label>
                                    <input type="number" class="form-control" id="cvv" oninput="cvvVerify(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group">
                                <label for="line1">Address Line 1</label>
                                <input type="text" name="line1" id="line1" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="line2">Address Line 2 (optional)</label>
                                <input type="text" name="line2" id="line2" class="form-control">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="contry">Country</label>
                                    <select name="" id="" disabled="disabled" class="form-control">
                                        <option value="">US</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="zip">Zip Code/Postal Code</label>
                                    <input type="number" name="zip" id="zip" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg product-card">
                        <div class="card-body">
                            <h5>Order Summery</h5>
                            <br>
                            <div class="row">
                                <div class="col">
                                    Subtotal (<?php echo $total_items ?> items)
                                </div>
                                <div class="col-3" style="text-align:right">
                                    $<?php echo number_format((float)$total, 2, '.', ''); ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    Shipping + Handling
                                </div>
                                <div class="col-3" style="text-align:right">
                                    $10.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Sales Tax
                                </div>
                                <div class="col-3" style="text-align:right">
                                    $5.00
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <b>Total</b>
                                </div>
                                <div class="col" style="text-align:right">
                                    <b>$<?php
                                        $total = $total + 10 + 5;
                                        echo number_format((float)$total, 2, '.', '');
                                    ?> </b>
                                </div>
                            </div>
                            <hr>
                            <img src="https://www.investopedia.com/thmb/1IVupa7WPkyjIVLKezgBowB52DM=/800x450/filters:fill(auto,1)/full-color-800x450-cee226a48bed4177b90351075b332227.jpg" 
                                style="width:70px">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/1200px-Mastercard_2019_logo.svg.png" 
                                style="width:70px">
                            <img src="data:image/png;base64,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" 
                                style="width:70px">
                            <img src="data:image/png;base64,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" 
                                style="width:70px">
                            <br> <br>
                            <button class="btn btn-primary cstmbtn" name="checkout">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
<style>
    .cart-container {
        padding: 20px;
        min-height: calc(100vh - 150px);
    }
    .product-card {
        background:whitesmoke;
        border-radius: 20px;
        margin-bottom: 10px;
    }
    .col-1 {
        text-align: center;
    }
    .qty {
        width: 30%;
        border-radius: 5px;
        text-align: center;
    }
    .cstmbtn {
        width: 100%;
    }
    @media screen {
        .qty-controller {
            margin-top: 10px;
            text-align: center;
        }
    }
    
    .nav-link {
        color: black !important
    }
</style>

<script>
    var cardinfo = null
    var cardcvv = null
    function cardVerify(cardnumber) {
        if(cardnumber.length <= 16) {
            cardinfo = cardnumber
        } else {
            $('#card').val(cardinfo)
        }
    }
    function cvvVerify(cvv) {
        if(cvv.length <= 3) {
            cardcvv = cvv
        } else {
            $('#cvv').val(cardcvv)
        }
    }
</script>