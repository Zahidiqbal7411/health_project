<div class="container" id="marquee_table" style="display:none; width:1000px;">
  <h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">City details</h1>
  <table class="table table-bordered border-1">
    <thead class="table-dark">
      <tr>
        <th class="w-75">City title</th>
        <th class="w-25">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once('conn.php');
      $marquee_data = [];

      if (isset($_GET['marquee_delete'])) {
        $marquee_id = $_GET['marquee_delete'];
        $query = "DELETE FROM panel WHERE panel_id=$marquee_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
          echo "Data deleted";
        }
      }

      $query = "SELECT * FROM panel";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $marquee_data[] = $row;
      }

      foreach ($marquee_data as $data): ?>
        <tr>
          <td><?php echo $data['panel_text']; ?></td>
          <td>
            <a href="javascript:void(0)" class="btn btn-success marquee_edit"
              data-id="<?php echo $data['panel_id']; ?>">Edit</a>
            <a href="?marquee_delete=<?php echo $data['panel_id']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<div class="modal" tabindex="-1" id="marqueeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Edit marquee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="marquee_form">
          <div class="mb-3">
            <label for="marquee_label" class="form_label"> Marquee text</label>
            <textarea rows="8" class=" form-control marquee_text" id="marquee_text" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savechanges"> Save changes</button>

      </div>
    </div>
  </div>
</div>
</div>


<script>
  // Event listener for edit button in marquee list
  // document.querySelectorAll('.marquee_edit').forEach(button => {
  //   button.addEventListener('click', function() {
  //     const marqueeId = this.getAttribute('data-id');
  //     const marqueeModal = new bootstrap.Modal(document.getElementById('marqueeModal'));
  //     marqueeModal.show();

  //     // Fetch data from get_edit_marquee.php using the marquee_id
  //     fetch('get_edit_marquee.php?marquee_id=' + marqueeId)
  //       .then(response => response.json())
  //       .then(data => {
  //         // Check if response data is valid
  //         if (data && data.panel_text) {
  //           // Update modal fields with data from the response
  //           document.getElementById('marquee_text').value = data.panel_text;
  //         } else {
  //           console.error('Invalid response data:', data);
  //         }
  //       })
  //       .catch(error => console.error('Error:', error));
  //   });
  // });


  document.querySelectorAll('.marquee_edit').forEach(button => {
  button.addEventListener('click', function() {
    const marqueeId = this.getAttribute('data-id');
    const newsModal = new bootstrap.Modal(document.getElementById('marqueeModal'));
    newsModal.show();

    // Fetch existing news data
    fetch('marquee_edit.php?marquee_id=' + marqueeId)
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
          return;
        }
        document.getElementById('marquee_text').value = data.panel_text;
      })
      .catch(error => console.error('Error fetching news:', error));

    // Save updated news when the user clicks the Save button
    const saveChangesButton = document.getElementById('savechanges');
    saveChangesButton.onclick = function() {
      const marquee_text = document.getElementById('marquee_text').value;

      // Send the updated data to marquee_edit.php
      fetch('marquee_edit.php', {
        method: 'POST',
        body: new URLSearchParams({
          'panel_id': marqueeId, // Use the correct variable here
          'panel_text': marquee_text
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