<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    $total_items = 0;
    $total = 0;
    $uid =  $_SESSION['uid'];
    if(isset($_POST['updatecart'])) {
        $id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        $result = $conn->query("UPDATE cart SET qty = '$qty' WHERE id = '$id'");
        $msg = 'Product updated in cart!!';
    }
    if(isset($_POST['delete'])) {
        $id = $_POST['cart_id'];
        
        $query = "DELETE FROM cart WHERE id = '$id'";
        $result = $conn->query($query);
        $msg = 'Product removed from cart!!';
    }
    if(isset($_POST['checkout'])) {
        header('location: checkout');
    }
    $cart = $conn->query("SELECT * FROM cart WHERE user_id = '$uid'");
    
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
        <div class="row">
            <div class="col-md-8">
                <?php 
                    while($detail = $cart->fetch_assoc()):
                        $total_items = $total_items + $detail['qty'];
                        $book_id = $detail['book_id'];
                        $book = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
                        $data = $book->fetch_assoc();
                        
                        $total = $total + ($detail['qty'] * $data['cost']);
                ?>
                <div class="card shadow-lg product-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="../assets/images/books/<?php echo $data['image'] ?>" style="width:100px">
                                            </div>
                                            <div class="col" style="padding-top:10px">
                                                <b><?php echo $data['title'] ?></b> <br>
                                                <small><?php echo $data['author'] ?></small>
                                                <br>
                                                <span style="color:red">$<?php echo $data['cost'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 qty-controller">
                                        <form action="" method="post">
                                            <input type="hidden" name="cart_id" value="<?php echo $detail['id'] ?>">
                                            <input type="number" name="qty" id="qty" value="<?php echo $detail['qty'] ?>" class="qty">
                                            <button class="btn btn-success" name="updatecart"><i class="fas fa-sync"></i></button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <a type="button" data-toggle="modal" data-target="#deleteModel" class="delete-button" data-id="<?php echo $detail['id'] ?>"><i
                                    class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
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
                            <div class="col" style="text-align:right">
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
                        <br>
                        <form action="" method="post">
                            <button class="btn btn-primary cstmbtn" name="checkout">Proceed to Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
<!-- delete model -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span style="color:red"><i class="fas fa-info-circle" aria-hidden="true"></i></span> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are You Sure Want to Delete?</p>
            </div>
            <div class="modal-footer delete-model">
                <form action="" method="post">
                    <input type="hidden" name="cart_id" id="cart_id" value="">
                    <button class="btn btn-danger" name="delete">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

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
    .nav-link {
        color: black !important
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
</style>
<script>
    $('.delete-button').click(function() {
        var id = $(this).data('id')
        $('.delete-model #cart_id').val(id)
    })
</script>