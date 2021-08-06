<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    function slugify($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    if(isset($_POST['addbook'])) {
        $title = str_replace("'","&#39;",$_POST['title']);
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $count = $_POST['count'];
        $cost = $_POST['cost'];
        $descpt = str_replace("'","&#39;",$_POST['descpt']);
        $descpt = str_replace('"','&#34;',$descpt);
        $publish = $_POST['publishyear'];
        $target_dir = '../assets/images/books/';
        ;
        $upload = 1;

        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload = 0;
        }

        if($upload == 1) {
            $slug = slugify($title);
            $filename = uniqid() . '.' . $imageFileType;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $filename)) {
                $query = "INSERT INTO books VALUES ('','$slug','$title','$author','$isbn','$publish','$count','$cost','$filename','$descpt')";
                $result = $conn->query($query);

                $msg = 'New Book Record Added!!';
            } else {
                $err = "Sorry, image not uploaded.";
            }
        }
    }
    if(isset($_POST['updatebook'])) {
        $id = $_POST['book_id'];
        $title = str_replace("'","&#39;",$_POST['title']);
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $count = $_POST['count'];
        $cost = $_POST['cost'];
        $descpt = str_replace("'","&#39;",$_POST['descpt']);
        $descpt = str_replace('"','&#34;',$descpt);
        $slug = slugify($title);
        $publish = $_POST['publishyear'];
        if($_FILES["image"]["name"]) {
            $target_dir = '../assets/images/books/';
            $upload = 1;
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $upload = 0;
            }
            if($upload == 1) {
                
                $filename = uniqid() . '.' . $imageFileType;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $filename)) {
                    // delete old file
                    $ext = $conn->query("SELECT * FROM books WHERE id = '$id'");
                    $row = $ext->fetch_assoc();
                    unlink($target_dir . $row['image']);
                    $query = "UPDATE books SET slug = '$slug', title = '$title', author = '$author', isbn = '$isbn', publishyear = '$publish', count = '$count', cost = '$cost', image = '$filename', descpt = '$descpt' WHERE id = '$id'";
                    $result = $conn->query($query);
                    $msg = 'Book Record Updated!!';
                } else {
                    $err = "Sorry, image not uploaded.";
                }
            }
        } else  {
            $query = "UPDATE books SET  slug = '$slug', title = '$title', author = '$author', isbn = '$isbn', publishyear = '$publish', count = '$count', cost = '$cost', descpt = '$descpt' WHERE id = '$id'";
            $result = $conn->query($query);
            $msg = 'Book Record Updated!!';
        }
    }
    if(isset($_POST['delete'])) {
        $id = $_POST['book_id'];
        
        $query = "DELETE FROM books WHERE id = '$id'";
        $result = $conn->query($query);
        $msg = 'Book Record Deleted!!';
    }
    $query = "SELECT * FROM books";
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
    <title>Book List</title>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php include 'includes/sidebar.php' ?>
        </div>
        <div id="body-content-wrapper" class="home-section">
            <div class="text">Book List</div>
            <hr>
            <div class="container-fluid home-container">
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
                <div class="card">
                    <div class="card-body" style='overflow-x:auto'>
                        <button type="button" data-toggle="modal" data-target="#addModel"
                            style="float:right;margin-bottom: 20px" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Add New</button>
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Publish Year</th>
                                <th>Count</th>
                                <th>Cost</th>
                                <th style="width:30%">Description</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) :
                                ?>
                                <tr>
                                    <td>
                                        <center>
                                        <?php if($row['image']) {?>
                                        <img src="../assets/images/books/<?php echo $row['image'] ?>" style="width:100px">
                                        <?php } else { echo '#'; } ?>
                                        </center>
                                    </td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['author'] ?></td>
                                    <td><?php echo $row['isbn'] ?></td>
                                    <td><?php echo $row['publishyear'] ?></td>
                                    <td><?php echo $row['count'] ?></td>
                                    <td><?php echo $row['cost'] ?></td>
                                    <td><?php echo substr($row['descpt'],0,200) . '....'; ?></td>
                                    <td>
                                    
                                        <a type="button" data-toggle="modal" data-target="#editModel" class="edit-button" 
                                            data-id="<?php echo $row['id'] ?>" data-title="<?php echo $row['title'] ?>" 
                                            data-author="<?php echo $row['author'] ?>" data-isbn="<?php echo $row['isbn'] ?>" 
                                            data-count="<?php echo $row['count'] ?>" data-cost="<?php echo $row['cost'] ?>"
                                            data-image="<?php echo $row['image'] ?>" data-descpt="<?php echo $row['descpt'] ?>"
                                            data-year="<?php echo $row['publishyear'] ?>">
                                            <i class="fas fa-edit"></i></a>
                                        <a type="button" data-toggle="modal" data-target="#deleteModel" class="delete-button" 
                                            data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
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
                    <input type="hidden" name="book_id" id="book_id" value="">
                    <button class="btn btn-danger" name="delete">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- add book -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="addModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">Book Title <span style="color:red">*</span></label>
                            <input type="text" name="title" id="title" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="author">Author <span style="color:red">*</span></label>
                            <input type="text" name="author" id="author" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="isbn">ISBN <span style="color:red">*</span></label>
                            <input type="text" name="isbn" id="isbn" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="publishyear">Publish Year <span style="color:red">*</span></label>
                            <input type="number" name="publishyear" id="publishyear" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="count">Total Number of Book <span style="color:red">*</span></label>
                            <input type="number" name="count" id="count" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cost">Cost <span style="color:red">*</span></label>
                            <input type="number" name="cost" id="cost" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image <span style="color:red">*</span></label>
                        <input type="file" name="image" id="image" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descpt">Description <span style="color:red">*</span></label>
                        <textarea name="descpt" id="descpt" cols="30" rows="10" required class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="addbook">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit book -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body edit-model">
                    <input type="hidden" name="book_id" id="book_id" value="">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">Book Title <span style="color:red">*</span></label>
                            <input type="text" name="title" id="title" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="author">Author <span style="color:red">*</span></label>
                            <input type="text" name="author" id="author" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="isbn">ISBN <span style="color:red">*</span></label>
                            <input type="text" name="isbn" id="isbn" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="publishyear">Publish Year <span style="color:red">*</span></label>
                            <input type="number" name="publishyear" id="publishyear" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="count">Total Number of Book <span style="color:red">*</span></label>
                            <input type="number" name="count" id="count" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cost">Cost <span style="color:red">*</span></label>
                            <input type="number" name="cost" id="cost" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image <span style="color:red">*</span></label>
                        <input type="file" name="image" id="image" class="form-control">
                        <div id="img-preview"></div>
                    </div>
                    <div class="form-group">
                        <label for="descpt">Description <span style="color:red">*</span></label>
                        <textarea name="descpt" id="descpt" cols="30" rows="10" required class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="updatebook">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
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
        $('.delete-model #book_id').val(id)
    })
    $('.edit-button').click(function() {
        $('.edit-model #book_id').val($(this).data('id'))
        $('.edit-model #title').val($(this).data('title'))
        $('.edit-model #author').val($(this).data('author'))
        $('.edit-model #isbn').val($(this).data('isbn'))
        $('.edit-model #count').val($(this).data('count'))
        $('.edit-model #cost').val($(this).data('cost'))
        $('.edit-model #descpt').val($(this).data('descpt'))
        $('.edit-model #publishyear').val($(this).data('year'))
        $('.edit-model #img-preview').html('<img src="../assets/images/books/'+ $(this).data('image') + '" style="width:200px"?>')
    })
</script>