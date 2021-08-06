<?php
    $query = $_POST['search'];
    include 'includes/dbconnect.php';
    session_start();
    if(isset($_POST['addCart'])) {
        $qty = 1;
        $id = $_POST['book_id'];
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
            header('Location: auth/login');
        }
    }
    $searchtext = '%'.$query.'%';
    $sql = "SELECT * FROM books WHERE title LIKE '$searchtext' OR author LIKE '$searchtext' OR isbn LIKE '$searchtext'";
    $books = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>
<body>
    <?php include 'includes/header.php' ?>
    <div class="header">
        <div class="bg-image"></div>
        <div class="bg-text">
            <h2>A4R Online Bookstore</h2>
            <p>Dear readers, enjoy the collection of thousands of books, the more you read, the more you learn.</p>
            <div class="search-div">
                <form action="search" method="post" id="search-form">
                    <input type="search" name="search" id="search" class="search-input" placeholder="Search" value="<?php echo $query ?>">
                </form>
            </div>
        </div>
    </div>
    <div class="container body-container">
        <div class="row">
            <?php
                if(!$books->num_rows) {
                    echo '<h4>No Result Found!</h4>';
                }
            ?>
            <?php while($data = $books->fetch_assoc()) : ?>
            <div class="col-md-3 book-card">
                <div class="card">
                    <div class="view overlay">
                        <img class="img-fluid w-100" src="assets/images/books/<?php echo $data['image'] ?>" alt="Sample">
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5 style="height:3em"><?php echo nl2br($data['title']) ?></h5>
                        <p class="small text-muted text-uppercase mb-2"><?php echo $data['publishyear'] ?></p>
                        <h6 class="mb-3"><span class="text-danger mr-1">$<?php echo $data['cost'] ?></span></h6>
                        <form action="" method="post">
                            <input type="hidden" name="book_id" value="<?php echo $data['id'] ?>">
                        <button class="btn btn-primary btn-sm mr-1 mb-2" name="addCart">
                            <i class="fas fa-shopping-cart pr-2"></i>Add to cart
                        </button>
                        <a type="button" class="btn btn-light btn-sm mr-1 mb-2" href="book/<?php echo $data['slug'] ?>/<?php echo $data['id'] ?>">
                            <i class="fas fa-info-circle pr-2"></i>Details
                        </a>
                        </form>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>

<style>
    .body-container {
        padding:20px;
        min-height: 25vh
    }
</style>

<script>
    $(document).ready(function() {
    $('input').keyup(function(event) {
        if (event.which === 13)
        {
            event.preventDefault();
            $('#search-form').submit();
        }
    });
});
</script>