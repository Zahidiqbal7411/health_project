<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admin_form" method="post" >
     <h1 class="d-flex justify-content-center align-items-center fw-bold" >User registration</h1>
    <label style="font-weight:bold; font-size:15px;">User name</label>
    <input  type="text" id="username" name="username" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">Password </label>
    <input  type="password" id="username" name="password" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">contact</label>
    <input  type="tel" id="username" name="contact" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">email</label>
    <input  type="email" id="email" name="email" class="form-control" required>
    
    
  



    <button type="submit" class="btn btn-success mt-3 " id="sliderBtn" name="user_login" value="sub" style="display:flex; justify-content-center">Register</button>
</form>
</div>
<?php 
require_once('conn.php');
    if(isset($_POST['user_login']) && $_POST['user_login'] == 'sub'){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    
    $sql = "INSERT INTO `users` (username, pass, contact, email) VALUES ('$username','$password','$contact', '$email')";
    }
    
    ?>
