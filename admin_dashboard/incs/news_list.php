<div class="container" id="news_table" style="display:none; width:1000px;">
  <table class="table table-bordered border-1">
    <h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">State details</h1>
    <thead class="table-dark">
      <tr>
        <th class="w-75">State title</th>
        <th class="w-25">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once('conn.php');
      if (isset($_GET['news_delete'])) {
        $news_id = $_GET['news_delete'];
        $query = "DELETE FROM news where news_id='$news_id'";
        $result = mysqli_query($conn, $query);
      }
      $query = "SELECT * FROM news";
      $result = mysqli_query($conn, $query);
      $news_array = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $news_array[] = $row;
      }

      foreach ($news_array as $news): ?>
        <tr>
          <td><a href="#"> <?php echo $news['news_header']; ?></a></td>
          <td class="d-flex justify-content-center align-items-center ">
            <a href="javascript:void(0)" class="btn btn-success news_edit"
              data-id="<?php echo $news['news_id']; ?>">Edit</a>

            <a href="?news_delete=<?php echo $news['news_id']; ?>" class="btn btn-danger ml-2" style="margin-left:10px;">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" id="newsModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit News</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newsEditForm">
          <div class="mb-3">
            <label for="news_header" class="form-label">News Header</label>
            <input type="text" class="form-control" id="news_header" required>
          </div>
          <div class="mb-3">
            <label for="news_body" class="form-label">News Body</label>
            <textarea class="form-control" id="news_body" rows="6" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  
  document.querySelectorAll('.news_edit').forEach(button => {
  button.addEventListener('click', function() {
    const newsId = this.getAttribute('data-id');
    const newsModal = new bootstrap.Modal(document.getElementById('newsModal'));
    newsModal.show();

    // Fetch existing news data
    fetch('get_edit_news.php?news_id=' + newsId)
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
          return;
        }
        document.getElementById('news_header').value = data.news_header;
       
        document.getElementById('news_body').value = data.news_description;
      })
      .catch(error => console.error('Error fetching news:', error));

    // Save updated news when the user clicks the Save button
    const saveChangesButton = document.getElementById('saveChanges');
    saveChangesButton.onclick = function() {
      const updatedHeader = document.getElementById('news_header').value;
      const updatedBody = document.getElementById('news_body').value;

      // Send the updated data to update_news.php
      fetch('get_edit_news.php', {
        method: 'POST',
        body: new URLSearchParams({
          'news_id': newsId,
          'news_header': updatedHeader,
          'news_body': updatedBody
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('News updated successfully');
          newsModal.hide(); // Hide the modal
          location.reload(); // Reload to show updated news
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => console.error('Error:', error));
    };
  });
});



</script>
