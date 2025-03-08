<?php
require_once('conn.php'); // Ensure this file contains the database connection

// Prepare the SQL query to fetch the selected_date from the remainder table
$stmt = $conn->prepare("SELECT selected_date FROM remainder");

// Execute the query
if ($stmt->execute()) {
    // Fetch the result
    $result = $stmt->get_result();
    
    // Check if any row is returned
    if ($result->num_rows > 0) {
        // Fetch all selected dates
        $dates = [];
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['selected_date'];
        }
        
        // Return the dates in JSON format
        echo json_encode(['dates' => $dates]);
    } else {
        // If no date is found
        echo json_encode(['dates' => []]);
    }
} else {
    // If the query fails
    echo json_encode(['error' => 'Error executing query: ' . $stmt->error]);
}

// Close the statement
$stmt->close();
?>
