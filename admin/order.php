<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = null;
    if(isset($_POST['refund'])) {
        $order_id = $_POST['order_id'];
        $book_id = $_POST['book_id'];

        $r1 = $conn->query("SELECT * FROM orderhistory WHERE id = '$order_id'");
        $order = $r1->fetch_assoc();
        
        // update book detail
        // $r2 = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
        // $book = $r2->fetch_assoc();
        // $qty = $book['count'] + $order['qty'];
        // $r3 = $conn->query("UPDATE books SET count = '$qty' WHERE id = '$book_id'");

        // delete order history
        $sql = "DELETE FROM orderhistory WHERE id = '$order_id'";
        $r4 = $conn->query($sql);
        $msg = $sql;
        // $msg = 'Order #' . $order_id . ' has been refunded';

    }
    $query = "SELECT * FROM orderhistory ORDER BY id DESC";
    $result = $conn->query($query);

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
    <title>Order History</title>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php include 'includes/sidebar.php' ?>
        </div>
        <div id="body-content-wrapper" class="home-section">
            <div class="text">Order History</div>
            <hr>
            <div class="container-fluid home-container">
                <?php if($msg) { ?>
                    <div class="alert alert-success">
                        <?php echo $msg ?>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-body" style='overflow-x:auto'>
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>User</th>
                                <th>Book Title</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) :
                                    $user_id = $row['user_id'];
                                    $book_id = $row['book_id'];
                                    $u = $conn->query("SELECT * FROM user WHERE id = '$user_id'");
                                    $user = $u->fetch_assoc();
                                    $b = $conn->query("SELECT * FROM books WHERE id = '$book_id'");
                                    $book = $b->fetch_assoc();
                                ?>
                                <tr>
                                    <td>
                                        <img src="../assets/images/books/<?php echo $book['image'] ?>" style="width:100px">
                                    </td>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $book['title'] ?></td>
                                    <td><?php echo $row['qty'] ?></td>
                                    <td>$<?php echo $book['cost'] ?></td>
                                    <td>
                                        $<?php
                                            $amt = $book['cost']*$row['qty'];
                                            echo number_format((float)$amt, 2, '.', '');
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#deleteModel" class="delete-button btn btn-danger" 
                                            data-id="<?php echo $row['id'] ?>" data-bookid="<?php echo $row['book_id'] ?>">
                                            Refund
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- delete model -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span style="color:red"><i class="fas fa-info-circle" aria-hidden="true"></i></span> Confirm Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are You Sure Want to Refund This Order?</p>
            </div>
            <div class="modal-footer delete-model">
                <form action="" method="post">
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="book_id" id="book_id" value="">
                    <button class="btn btn-success" name="refund">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

</html>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/dashboard.js"></script>

<script>
    $('.delete-button').click(function() {
        var id = $(this).data('id')
        $('.delete-model #order_id').val(id)
        $('.delete-model #book_id').val($(this).data('bookid'))
    })
</script>