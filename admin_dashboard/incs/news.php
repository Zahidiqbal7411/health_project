
<form action="" id="news_form" method="post" style="display:none !important">

    <label style="font-weight:bold; font-size:23px;">Add news</label>
    <textarea rows="10" id="news_header" name="news_header" class="form-control" required></textarea>

    <button type="submit" class="btn btn-success mt-3" id="sliderBtn" name="submit" value="sub">Submit</button>
</form>


<?php 
require_once('conn.php');
if (isset($_POST['submit']) && $_POST['submit'] == 'sub' && isset($_POST['news_header'])) {
          $news_header=$_POST['news_header'];
 
            $query = "INSERT INTO `news` (news_header) VALUES ('$news_header')";
            $news_query = mysqli_query($conn, $query);
            
            if ($news_query) {
               
            } 
        } 

?>