
<link href="../css/slider.css" rel="stylesheet">
<form action="" class="country_form" id="country_form" method="post" enctype="multipart/form-data">
    <label class="country_label" style="font-weight:bold; font-size:23px;">Add Country</label>
    
    <!-- Input for Country Name -->
    <label class="country_label">Country Name</label>
    <input type="text" class="country_name" name="country_name" required placeholder="Enter country name" />

  
    <!-- Submit Button -->
    <button type="submit" class="btn btn-success" id="countryBtn" name="submit" value="sub">Submit</button>
</form>


<?php 
require_once('conn.php');

 ?>
<?php
if (isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_FILES['slider_image']) && isset($_POST['slider_title'])) {

    
    $slider_image = $_FILES['slider_image'];
    $slider_title = $_POST['slider_title'];

   
    $uploadDirectory = '../images/';  
    $dir = 'images/';
    
    if ($slider_image['error'] !== UPLOAD_ERR_OK) {
        echo "Error with file upload. Error code: " . $slider_image['error'];
        exit();
    }

    $fileTmpName = $slider_image['tmp_name'];  
    $fileName = $slider_image['name'];  
    $fileSize = $slider_image['size'];  
    $fileError = $slider_image['error'];  

   
    $allowedTypes = ['image/jpg', 'image/png', 'image/jpeg', 'application/pdf'];

    
    $fileType = mime_content_type($fileTmpName);

    
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type!";
    } else {
        if ($fileError === 0) {
            
            $uniqueName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            $fileDestination = $uploadDirectory . $uniqueName;  // Destination path on the server

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Construct the relative file path for database
                $access_dir = $dir . $uniqueName;

                // Insert the data into the database
                $query = "INSERT INTO `web_slider` (slider_path, slider_title) VALUES ('$access_dir', '$slider_title')";
                // Assuming $conn is your MySQL connection, check if the query executes correctly
                if (mysqli_query($conn, $query)) {
                    // echo "Data submitted successfully.";
                } else {
                    echo "Error inserting data into the database: " . mysqli_error($conn);
                }
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Error uploading the file. Code: $fileError";
        }
    }
}
?>