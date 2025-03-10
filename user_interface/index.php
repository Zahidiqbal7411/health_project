<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
         @keyframes zoomIn {
        0% {
            transform: scale(2.0); 
            opacity: 0; 
        }
        100% {
            transform: scale(1); /* End with the normal size */
            opacity: 1; /* Full opacity */
        }
    }

    #imagePreview img {
        animation: zoomIn 2s ease-in-out;
        /* Optional: add some transition for smoothness */
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    /* Optionally add a hover effect */
    #imagePreview img:hover {
        transform: scale(1.1);  /* Slight zoom on hover */
    }
    
    </style>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center "  >
        <div class="form-container " id="form-container"style=" width:1000px;">
            <h1 style="font-weight:bold;">Student Registration Form</h1>

            <form id="registrationForm" method="post">
                <div class="imageparent d-flex justify-content-end">
                <div id="imagePreview" style="border:none; background:transparent;">
                <img id="uploadImage" src="your-image.jpg" alt="Click to upload image" width="200" height="200">
                            
                        </div>
                </div>
          
                <div class="row mt-4">
                    <!-- Student Name Field -->
                    <div class="col-md-6 form-group">
                        <label for="studentName">Student Name</label>
                        <input type="text" id="studentName" name="studentName" placeholder="Enter student name" required>
                    </div>

                    <!-- Father's Name Field -->
                    <div class="col-md-6 form-group">
                        <label for="fatherName">Father Name</label>
                        <input type="text" id="fatherName" name="fatherName" placeholder="Enter father's name" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Student CNIC Field -->
                    <div class="col-md-6 form-group">
                        <label for="studentCnic">Student CNIC</label>
                        <input type="text" id="studentCnic" name="studentCnic" placeholder="Enter student CNIC" required>
                    </div>

                    <!-- Father's CNIC Field -->
                    <div class="col-md-6 form-group">
                        <label for="fatherCnic">Father CNIC</label>
                        <input type="text" id="fatherCnic" name="fatherCnic" placeholder="Enter father's CNIC" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Student Contact Field -->
                    <div class="col-md-6 form-group">
                        <label for="studentContact">Student Contact</label>
                        <input type="tel" id="studentContact" name="studentContact" placeholder="Enter student's contact number" required>
                    </div>

                    <!-- Guardian Contact Field -->
                    <div class="col-md-6 form-group">
                        <label for="guardianContact">Guardian Contact</label>
                        <input type="tel" id="guardianContact" name="guardianContact" placeholder="Enter guardian's contact number" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Country Field -->
                    <div class="col-md-6 form-group">
                        <label for="country">Country</label>
                        <select id="country" name="country" required>
                            <option value="" disabled selected>Select Country</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="India">India</option>
                            <option value="USA">USA</option>
                            <option value="UK">UK</option>
                        </select>
                    </div>

                    <!-- State Field -->
                    <div class="col-md-6 form-group">
                        <label for="state">State</label>
                        <select id="state" name="state" >
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- City Field -->
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <select id="city" name="city" required>
                            <option value="" disabled selected>Select City</option>
                        </select>
                    </div>

                    <!-- Student Image Field (moved to the end) -->
                    <div class="col-md-6 form-group">
                        
                    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <img id="modalImage" src="" alt="Image Preview" class="modal-image">
            <input type="file" id="imageUploadInput" class="image-upload-input" accept="image/*">
            <button id="chooseButton">Choose a new image</button>
        </div>
    </div>
                       
                    </div>
                </div>
                  <div class="d-flex justify-content-center">
                <button type="submit" class="submit-btn btn btn-primary w-50" name="student" value="std">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS (for full Bootstrap functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
