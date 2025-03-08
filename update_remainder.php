<?php
// Update reminder PHP script

// Include your database connection
require_once('conn.php'); // Update with the actual path to your database connection

// Check if the POST request has the required parameters (date and reminder)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['selected_date']) && isset($data['remainder_text'])) {
        $date = $data['selected_date'];
        $reminder = $data['remainder_text'];

        // Sanitize input to prevent SQL injection
        $date = mysqli_real_escape_string($conn, $date);
        $reminder = mysqli_real_escape_string($conn, $reminder);

        // First, check if a reminder exists for the given date
        $checkQuery = "SELECT * FROM remainder WHERE selected_date = '$date'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Reminder exists, update it
            $updateQuery = "UPDATE remainder SET remainder_text = '$reminder' WHERE selected_date = '$date'";

            if (mysqli_query($conn, $updateQuery)) {
                // Successfully updated reminder
                echo json_encode(['success' => true, 'message' => 'Reminder updated successfully.']);
            } else {
                // If update failed
                echo json_encode(['success' => false, 'message' => 'Failed to update reminder.']);
            }
        } else {
            // Reminder does not exist, insert a new reminder
            $insertQuery = "INSERT INTO remainder (selected_date, remainder_text) VALUES ('$date', '$reminder')";
            if (mysqli_query($conn, $insertQuery)) {
                // Successfully inserted new reminder
                echo json_encode(['success' => true, 'message' => 'Reminder added successfully.']);
            } else {
                // If insert failed
                echo json_encode(['success' => false, 'message' => 'Failed to add reminder.']);
            }
        }
    } else {
        // Missing parameters in the request
        echo json_encode(['success' => false, 'message' => 'Missing date or reminder in the request.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the database connection
mysqli_close($conn);
?>
