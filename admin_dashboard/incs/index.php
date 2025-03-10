<?php 
require_once('conn.php');
session_start();
$admin_username = $_SESSION['admin_username'];
$admin_password = $_SESSION['admin_password'];
$admin_role = $_SESSION['role'];

if ($admin_username && $admin_password == true) {
    // Continue
} else {
    header('location:admin_login.php');
    exit(); // Always call exit() after a header redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Sidebar Styling */
.sidebar {
    background-color: #2c3e50; /* Darker shade for a sleek look */
    min-height: 100vh;
    padding-top: 30px;
    width: 250px; /* Slightly smaller width for better aesthetics */
    transition: all 0.3s ease;
}

.sidebar:hover {
    width: 300px; /* Expand width on hover */
}

.sidebar .sidebar-heading {
    color: #ecf0f1; /* Lighter color for contrast */
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    padding-bottom: 15px;
}

.sidebar img {
    width: 100px;
    border-radius: 50%;
    display: block;
    margin: 0 auto;
    border: 3px solid #ecf0f1; /* Adds a border around the image */
}

.sidebar h5 {
    color: #ecf0f1; /* Light color for name */
    font-size: 18px;
}

.sidebar ul {
    list-style-type: none;
    padding-left: 0;
    margin-top: 30px;
}

.sidebar ul li {
    padding: 12px 20px;
    text-align: left;
    margin-bottom: 5px;
    transition: background-color 0.3s ease;
}

.sidebar ul li a {
    color: #ecf0f1; /* Lighter text color */
    text-decoration: none;
    font-size: 18px;
    display: block;
    transition: color 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #34495e; /* Slightly lighter shade on hover */
    color: #fff;
    border-radius: 5px;
}

.sidebar ul li.active {
    background-color: #1abc9c; /* Active item background */
    color: white;
    font-weight: bold;
}

/* Dropdown Styling */
.dropdown {
    position: relative;
    display: inline-block;
    width: 100%;
}

.dropbtn {
    background-color: transparent;
    border: none;
    color: #ecf0f1;
    padding: 12px 20px;
    font-size: 18px;
    width: 100%;
    text-align: left;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.dropbtn:hover {
    background-color: #34495e; /* Darker hover effect for the dropdown */
}

.dropdown-content {
    display: none;
    position: absolute;
    left: 0;
    background-color: #34495e;
    min-width: 200px;
    border-radius: 5px;
    z-index: 1;
}

.dropdown-content a {
    color: #ecf0f1;
    padding: 10px 20px;
    text-decoration: none;
    display: block;
    font-size: 16px;
}

.dropdown-content a:hover {
    background-color: #1abc9c; /* Green hover effect */
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Sidebar toggle animation (if you plan to toggle sidebar width) */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0;
        left: -250px;
        z-index: 1000;
        transition: left 0.3s ease;
    }

    .sidebar.open {
        left: 0;
    }
}

/* Body Content Styling */
.content {
    background-color: #ecf0f1;
    padding: 20px;
    flex: 1;
    transition: margin-left 0.3s ease;
}

.container-fluid {
    display: flex;
}

.row {
    width: 100%;
}

/* Card Styling */
.card {
    border-radius: 12px; /* Rounded corners for a softer appearance */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow effect for a modern look */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for interactions */
    background-color: #fff; /* Clean white background */
    overflow: hidden; /* Prevent content from overflowing */
}

.card:hover {
    transform: translateY(-5px); /* Lift the card up on hover for a subtle floating effect */
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2); /* Larger shadow on hover */
}

.card-header {
    background-color: #2c3e50; /* Dark background for the header */
    color: #fff; /* White text for the header */
    font-size: 20px; /* Slightly larger text */
    font-weight: bold;
    padding: 15px;
    text-align: center;
    border-bottom: 3px solid #1abc9c; /* Green accent line below header */
}

.card-body {
    padding: 20px;
    font-size: 16px;
    color: #333; /* Dark text color for readability */
    text-align: center; /* Center the content inside the card */
}

.card-body .btn {
    padding: 12px 30px; /* Larger button for better visual impact */
    font-size: 16px; /* Larger text for buttons */
    border-radius: 5px;
    background-color:gray; /* Green background for call-to-action buttons */
    color: #fff;
    border: none;
    transition: background-color 0.3s ease;
}

.card-body .btn:hover {
    background-color: #16a085; /* Darker shade of green on hover */
}

.card-body .card-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px; /* Space between title and content */
}

.card-body .card-text {
    font-size: 14px;
    color: #7f8c8d; /* Lighter color for text inside cards */
    margin-bottom: 20px;
}

.card-footer {
    background-color: #ecf0f1; /* Light grey footer */
    text-align: center;
    padding: 10px;
    font-size: 14px;
    color: #2c3e50; /* Dark color for footer text */
}

.card-footer a {
    color: #1abc9c;
    text-decoration: none;
}

.card-footer a:hover {
    text-decoration: underline; /* Underline on hover for links */
}


    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12 sidebar">
                        <div class="sidebar-heading">
                            <!-- <img src="" alt=""> -->
                            <h3><?php echo $admin_role; ?> Dashboard</h3>
                            <h5>Zahid Iqbal</h5>
                            <hr>
                        </div>
                        <ul>
                            <?php if($admin_role == 'Superadmin'):?>
                            <li><a href="#" onclick="dashboard()">Dashboard</a></li>

                            <div class="dropdown">
                                <li class="dropbtn">Create categories</li>
                                <div class="dropdown-content">
                                    <li><a href="#" onclick="admin1()">Add Admin</a></li>
                                    <li><a href="#" onclick="subadmin()">Add sub admin</a></li>
                                    <li><a href="#" onclick="user()">Add user</a></li>
                                    <hr style="color:white">
                                </div>
                            </div>

                            <li><a href="#" onclick="slider_list()">Slider list</a></li>
                            <li><a href="#" onclick="news_list()">News list</a></li>
                            <li><a href="#" onclick="marquee_list()">Marquee list</a></li>
                            <?php endif; ?>
                        </ul>
                        <ul>
                            <?php if($admin_role == 'Admin' || $admin_role == 'Subadmin'): ?>
                            <li><a href="#" onclick="dashboard()">Dashboard</a></li>
                            <li><a href="#" onclick="slider_list()">Country List</a></li>
                            <li><a href="#" onclick="news_list()">State List</a></li>
                            <li><a href="#" onclick="marquee_list()">City List</a></li>
                            <?php endif; ?>
                        </ul>
                        <ul>
                            <?php if($admin_role == 'User'): ?>
                            <li><a href="#" onclick="usersliderlist()">Slider List</a></li>
                            <li><a href="#" onclick="usernewslist()">News List</a></li>
                            <li><a href="#" onclick="usermarqueelist()">Marquee List</a></li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
         
            
                
                <div class="col-md-10">
                    <div class="row">
                        <div class="row">
                        
                            <div class="col-md-10">
                            <h1 class="fw-bold"><?php echo $admin_role; ?> Dashboard</h1>

                            </div>
                            <div class="col-md-2">
                                <form action="logout.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-primary" style="margin-left:160px; border-radius:5px; background-color:gray;">Logout</button>
                                </form>
                            </div>
                        </div>
                        <hr style="color:black;">
                    <?php
                    if ($admin_role === 'Superadmin' || $admin_role === 'Admin' || $admin_role === 'Subadmin') {
                        echo '

                        <div class="card mt-4" id="main_content">
                            <div class="card-header">
                                <h2 class="card-title">Student Management System</h2>
                            </div>
                            <div class="card-body">
                                <div class="row card-items">
                                    <div class="col-md-4">
                                        <div class="card slider_card">
                                            
                                            <div class="card-body">
                                                <button class="btn btn-primary w-50" onclick="slider()">Add Country</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card news_card">
                                           
                                            <div class="card-body">
                                                <button class="btn btn-primary w-50" onclick="news()">Add State</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card marquee_card">
                                            
                                            <div class="card-body">
                                                <button class="btn btn-primary w-50" onclick="marquee()">Add City</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                          
                             </div>
                        </div>
                    </div>';
            }
            ?>
      
      
            <?php 
               require_once('u_slider_list.php');
            require_once('u_marquee_list.php');
            require_once('u_news_list.php');
         
            require_once('news.php');
            require_once('marquee.php');
            require_once('slider_list.php');
            require_once('news_list.php');
            require_once('marquee_list.php');
            require_once('admin_form.php');
            require_once('slider.php');
            require_once('sub_admin_form.php');
            require_once('news_edit.php');
            require_once('user_form.php');
            ?>

        </div>
         
    </div>
    
    </div>

    <?php 

?>

    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>