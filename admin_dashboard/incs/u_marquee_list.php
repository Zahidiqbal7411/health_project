

<div class="container"  style="display:none; width:1000px;">
<h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">Marquee details</h1>
  <table class="table table-bordered border-1" id="user_marquee_table">
    <thead class="table-dark">
      <tr>
        <th class="w-75">marquee text</th>
        
        
      </tr>
    </thead>
    <tbody>
      <?php
      require_once('conn.php');
      $marquee_data=[];
    
    if(isset($_GET['marquee_delete'])){
       $marquee_id=$_GET['marquee_delete'];
       
       $query="DELETE  FROM panel WHERE panel_id=$marquee_id";
       $result=mysqli_query($conn,$query);
       if($result){
       
      echo "data deleted";
       
       }
    }
    
      $query="SELECT * FROM panel";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_assoc($result)){
        $marquee_data[]=$row;
      }
      ?>


      <?php foreach($marquee_data as $data):?>
      <tr>
        <td><?php echo $data['panel_text'];?></td>
        
       
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot></tfoot>
  </table>
</div>