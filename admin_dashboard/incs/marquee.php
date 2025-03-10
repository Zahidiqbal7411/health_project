
<form action="" class="panel_form" id="marquee_form" method="post"
    style="display:none !important">
    <label class="panel_label" style="font-weight:bold; font-size:23px;">Add Marquee</label>
    <textarea rows="10" id="panel_text" name="panel_text" class="form-control panel_text" required></textarea>
    <button type="submit" class="btn btn-success mt-3" id="marqueeBtn" name="submit" value="sub">Submit</button>
</form>

<?php 
require_once('conn.php');


if (isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_POST['panel_text'])) {

    $marquee_text = $_POST['panel_text'];
 
    $query = "INSERT INTO `panel` (panel_text) VALUES ('$marquee_text')";
    
    $marquee_query = mysqli_query($conn, $query);
    
    if ($marquee_query) {
        // echo "Data is submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn); 
    }
}
?>