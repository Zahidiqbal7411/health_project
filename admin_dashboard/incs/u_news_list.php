
<div class="container" id="user_news_table" style="display:none !important; width:1000px;">
<h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">News details</h1>
  <table class="table table-bordered border-1"   >
  
    <thead  class="table-dark">
    
      <tr>
        <th class="w-75">News Header</th>
        
       
      </tr>
    </thead>
    <tbody>
    <?php 
    require_once('conn.php');
    if(isset($_GET['news_delete'])){
      $news_id = $_GET['news_delete'];
      $query="DELETE FROM news where news_id='$news_id'";
      $result = mysqli_query($conn,$query);
    }
    $query="SELECT * FROM news";
    $result = mysqli_query($conn, $query);
    $news_array = [];
    while($row = mysqli_fetch_assoc($result)){
    $news_array[]=$row;
    
    }
    
    
    foreach ($news_array as $news): ?>
<tr>
    
    <td><a href=""> <?php echo $news['news_header']; ?></a></td>
    
 
</tr>
<?php endforeach; ?>
      
       
    </tbody>
    <tfoot>

    </tfoot>
  </table>
</div>