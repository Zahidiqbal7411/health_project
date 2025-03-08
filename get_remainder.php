<?php
require_once('conn.php'); // Ensure this file contains the database connection

// Get the date from the request (GET parameter)
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Ensure the date format is correct (YYYY-MM-DD)
    if (DateTime::createFromFormat('Y-m-d', $selectedDate) === false) {
        echo json_encode(['error' => 'Invalid date format. Expected format: YYYY-MM-DD']);
        exit;
    }

    // Prepare the SQL query to fetch the reminder for the given date
    $stmt = $conn->prepare("SELECT remainder_text FROM remainder WHERE selected_date = ?");
    
    // Bind the parameter (date)
    $stmt->bind_param("s", $selectedDate);

    // Execute the query
    if ($stmt->execute()) {
        // Fetch the result
        $result = $stmt->get_result();
        
        // Check if any row is returned
        if ($result->num_rows > 0) {
            // Fetch the reminder data
            $row = $result->fetch_assoc();
            echo json_encode(['reminder' => $row['remainder_text']]);
        } else {
            // If no reminder found for the selected date
            echo json_encode(['reminder' => null]);
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
