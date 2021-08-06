<?php
    include '../includes/dbconnect.php';
    session_start();
    $msg = $err = null;
    if(isset($_POST['adduser'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $role = $_POST['role'];
        $password = md5($_POST['password']);

        $check = "SELECT * FROM user WHERE email = '$email'";
        $exists = $conn -> query($check);
        if($exists-> num_rows) {
            $err = 'Email already exists!';
        } else {
            $query = "INSERT INTO user VALUES ('','$role','$name','$email','$number','$password')";
            $result = $conn->query($query);
            $last_id = $conn->insert_id;
            $exec = $conn->query("INSERT INTO shipping VALUES ('','$last_id','','','','','')");
            $msg = 'New User Added!!';
        }
    }
    if(isset($_POST['updateuser'])) {
        $id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $role = $_POST['role'];
        if($_POST['password']) {
            $password = md5($_POST['password']);
            $query = "UPDATE user SET role = '$role', name = '$name', email = '$email', number = '$number', password = '$password' WHERE id = '$id'";
            $result = $conn->query($query);
            $msg = 'User detail updated!!';
        } else {
            $query = "UPDATE user SET role = '$role', name = '$name', email = '$email', number = '$number' WHERE id = '$id'";
            $result = $conn->query($query);
            $msg = 'User detail updated!!';
        }
    }
    if(isset($_POST['delete'])) {
        $id = $_POST['user_id'];
        
        $query = "DELETE FROM user WHERE id = '$id'";
        $result = $conn->query($query);

        $exec = $conn->query("DELETE FROM shipping WHERE user_id = '$id'");
        $msg = 'User Record Deleted!!';
    }
    $query = "SELECT * FROM user";
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
    <title>Users</title>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php include 'includes/sidebar.php' ?>
        </div>
        <div id="body-content-wrapper" class="home-section">
            <div class="text">User List</div>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) :
                                ?>
                                <tr>
                                    <td>#</td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['number'] ?></td>
                                    <td>
                                        <?php if($row['role'] == 'admin') { ?>
                                            <span class="badge badge-primary">ADMIN</span>
                                        <?php } else { ?>
                                            <span class="badge badge-info">USER</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a type="button" data-toggle="modal" data-target="#editModel" class="edit-button"
                                            data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"
                                            data-email="<?php echo $row['email'] ?>" data-number="<?php echo $row['number'] ?>"
                                            data-role="<?php echo $row['role'] ?>">
                                            <i class="fas fa-edit"></i> </a>
                                        <a type="button" data-toggle="modal" data-target="#deleteModel" class="delete-button" data-id="<?php echo $row['id'] ?>"><i
                                                class="fas fa-trash"></i></a>
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
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <button class="btn btn-danger" name="delete">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- add book -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="addModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">Email <span style="color:red">*</span></label>
                            <input type="email" name="email" id="email" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="number">Contact <span style="color:red">*</span></label>
                            <input type="number" name="number" id="number" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span style="color:red">*</span></label>
                        <input type="password" name="password" id="password" required class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="role">Role <span style="color:red">*</span></label>
                            <select name="role" id="role" required class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="adduser">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit user -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body edit-modal">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="name">Name <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">Email <span style="color:red">*</span></label>
                            <input type="email" name="email" id="email" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="number">Contact <span style="color:red">*</span></label>
                            <input type="number" name="number" id="number" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="role">Role <span style="color:red">*</span></label>
                            <select name="role" id="role" required class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="updateuser">Update</button>
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
        $('.delete-model #user_id').val(id)
    })
    $('.edit-button').click(function() {
        $('.edit-modal #user_id').val($(this).data('id'))
        $('.edit-modal #name').val($(this).data('name'))
        $('.edit-modal #email').val($(this).data('email'))
        $('.edit-modal #number').val($(this).data('number'))
        $('.edit-modal #role').val($(this).data('role'))
    })
</script>