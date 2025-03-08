<?php
require_once('conn.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['remainder_text']) && isset($data['selected_date'])) {
    $remainderText = $data['remainder_text'];
    $selectedDate = $data['selected_date'];

    // Ensure the date format is correct (YYYY-MM-DD)
    if (DateTime::createFromFormat('Y-m-d', $selectedDate) === false) {
        echo json_encode(['error' => 'Invalid date format for selected_date']);
        exit;
    }

    // Prepare the SQL statement to insert data with selected_date
    $stmt = $conn->prepare("INSERT INTO remainder (remainder_text, selected_date) VALUES (?, ?)");

    // Bind parameters
    $stmt->bind_param("ss", $remainderText, $selectedDate);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo json_encode([
            'message' => 'Data inserted successfully',
            'id' => $stmt->insert_id, // Return the ID of the inserted row
        ]);
    } else {
        echo json_encode(['error' => 'Error inserting data: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Missing required field: remainder_text or selected_date']);
}
?>
