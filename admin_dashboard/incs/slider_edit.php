<?php 
require_once('conn.php');
$data=[];
if(isset($_GET['slider_id'])){
    $slider_id = $_GET['slider_id'];
    $query="SELECT * FROM web_slider WHERE slider_id='$slider_id'";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
       $data[]=$row;
}}
if(isset($_POST['submit']) &&  $_POST['submit'] == 'sub'){

$slider_header=$_POST['slider_title'];
$slider_path=$_POST['slider_path'];
$query="UPDATE set slider_header='$slider_header', slider_path='$slider_path' WHERE slider_id='$slider_id'";



}
?>

<form action="" class="slider_form" id="slider_form" method="post"
    enctype="multipart/form-data" style="display:none !important">
    <label class="slider_label" style="font-weight:bold; font-size:23px;">Add slider</label>
    <input type="file" class="slider_path" name="slider_image" <?php echo $data['slider_path']; ?> required />
    <label class="slider_label">Add title</label>
    <textarea rows="10" class="slider_title" name="slider_title" class="form-control" required><?php $data['slider_title'];?></textarea>

    <button type="submit" class="btn btn-success" id="sliderBtn" name="submit" value="sub">Update</button>
    
</form>




