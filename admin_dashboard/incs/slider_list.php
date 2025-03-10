<div class="container" id="slider_table" style="display:none; width:1000px;">
  <h1 class="d-flex justify-content-center align-items-center mt-5 fw-bold">Country details</h1>
  <table class="table table-bordered border-1">
    <thead class="table-dark">
      <tr>
        <th class="w-50">Country title</th>
        <th class="w-25">Country image</th>
        <th class="w-25">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once('conn.php');
      if (isset($_GET['slider_delete'])) {
        $delete_slider = $_GET['slider_delete'];
        $query = "DELETE FROM web_slider WHERE slider_id='$delete_slider'";
        $result = mysqli_query($conn, $query);
      }

      $query = "SELECT * FROM web_slider";
      $result = mysqli_query($conn, $query);
      $sliders = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $sliders[] = $row;
      }

      foreach ($sliders as $slider): ?>
        <tr>
          <td><?php echo $slider['slider_title']; ?></td>
          <td><img src="<?php echo $slider['slider_path']; ?>" alt="Slider Image" width="100"></td>
          <td class="d-flex justify-content-center align-items-center">
            <button href="slider_edit.php?slider_id=<?php echo $slider['slider_id']; ?>" class="btn btn-success slider_edit" data-id="<?php echo $slider['slider_id']; ?>">Edit</button>
            <a href="?slider_delete=<?php echo $slider['slider_id']; ?>" class="btn btn-danger ml-2">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal for Editing Slider -->
<div class="modal" tabindex="-1" id="sliderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Slider</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="sliderEditForm">
          <div class="mb-3">
            <label for="slider_title" class="form-label">Slider Title</label>
            <input type="text" class="form-control" id="slider_title" required>
          </div>
          <div class="mb-3">
            <label for="slider_image" class="form-label">Slider Image</label>
            <input type="file" class="form-control" id="slider_image" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveSliderChanges">Update</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Event listener for edit button in slider list
  document.querySelectorAll('.slider_edit').forEach(button => {
    button.addEventListener('click', function() {
      const sliderId = this.getAttribute('data-id');
      const sliderModal = new bootstrap.Modal(document.getElementById('sliderModal'));
      sliderModal.show();

      // Fetch data from slider_edit.php using the slider_id
      fetch('get_edit_slider.php?slider_id=' + sliderId)
        .then(response => response.json())
        .then(data => {
          // Check if response data is valid
          if (data && data.slider_title && data.slider_path) {
            // Update modal fields with data from the response
            document.getElementById('slider_title').value = data.slider_title;
            // For image, you might want to display the current image preview
            // Assuming the path is valid, show the image
            document.getElementById('slider_image').value = ''; // Reset the input field
          } else {
            console.error('Invalid response data:', data);
          }
        })
        .catch(error => console.error('Error:', error));
    });
  });

  // Save changes to slider
  document.getElementById('saveSliderChanges').addEventListener('click', function() {
    const sliderTitle = document.getElementById('slider_title').value;
    const sliderImage = document.getElementById('slider_image').files[0];

    // Create form data for the slider title and image
    const formData = new FormData();
    formData.append('slider_title', sliderTitle);
    if (sliderImage) {
      formData.append('slider_image', sliderImage);
    }

    // You can use AJAX to send the updated data to the server and save it
    fetch('slider_edit.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Slider updated successfully!');
        location.reload();  // Reload the page to reflect the changes
      } else {
        alert('Failed to update slider.');
      }
    })
    .catch(error => console.error('Error saving slider:', error));
  });
</script>

