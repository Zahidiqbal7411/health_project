<?php
require_once('conn.php'); // Ensure this file contains the database connection

// Check if the 'date' parameter is provided
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Ensure the date format is correct (YYYY-MM-DD)
    if (DateTime::createFromFormat('Y-m-d', $selectedDate) === false) {
        echo json_encode(['error' => 'Invalid date format. Expected format: YYYY-MM-DD']);
        exit;
    }

    // Prepare the SQL query to delete the reminder for the given date
    $stmt = $conn->prepare("DELETE FROM remainder WHERE selected_date = ?");

    // Bind the parameter (date)
    $stmt->bind_param("s", $selectedDate);

    // Execute the query
    if ($stmt->execute()) {
        // Check if any row was affected (i.e., a reminder was deleted)
        if ($stmt->affected_rows > 0) {
            echo json_encode(['reminder' => 'Reminder deleted successfully']);
        } else {
            // If no rows were affected, the date may not have had a reminder
            echo json_encode(['reminder' => 'No reminder found for this date']);
        }
    } else {
        // If the query fails
        echo json_encode(['error' => 'Error executing query: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    // If no date parameter is provided
    echo json_encode(['error' => 'Missing required field: date']);
}
?>
