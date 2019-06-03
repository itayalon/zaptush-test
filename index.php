<?php
$error ='';
$success ='';
if( isset($_POST['submit']) ){
    // grabbing of input and trimming
    $username = !empty($_POST['username']) ? trim($_POST['username']) : '';
    $password = !empty($_POST['password']) ? trim($_POST['password']) : '';
    // simplest validation the world has ever seen
    if( !$username || !$password ) {
        $error = "Please fill in the required details";
    }
    // sending details to db
    else {
        $link = mysqli_connect('localhost', 'root', '', 'zaptush');
        mysqli_query($link, "SET NAMES utf8");
        $username = mysqli_real_escape_string($link, $username);
        $password = mysqli_real_escape_string($link, $password);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($link, $sql);
            
        // handling db response
        if ($result && mysqli_num_rows($result) == 1) {
            $success = "User does exist";
        }
        else {
            $error = '* User does not exist';
        } 
    }
       
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>zaptush test</title>
  </head>
  <body>
      <div class="container-fluid d-flex">
        <form class="mx-auto bg-light p-5"action="" method="POST"  novalidate="novalidate">
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <input type="submit" name="submit" value="Check User" class="btn btn-outline-primary">
            <?php if( $error ): ?>
                <div class="alert alert-danger mt-3"><?= $error; ?></div>
            <?php endif; ?>
            <?php if( $success ): ?>
                <div class="success alert-success mt-3"><?= $success; ?></div>
            <?php endif; ?>
        </form>
      </div>
  </body>
</html>
