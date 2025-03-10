<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
require_once('conn.php');

$data = []; 

if (isset($_GET['news_id'])) {
    $news_id = $_GET['news_id'];

    
    $stmt = $conn->prepare("SELECT * FROM news WHERE news_id = ?");
    $stmt->bind_param("i", $news_id); // 'i' stands for integer type
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if any result is returned.
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Fetch the first matching row into $data.
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_POST['news_header']) && isset($_GET['news_id'])) {
    $news_header = $_POST['news_header'];
    $news_id = $_GET['news_id'];

    // Sanitize inputs (in this case, news_header) before using in the query
    $news_header = mysqli_real_escape_string($conn, $news_header);

    // Secure the SQL query using prepared statements
    $stmt = $conn->prepare("UPDATE news SET news_header = ? WHERE news_id = ?");
    $stmt->bind_param("si", $news_header, $news_id); // 's' for string, 'i' for integer
    if ($stmt->execute()) {
        echo "News updated successfully.";
    } else {
        echo "Error updating news: " . mysqli_error($conn);
    }
    $stmt->close();

}
?>

<form action="" id="news_form" method="post" style="display: none;">
    <label style="font-weight:bold; font-size:23px;">Add news</label>

    <!-- Ensure $data is set before accessing it to avoid errors. -->
    <textarea rows="10" id="news_header" name="news_header" class="form-control" required>
        <?php echo isset($data['news_header']) ? htmlspecialchars($data['news_header']) : ''; ?>
    </textarea>

    <button type="submit" class="btn btn-success mt-3" id="sliderBtn" name="submit" value="sub">update</button>
</form>
<?php





?>