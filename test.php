<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="border rounded mt-5">
      <form action="action.php" method="POST">
        <div><h4 class=" text-center text-danger">LOG IN</h4></div>
        <label for="email"> Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
        <label for="password"> Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" required>
        <div class="mt-3 d-flex justify-content-center">
          <input type="submit" class=" btn btn-success" id="login" name="login" value="Log In">
        </div>
        <div class="d-flex">
          <a href="forgot-password.php">Forgot Password?</a>
          <div class="ml-auto">
            <span class="text-muted">No Account?</span>
            <a href="#" > Register here</a>
          </div>
        </div>
      </form>
    </div>

    <div class="border rounded mt-5">
      <form action="action.php" method="POST">
        <div><h4 class=" text-center text-danger">REGISTRATION</h4></div>
        <label for="name"> Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
        <label for="email"> Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
        <label for="password"> Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" required>
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="user_confirm_password" name="user_confirm_password" required>
        <div class="mt-3 d-flex justify-content-center">
          <input type="submit" class=" btn btn-success" id="register" name="register" value="Register">
        </div>
        <div class="d-flex">
          <p>Have an account?</p>
          <a href="#"  class="">Back to home</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>