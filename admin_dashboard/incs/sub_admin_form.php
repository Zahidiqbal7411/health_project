<?php 
require_once('conn.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['role']) ){

$username=$_POST['username'];
$password=$_POST['password'];
$contact=$_POST['contact'];
$email=$_POST['email'];
$role=$_POST['role'];

$query_check = "SELECT * FROM `admin` WHERE admin_username = '$username' OR admin_email = '$email'";
$result_check = mysqli_query($conn, $query_check);
if (mysqli_num_rows($result_check) > 0) {
    echo "";
} else {
    $query = "INSERT INTO `admin` (admin_username, admin_password, admin_contact, admin_email, role) 
              VALUES ('$username', '$password', '$contact', '$email', '$role')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      echo '<script>window.location.href="index.php"</script>';
    }
    else{
      echo "not added";
    }
}
}

?> 

<form action="" id="sub_admin_form" method="post" style="display:none !important">
     <h1 class="d-flex justify-content-center align-items-center fw-bold" >Add sub admin</h1>
    <label style="font-weight:bold; font-size:15px;">User name</label>
    <input  type="text" id="username" name="username" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">Password </label>
    <input  type="password" id="username" name="password" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">contact</label>
    <input  type="tel" id="username" name="contact" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">email</label>
    <input  type="email" id="email" name="email" class="form-control" required>
    
    <div >
    <label class="mt-2">Role</label> 
    <select class="form-control" name="role">
    <option>Select role</option>
    <option value="Admin">admin</option>
    <option value="Subadmin">sub admin</option>
    <option value="User">user</option>
    </select>   
  </div>
  <h1  style="font-size:25px; font-weight:bold; margin-top:10px;"> Permissions for Sub-admin</h1>
  
    <div class="form-check mt-2">
      <input class="form-check-input" type="checkbox" value="" id="checkbox1">
      <label class="form-check-label" for="checkbox1" style="font-size:15px;">
        Do you allow sub-admin to read Slider
      </label>
    </div>
    
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="checkbox2" >
      <label class="form-check-label" for="checkbox2" style="font-size:15px;">
      Do you allow sub-admin to read news 
      </label>
    </div>
    
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="checkbox3" checked>
      <label class="form-check-label" for="checkbox3" style="font-size:15px;">
      Do you allow sub-admin to read marquee
      </label>
    </div>
 


    <button type="submit" class="btn btn-success mt-3" id="sliderBtn" name="submit" value="sub" >Add sub admin</button>
</form>

