
<?php
if (isset($_GET['marquee_id'])) {
    $marquee_id = $_GET['marquee_id'];
    // Ensure to sanitize user input to prevent SQL injection
    $marquee_id = mysqli_real_escape_string($conn, $marquee_id);
    
    $query = "SELECT panel_text FROM panel WHERE panel_id = '$marquee_id'";
    $marquee_query = mysqli_query($conn, $query);

    if ($marquee_query) {
        $result = mysqli_fetch_assoc($marquee_query);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'No data found for the given marquee ID']);
        }
    } else {
        echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['panel_id']) && isset($_POST['panel_text'])) {
        $panel_id = $_POST['panel_id'];
        $panel_text = $_POST['panel_text'];

        // Sanitize input
        $panel_id = mysqli_real_escape_string($conn, $panel_id);
        $panel_text = mysqli_real_escape_string($conn, $panel_text);

        $update_query = "UPDATE panel SET panel_text = '$panel_text' WHERE panel_id = '$panel_id'";
         $result=mysqli_query($conn, $update_query);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update the marquee text']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
}
?>
