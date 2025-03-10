<?php

require_once('conn.php');

// Handle GET request to fetch news data
if (isset($_GET['news_id'])) {
    $news_id = mysqli_real_escape_string($conn, $_GET['news_id']);
    print_r($news_id);
    $query = "SELECT news_header,news_description FROM news WHERE news_id = '$news_id'";
    
    $result = mysqli_query($conn, $query);

    if ( $news = mysqli_fetch_assoc($result)) {
        echo json_encode($news);
    } else {
        echo json_encode(['error' => 'News not found']);
    }
} elseif (isset($_POST['news_id'], $_POST['news_header'], $_POST['news_body'])) {
    // Handle POST request to update news data
    $news_id = $_POST['news_id'];
    $news_header = $_POST['news_header'];
    $news_body = $_POST['news_body'];

    // Update the news in the database
    $query = "UPDATE news SET news_header = '$news_header', news_description = '$news_body' WHERE news_id = $news_id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
