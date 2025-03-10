<?php 
require_once('conn.php');

if (isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_POST['username']) && isset($_POST['contact']) && isset($_POST['email']) && isset($_POST['role'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if username or email already exists
    $query_check = "SELECT * FROM `admin` WHERE admin_username = '$username' OR admin_email = '$email'";
    $result_check = mysqli_query($conn, $query_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo " ";
    } else {
        // Insert data into database using prepared statement for security
        $query = "INSERT INTO `admin` (admin_username, admin_password, admin_contact, admin_email, role) 
                  VALUES ('$username','$password','$contact','$email','$role')";
        $result = mysqli_query($conn, $query);
       

        if ($result) {
            // Redirect after successful submission to avoid multiple form submissions
           echo '<script>window.location.href="index.php"</script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container-fluid" id="admin_form" style="display:none;">
<form action="index.php"  method="post">
     <h1 class="d-flex justify-content-center align-items-center fw-bold">Add Admin</h1>
    <label style="font-weight:bold; font-size:15px;">User name</label>
    <input type="text" id="username" name="username" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">Password</label>
    <input type="password" id="password" name="password" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">Contact</label>
    <input type="tel" id="contact" name="contact" class="form-control" required>
    <label style="font-weight:bold; font-size:15px; margin-top:2px;">Email</label>
    <input type="email" id="email" name="email" class="form-control" required>
    
    <div>
        <label class="mt-2">Role</label> 
        <select class="form-control" name="role">
            <option value='active'>Select role</option>
            <option value='Admin'>Admin</option>
            <option value='Subadmin'>Sub admin</option>
            <option value='User'>User</option>
        </select>   
    </div>
    
    <h1 style="font-size:25px; font-weight:bold; margin-top:10px;">Permissions for Admin</h1>
    
    <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="permission_slider" id="checkbox1">
        <label class="form-check-label" for="checkbox1" style="font-size:15px;">
            Do you allow admin to add Slider
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="permission_news" id="checkbox2">
        <label class="form-check-label" for="checkbox2" style="font-size:15px;">
            Do you allow admin to add news
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="permission_marquee" id="checkbox3" checked>
        <label class="form-check-label" for="checkbox3" style="font-size:15px;">
            Do you allow admin to add marquee
        </label>
    </div>

    <button type="submit" class="btn btn-success mt-3" id="sliderBtn" name="submit" value="sub">Add Sub Admin</button>
</form>
</div>

<script>
// Disable submit button after click to prevent multiple submissions
document.getElementById("admin_form").addEventListener("submit", function() {
    document.getElementById("sliderBtn").disabled = true;
});
</script>
