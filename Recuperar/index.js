let currentDate = new Date();
let selectedDays = [4, 5, 8, 9, 11, 12, 16]; // Example: Pre-selecting the first 3 days
let clickedDay = null;  // Variable to store clicked date
let lastClickedDay = null; // Store the previously clicked day to reset its background color

// Store the elements
const calendarDays = document.getElementById("calendarDays");
const selectedDateDisplay = document.getElementById("eventDetails");  // Display area for selected date
 // Input field container
const calendarContainer = document.getElementById("calendarContainer");  // Calendar container

// Helper function to render the calendar
function renderCalendar() {
  const monthYear = document.getElementById("monthYear");
  const weekDays = document.querySelectorAll(".weekday");

  calendarDays.innerHTML = ""; // Clear previous calendar

  // Display the month and year
  monthYear.innerText = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

  // Get first day and last date of the month
  let firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
  let lastDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
  let today = new Date();
  let todayDayIndex = today.getDay(); // Get index of today's weekday (0 = Sunday, 6 = Saturday)

  // Reset weekday highlights
  weekDays.forEach(day => day.classList.remove("highlighted-day"));

  // Highlight today's weekday
  if (currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear()) {
    weekDays[todayDayIndex].classList.add("highlighted-day");
  }

  // Create empty cells for alignment
  for (let i = 0; i < firstDay; i++) {
    let emptyCell = document.createElement("div");
    emptyCell.classList.add("day");
    calendarDays.appendChild(emptyCell);
  }

  const colors = ['#025373', '#025373', '#025373', '#F0E130', '#025373', '#4FA0BF', '#F0E130'];

  // Create day cells
  for (let i = 1; i <= lastDate; i++) {
    let dayCell = document.createElement("div");

    dayCell.id = `date_cell-${i}`;
    dayCell.classList.add("day");
    dayCell.innerText = i;

    // Highlight today's date
    if (i === today.getDate() && currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear()) {
      dayCell.classList.add("highlighted");
      dayCell.style.borderRadius = "8px";
    }

    // Highlight pre-selected days with different colors
    if (selectedDays.includes(i)) {
      dayCell.classList.add("highlighted");  // Add general highlight for pre-selected days
      const index = selectedDays.indexOf(i);
      dayCell.style.backgroundColor = colors[index]; // Assign background color dynamically
      dayCell.style.borderRadius = "8px";
    }

    // Event listener for day click
    dayCell.addEventListener('click', function() {
      inputRemainder.style.display = "block";

      // Reset background color of the previously clicked day
      if (lastClickedDay !== null) {
        lastClickedDay.style.backgroundColor = ""; 
      }

      // Update the clickedDay to the current one
      clickedDay = i;

      // Apply permanent yellow background color to the clicked day
      dayCell.style.backgroundColor = "yellow";

      const selectedMonthYear = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
  selectedDateDisplay.innerHTML = `For remainder: ${i} ${selectedMonthYear}`;


      // Store the current clicked day to lastClickedDay for future resets
      lastClickedDay = dayCell;

      // Focus on the input field
      const inputField = inputRemainder.querySelector('input');
      inputField.value = ''; // Clear any previous value
      inputField.focus();
    });

    // Append day cell to calendar
    calendarDays.appendChild(dayCell);
  }
}
function changeMonth(increment) {
  // Increment month by 1 (next month) or decrement by 1 (previous month)
  currentDate.setMonth(currentDate.getMonth() + increment);
  renderCalendar();  // Re-render the calendar with the new month
}


// Initialize the calendar
renderCalendar();
const inputRemainder = document.getElementById('input_remainder');
let isFocused = false;

// Add event listener for the focus event to track when the input field is focused
inputRemainder.addEventListener('focus', function() {
    isFocused = true;
});

// Add an event listener for the blur event

inputRemainder.addEventListener('blur', function() {
    // Check if the field had text when losing focus and was focused before
    const textData = inputRemainder.value;

    if (isFocused && textData.trim()) { // Check if there is non-empty text and input was focused
        submitRemainder(textData);
    } else if (textData.trim() === '') { // Check if it's empty, trigger delete
        deleteRemainder();  // Trigger delete if the input is cleared
    }

    // Reset the focus flag after losing focus
    isFocused = false;
});

// Function to submit remainder
function submitRemainder(textData) {
    fetch('remainder.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ remainder_text: textData })
    })
    .then(response => response.text())
    .then(data => {
        // Use SweetAlert to show a success message
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Remainder submitted successfully!',
        });

        inputRemainder.value = ''; // Clear input field after submission
    })
    .catch((error) => {
        console.error('Error:', error);
        // Optionally show an error alert in case of failure
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong while submitting the remainder.',
        });
    });
}

// Function to delete remainder (this function should be implemented)


// Function to delete remainder (this function should be implemented)

// Function to fetch remainder for a specific date
function fetchRemainder(date) {
  const remainder_textDb= document.getElementById('remainder_div');
  fetch(`remainder.php?date=${date}`)
      .then(response => response.text())
      .then(data => {
        // Assuming `div` or another HTML element to display the remainder
       remainder_textDb.innerHTML = ` ${data}`; 
       remainder_textDb.style.color="black";
        // Use innerHTML for non-textarea elements
    })
    
      .catch(error => {
          console.error('Error fetching remainder:', error);
      });
}

// Function to delete remainder based on the input value
function deleteRemainder() {
  const textData = document.getElementById('input_remainder').value;

  if (textData.trim() === '') {  // Only delete if textarea is empty
      const remainderId = document.getElementById('input_remainder').value; // You must have an ID field for remainder

      if (remainderId.trim()) {
          fetch('delete.php', {
              method: 'DELETE',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify({ r_id: remainderId }) // Send remainder ID for deletion
          })
          .then(response => response.text())
          .then(data => {
              // Success handler
              Swal.fire({
                  icon: 'success',
                  title: 'Deleted',
                  text: 'Remainder deleted successfully!',
              });

              // Clear the textarea and ID field after deletion
              document.getElementById('remainderTextarea').value = '';
              document.getElementById('remainderId').value = '';
          })
          .catch((error) => {
              console.error('Error:', error);
              // Optionally show an error alert in case of failure
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong while deleting the remainder.',
              });
          });
      }
  }
}

// Example: fetch remainder for a selected date (replace '2025-03-04' with dynamic date)
fetchRemainder('2025-03-04');




// Function to show the textarea when the user clicks the text
// Function to show the textarea when the user clicks on text
function showTextareaOnClick() {
  const clickableText = document.getElementById('remainder_div'); // Text element to click
  const inputRemainder = document.getElementById('input_remainder'); // Textarea element

  // Add a click event listener to the text element
  clickableText.addEventListener('click', function() {
      // Show the textarea by changing its display style
      inputRemainder.style.display = 'block'; 
      inputRemainder // You can also use 'inline-block' or 'flex', depending on your needs
        
      // Optionally, focus the textarea so the user can start typing immediately
      inputRemainder.focus();
  });

  // Add an event listener for blur (focus lost) event on the textarea
  inputRemainder.addEventListener('blur', function() {
      // Get the text entered in the textarea
      const remainderText = inputRemainder.value.trim();

      // Check if the text is not empty
      if (remainderText === '') {
          // If no text, you might want to skip the update or delete the record
          Swal.fire({
              icon: 'warning',
              title: 'No Text',
              text: 'You didn\'t enter anything. No changes were made.',
          });
          return; // Prevent submission if the textarea is empty
      }

      // Send a PUT request to update the record in the database
      fetch('remainder.php', {
          method: 'PUT',  // Use PUT for updating an existing record
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ remainder_text: remainderText, r_id: getRemainderId() }) // Send the text and remainder ID for update
      })
      .then(response => response.json())  // Assuming server responds with JSON
      .then(data => {
          if (data.error) {
              // Handle error response from the server
              Swal.fire({
                  icon: 'error',
                  title: 'Update Failed',
                  text: data.error || 'Something went wrong while updating the remainder.',
              });
          } else {
              // Success handler
              Swal.fire({
                  icon: 'success',
                  title: 'Remainder Updated',
                  text: 'Remainder updated successfully!',
              });
              Swal.fire({
                  icon: 'success',
                  title: 'Remainder Updated',
                  text: 'Remainder updated successfully!',
              });

              // Clear the textarea and hide it after successful update
              inputRemainder.value = '';
              inputRemainder.style.display = 'none'; // Hide the textarea again
          }
      })
      .catch((error) => {
          console.error('Error:', error);
          // Show an error alert if the fetch request fails
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong while updating the remainder.',
          });
      });
  });
}

// Helper function to get the remainder ID (you can adapt this logic to get the actual remainder ID)
function getRemainderId() {
  // You can get the remainder ID from an element, e.g., a hidden input field or elsewhere
  return document.getElementById('remainderId').value;  // Assuming the ID is stored in a hidden field with id="remainderId"
}

// Call the function to set everything up
showTextareaOnClick();





































// const inputRemainder = document.getElementById('input_remainder');
// let isFocused = false;

// // Add event listener for the focus event to track when the input field is focused
// inputRemainder.addEventListener('focus', function() {
//     isFocused = true;
// });

// // Add an event listener for the blur event to check if the text has been removed
// inputRemainder.addEventListener('blur', function() {
//     const textData = inputRemainder.value;

//     // Check if the input field is empty and the user has previously focused on it
//     if (isFocused && textData.trim() === '') {
//         deleteRemainder(); // Call the function to handle the delete operation
//     }

//     // Reset the focus flag after losing focus
//     isFocused = false;
// });

// function deleteRemainder() {
//     // Assuming that you have an identifier for the remainder, like an ID, to delete the specific record
//     const remainderId = inputRemainder.getAttribute('data-remainder-id'); // You can store the ID in a data attribute

//     fetch('delete_remainder.php', {
//         method: 'DELETE',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ r_id: remainderId }), // Send the ID of the remainder to be deleted
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Remainder deleted successfully!',
//                 text: 'The remainder has been deleted from the database.',
//                 confirmButtonText: 'OK',
//             });
//         } else {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Something went wrong while deleting the remainder.',
//             });
//         }
//     })
//     .catch((error) => {
//         console.error('Error:', error);
//         Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: 'Something went wrong while deleting the remainder.',
//         });
//     });
// }


// document.addEventListener('DOMContentLoaded', function() {
//   // Fetch data from the database when the page loads
//   fetch('get_remainder.php')
//       .then(response => response.json())  // Parse the JSON response
//       .then(data => {
//           console.log('Fetched remainders:', data);
          
//           // Handle the fetched data
//           if (data.length > 0) {
//               // Display the fetched remainders
//               const remainderList = document.getElementById('remainder_list');
//               remainderList.innerHTML = ''; // Clear the list first
              
//               data.forEach(item => {
//                   const li = document.createElement('li');
//                   li.textContent = item; // Add remainder text to list item
//                   remainderList.appendChild(li); // Append list item to the list
//               });
//           } else {
//               console.log('No remainders found in the database');
//           }
//       })
//       .catch(error => {
//           console.error('Error fetching data:', error);
//       });
// });




