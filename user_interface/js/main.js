// Image preview functionality
function previewImage(event) {
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.createElement('img');
            img.src = reader.result;
            previewContainer.innerHTML = '';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

// Dynamic population of states and cities based on selected country
const stateData = {
    Pakistan: ['Punjab', 'Sindh', 'KPK', 'Balochistan'],
    India: ['Delhi', 'Maharashtra', 'Tamil Nadu', 'Uttar Pradesh'],
    USA: ['California', 'Texas', 'New York', 'Florida'],
    UK: ['London', 'Manchester', 'Birmingham', 'Liverpool'],
};

const cityData = {
    Punjab: ['Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad'],
    Sindh: ['Karachi', 'Hyderabad', 'Sukkur', 'Sahiwal'],
    KPK: ['Peshawar', 'Mardan', 'Abbottabad', 'Dera Ismail Khan'],
    Balochistan: ['Quetta', 'Gwadar', 'Zhob', 'Khuzdar'],
    Delhi: ['New Delhi', 'Old Delhi', 'Dwarka', 'Connaught Place'],
    Maharashtra: ['Mumbai', 'Pune', 'Nagpur', 'Nashik'],
    Tamil Nadu: ['Chennai', 'Coimbatore', 'Madurai', 'Trichy'],
    Uttar Pradesh: ['Lucknow', 'Agra', 'Varanasi', 'Kanpur'],
    California: ['Los Angeles', 'San Francisco', 'San Diego', 'Sacramento'],
    Texas: ['Houston', 'Dallas', 'Austin', 'San Antonio'],
    New York: ['New York City', 'Buffalo', 'Rochester', 'Syracuse'],
    Florida: ['Miami', 'Orlando', 'Tampa', 'Jacksonville'],
    London: ['City of London', 'Westminster', 'Camden', 'Hammersmith'],
    Manchester: ['Northern Quarter', 'Spinningfields', 'Chorlton', 'Didsbury'],
    Birmingham: ['City Centre', 'Edgbaston', 'Moseley', 'Kings Heath'],
    Liverpool: ['City Centre', 'Toxteth', 'Wirral', 'Kirkdale'],
};

document.getElementById('country').addEventListener('change', function () {
    const country = this.value;
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    // Clear previous options
    stateSelect.innerHTML = '<option value="" disabled selected>Select State</option>';
    citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

    if (country && stateData[country]) {
        stateData[country].forEach(state => {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        });
    }
});

document.getElementById('state').addEventListener('change', function () {
    const state = this.value;
    const citySelect = document.getElementById('city');

    // Clear previous city options
    citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

    if (state && cityData[state]) {
        cityData[state].forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }
});





        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("imageModal");
            const img = document.getElementById("uploadImage");
            const span = document.getElementsByClassName("close-btn")[0];
            const modalImage = document.getElementById("modalImage");
            const imageUploadInput = document.getElementById("imageUploadInput");
            const chooseButton = document.getElementById("chooseButton");

            // When the user clicks on the image, open the modal
            img.onclick = function() {
                modal.style.display = "block";
                modalImage.src = img.src; // Display the clicked image in the modal
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // When the user clicks "Choose a new image" button, trigger file input
            chooseButton.onclick = function() {
                imageUploadInput.click();
            }

            // Preview image function (when user selects a new image)
            imageUploadInput.onchange = function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        modalImage.src = e.target.result; // Update the image in the modal
                        img.src = e.target.result; // Update the image outside the modal
                    };
                    reader.readAsDataURL(file); // Read the file as a data URL (base64)
                }
            }
        });
    








