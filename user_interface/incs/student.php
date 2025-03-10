<?php 
require_once('conn.php');

// Check if the form is submitted with the correct button
if(isset($_POST['submit']) && $_POST['submit'] == 'std'){
    $stName = $_POST['studentName'];
    $stFathername = $_POST['fatheName'];
    $stCnic = $_POST['studentCnic'];
    $stFatherCnic = $_POST['fatheCnic'];
    $stContact = $_POST['studentContact'];
    $stFatherContact = $_POST['fatherContact'];
    $stCountryName = $_POST['country'];
    $stStateName = $_POST['state'];
    $stCityName = $_POST['city'];

    // Correcting the SQL query syntax
    $query = "INSERT INTO student_form (s_name, s_fathername, s_cnic, f_cnic, s_contact, st_fcontact, st_country,st_state, st_city) 
              VALUES ('$stName', '$stFathername', '$stCnic', '$stFatherCnic', '$stContact', '$stFatherContact', '$stCountryName', '$stStateName', '$stCityName')";

    $result = mysqli_query($conn, $query);

    // If the query was successful, show SweetAlert
    if($result){
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Success!",
                text: "Student information has been successfully submitted.",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>';
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Error!",
                text: "There was an issue submitting the information. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
}
?>





?>