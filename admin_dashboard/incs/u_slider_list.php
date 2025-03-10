
<div class="container" class="user_slider_table" style="display:none !important; width:1000px;" >
  <table class="table table-bordered border-1"  >
    <h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">Slider details</h1>
    <thead class="table-dark mt-3 ">
      <tr >
        <th class="w-50 "> Slider title</th>
        <th class="w-25">Slider image</th>
        
      </tr>
    </thead>
    <tbody>
    <?php 
    require_once('conn.php');
    if(isset($_GET['slider_delete'])){
       $delete_slider=$_GET['slider_delete'];
       
       $query="DELETE FROM web_slider WHERE slider_id='$delete_slider'";
       $result=mysqli_query($conn,$query);
    }
    $query="SELECT * FROM web_slider";
    $result = mysqli_query($conn, $query);
    $sliders = array();
    while($row = mysqli_fetch_assoc($result)){
      $sliders[] = $row;
    }
    
    
    foreach ($sliders as $slider): ?>
<tr>
    <td><?php echo $slider['slider_title']; ?></td>
    <td><?php echo $slider['slider_path']; ?></td>
    
</tr>
<?php endforeach; ?>

     
    </tbody>
    <tfoot></tfoot>
  </table>
</div>
