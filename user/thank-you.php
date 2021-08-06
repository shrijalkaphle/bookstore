<?php
    include '../includes/dbconnect.php';
    session_start();
    $ordercode = $_GET['ordercode'];
    $total = 0;
    $line1 = $line2 = $city = $state = null;
    $ship = $conn->query("SELECT * FROM shipping WHERE ordercode = '$ordercode'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/a4r/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/a4r/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/a4r/assets/css/style.css">
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>

<body>
    <?php include '../includes/header.php' ?>
    <div class="container thankyou-container">
        <table class="table table-borderless">
            <tr class="heading">
                <td style="vertical-align: middle; text-align:center">
                    <h1 style="font-size: 36px; font-weight: 800; margin: 0;">A4R Bookstore</h1>
                </td>
            </tr>
        </table>
        <div class="table-div">
            <table class="table table-borderless">
                <tr>
                    <td colspan="2">
                        <div class="thankyouMessage">
                            <center><img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /></center>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
                        </div>
                    </td>
                </tr>
                <tr style="margin:50px">
                    <th width="75%" class="orderconfirmation"> Order Confirmation </th>
                    <th width="25%" class="orderconfirmation">#<?php echo $ordercode ?></th>
                </tr>
                <?php
                    while($data = $ship->fetch_assoc()) :
                        $line1 = $data['line1'];
                        $line2 = $data['line2'];
                        $city = $data['city'];
                        $state = $data['state'];
                        $order_id = $data['order_id'];
                        $odr = $conn->query("SELECT * FROM orderhistory WHERE id = '$order_id'");
                        $order = $odr->fetch_assoc();
                        $book_id = $order['book_id'];
                        $bk = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
                        $book = $bk->fetch_assoc();
                        $subtotal = $book['cost'] * $order['qty'];
                        $total = $total + $subtotal;
                ?>
                <tr>
                    <td width="75%"> <?php echo $book['title'] ?> (<?php echo $order['qty'] ?>) </td>
                    <td width="25%"> $<?php echo number_format((float)$subtotal, 2, '.', ''); ?></td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td width="75%"> Shipping + Handling </td>
                    <td width="25%"> $10.00 </td>
                </tr>
                <tr>
                    <td width="75%"> Sales Tax </td>
                    <td width="25%"> $5.00 </td>
                </tr>
                <tr class="totalpreview">
                    <th width="75%"> Total </th>
                    <th width="25%"> 
                        $<?php
                            $total = $total + 10 + 5;
                            echo number_format((float)$total, 2, '.', ''); 
                        ?>
                    </th>
                </tr>
            </table>
            <table class="table table-borderless">
                <tr>
                    <th>Delivery Address</th>
                    <th style="text-align:right">Estimated Delivery Date</th>
                </tr>
                <tr>
                    <td>
                        <?php echo $line1 ?> <br>
                        <?php 
                            if(!ctype_space($line2)) {
                                echo $line2 . '<br>';
                            }
                        ?>
                        <?php echo $city; ?>, <?php echo $state; ?> <br>
                    </td>
                    <td style="text-align:right">
                        <?php
                            $date = date("Y-m-d");
                            echo date('M j, Y', strtotime($date. ' + 3 days'));
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
</body>

</html>

<style>
.thankyou-container {
    margin: 50px auto;
    padding: 0;
    padding-bottom: 20px;
    width: 30%;
    min-height: calc(100vh - 150px);
    background-color: white !important;
}
.table-div {
    padding: 0 50px;
}

body {
    background-color: #EEEEEE;
}
.thankyouMessage {
    text-align: center;
    padding: 50px 0;
}
.heading {
    height: 100px;
    width:100%;
    background-color: red;
    color: white;
}
.orderconfirmation {
    font-family: Open Sans, Helvetica, Arial, sans-serif;
    font-size: 16px;
    font-weight: 800;
    line-height: 24px;
    padding: 10px;
    background: #eeeeee;
}
.totalpreview {
    border-top: 5px solid #eee;
    border-bottom: 5px solid #eee;
}
@media only screen and (max-width: 1080px) {
    .thankyou-container {
        width: 95%;
        margin: 20px auto;
    }
    .table-div {
        padding: 0 20px;
    }
}
</style>