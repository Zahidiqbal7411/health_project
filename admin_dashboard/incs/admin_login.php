<link href="../css/admin.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<?php 
require_once('conn.php');
session_start();

if (isset($_POST['submit']) && $_POST['submit'] == 'sub')
 {
    $username=$_POST['u_name'];
    $password=$_POST['password'];
    $query="SELECT * FROM `admin` where admin_username='$username' AND admin_password='$password'";
    $result=mysqli_query($conn,$query);
    $total_records=mysqli_num_rows($result);
    $admin = mysqli_fetch_assoc($result);
    
    if ($total_records == 0) {
        echo "not done the login ";
        header("location:admin_login.php?");
       
        exit;
        
    }
    
    
    if($total_records>0){
      
    $_SESSION['admin_id'] = $admin['admin_id'];  
    $_SESSION['admin_username'] = $admin['admin_username'];
    $_SESSION['admin_password'] = $admin['admin_password'];
    $_SESSION['role'] = $admin['role'];
    header("Location: index.php");
    exit;
}
    

}

?>
<div class="container">

    <form action="" method="post" class="admin_form">
        <h1 class="admin_header">Student Admin Login</h1>
        <label for="username" class="admin_label">Username:</label>
        <input type="text" class="form-control admin_username" id="username" name="u_name" placeholder="Enter username"
            required>

        <label for="password" class="admin_label">Password</label>
        <input type="password" class="form-control admin_password" id="password" name="password"
            placeholder="Enter username" required>
        <button type="submit" class="btn btn-primary" name="submit" value="sub">Login</button>
    </form>
</div>