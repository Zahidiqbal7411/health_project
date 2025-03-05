<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('conn.php'); // Assuming this file contains your DB connection

// Part 1: Insert remainder data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the 'remainder_text' and 'selected_date' fields are set
    if (isset($data['remainder_text']) && isset($data['selected_date'])) {
        $remainderText = $conn->real_escape_string($data['remainder_text']); // Escape special characters for SQL
        $selected_date = $conn->real_escape_string($data['selected_date']); // Ensure the date is properly escaped

        // Validate that the selected_date is in a valid format (YYYY-MM-DD)
        if (DateTime::createFromFormat('Y-m-d', $selected_date) !== false) {
            // Prepare the SQL statement
            $sql = "INSERT INTO remainder (remainder_text, selected_date) VALUES ('$remainderText', '$selected_date')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                // Respond with success
                echo json_encode([
                    'message' => 'Data inserted successfully',
                    'id' => $conn->insert_id, // Return the ID of the inserted row
                ]);
            } else {
                // Respond with an error if the insertion fails
                echo json_encode(['error' => 'Error inserting data: ' . $conn->error]);
            }
        } else {
            // If the date format is invalid
            echo json_encode(['error' => 'Invalid date format. Expected format: YYYY-MM-DD']);
        }
    } else {
        // Respond with an error if 'remainder_text' or 'selected_date' is not set
        echo json_encode(['error' => 'Missing required fields: remainder_text or selected_date']);
    }
}

// Part 2: Fetch remainder data for a specific date
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date'])) {
    $date = $_GET['date'];

    // Prepare SQL query to fetch remainder based on the date
    $stmt = $conn->prepare("SELECT remainder_text FROM remainder WHERE selected_date = ?");
    if (!$stmt) {
        // If the query preparation fails
        die("Query preparation failed: " . $conn->error);
    }

    // Bind the date parameter to the SQL query
    $stmt->bind_param("s", $date);  

    // Execute the query
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if a remainder exists for the given date
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();  // Fetch the first row of the result
        echo $row['remainder_text'];  // Output the remainder_text
    } else {
        echo "No remainder found for the given date.";  // If no data is found
    }

    // Close the prepared statement and the database connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
