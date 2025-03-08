let currentDate = new Date();
let clickedDay = null;  // Variable to store clicked date
let lastClickedDay = null; // Store the previously clicked day to reset its background color
let isFocused = false; // Flag to check if input field is focused

// Store the elements
const calendarDays = document.getElementById("calendarDays");
const selectedDateDisplay = document.getElementById("eventDetails");
const inputRemainder = document.getElementById('input_remainder');
const textData = inputRemainder.value;

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
      selectedDateDisplay.innerHTML = ` ${i} ${selectedMonthYear}`;

      // Store the current clicked day to lastClickedDay for future resets
      lastClickedDay = dayCell;

      // Focus on the input field
      const inputField = inputRemainder.querySelector('input');
      inputField.value = ''; // Clear any previous value
      inputField.focus();

      // Store the highlighted date in localStorage
      storeHighlightedDate(i);
    });

    // Append day cell to calendar
    calendarDays.appendChild(dayCell);
  }

  // Call restore function after rendering the calendar
  restoreHighlightedDate();
}

// Function to store the highlighted date in localStorage
function storeHighlightedDate(date) {
  localStorage.setItem('highlightedDate', date); // Save the selected date to localStorage
}

// Function to restore the highlighted date when the page reloads
function restoreHighlightedDate() {
  const storedDate = localStorage.getItem('highlightedDate'); // Get the stored date from localStorage
  if (storedDate) {
    highlightSelectedDate(storedDate); // If a date is stored, highlight it on page load
  }
}

// Function to highlight the selected date permanently
function highlightSelectedDate(date) {
  const allDateElements = document.querySelectorAll('.day'); // Select all day elements
  allDateElements.forEach(element => {
    // Compare each element's inner text with the selected date
    if (element.innerHTML.trim() === date) {
      element.classList.add('highlighted_date'); // Add the 'highlighted_date' class to the selected date
      element.style.backgroundColor = "yellow"; // Make sure it's yellow
    }
  });
}

// Function to submit remainder
function submitRemainder(textData, selected_date) {
  fetch('remainder.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ remainder_text: textData, selected_date: selected_date })
  })
  .then(response => response.json()) // Expect JSON response
  .then(data => {
    inputRemainder.value = '';
    highlightSelectedDate(selected_date);

    // Store the highlighted date in localStorage
    storeHighlightedDate(selected_date);

     // Clear input field after submission
  })
  .catch((error) => {
    console.error('Error:', error);
    // Show error message if something goes wrong
   
  });
}

// Function to highlight the selected date permanently
function highlightSelectedDate(date) {
  const allDateElements = document.querySelectorAll('.day'); // Select all day elements
  allDateElements.forEach(element => {
    // Compare each element's inner text with the selected date
    if (element.innerHTML.trim() === date) {
      element.classList.add('highlighted_date'); // Add the 'highlighted_date' class to the selected date
    }
  });
}

// Add event listener for input field focus
inputRemainder.addEventListener('focus', function() {
  isFocused = true;
});

// Add event listener for input field blur
inputRemainder.addEventListener('blur', function() {
  const textData = inputRemainder.value.trim();
  const selected_date = selectedDateDisplay.innerHTML.trim();

  if (isFocused && textData) {
    const formattedDate = new Date(selected_date).toISOString().split('T')[0]; // Format the date as YYYY-MM-DD
    submitRemainder(textData, formattedDate);
  }

  // Reset the focus flag after losing focus
  isFocused = false;
});

// Initialize the calendar
renderCalendar();
const dayElements = document.querySelectorAll('.day'); // Selecting all the day elements

dayElements.forEach(day => {
    day.addEventListener('click', function() {
        const selectedDate = selectedDateDisplay.innerHTML.trim(); 
        const formattedDate = new Date(selectedDate).toISOString().split('T')[0]; // Get the date directly from the clicked .day element
        console.log(selectedDate);
        
        if (!formattedDate) {
            alert("Please select a valid date.");
            return;
        }

        fetch(`get_remainder.php?date=${formattedDate}`)
        .then(response => {
            // Check the response status
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Return the parsed JSON
        })
        .then(data => {
            // Log the received data for debugging
            console.log("Received data from server:", data);
            
            // Display the reminder if found
            if (data.reminder) {
                console.log(data.reminder);
                document.getElementById('input_remainder').innerHTML = ` ${data.reminder}`;
            } else {
                document.getElementById('input_remainder').innerHTML = 'No reminder for this date.';
            }
        })
        .catch(error => {
            console.error('Error fetching reminder:', error);
        });
    });
});

const textarea = document.getElementById('input_remainder'); // The textarea where the reminder is displayed

// Event listener to detect when the text changes or is removed
textarea.addEventListener('input', function() {
    const reminderText = textarea.value.trim(); // Get the current text in the textarea
    const selectedDate = selectedDateDisplay.innerHTML.trim(); // Get the selected date from the display
    const formattedDate = new Date(selectedDate).toISOString().split('T')[0]; // Format the date as YYYY-MM-DD

    // If the reminder text is empty, delete it from the database
    if (reminderText === '') {
        fetch(`delete_remainder.php?date=${formattedDate}`, {
            method: 'GET', // You can use POST if required, depending on your backend
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            // Check if the deletion was successful or not
            if (data.success) {
                console.log('Reminder deleted successfully');
            } else {
                console.log('No reminder found to delete');
            }
        })
        .catch(error => {
            // Handle errors during the fetch operation
            console.error('Error deleting reminder:', error);
        });
    } else {
        // If the reminder text is not empty, send it to the server to update the reminder
        fetch('update_remainder.php', {
            method: 'POST', // Assuming POST method for adding/updating
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                selected_date: formattedDate,
                remainder_text: reminderText,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            // Check if the update was successful
            if (data.success) {
             
            } else {
                console.log('Failed to update reminder');
            }
        })
        .catch(error => {
            // Handle errors during the fetch operation
            console.error('Error updating reminder:', error);
        });
    }
});


fetch('remainder_color.php')
.then(response => response.json())
.then(data => {
    // Check if the response contains dates
    if (data.dates && data.dates.length > 0) {
        // Loop through each date in the response
        data.dates.forEach(date => {
            // Find all elements with the data-date attribute
            const dateElements = document.querySelectorAll('.date[data-date="' + date + '"]');
            
            // Loop through matched date elements and apply the yellow background
            dateElements.forEach(element => {
                element.classList.add('highlighted');
            });
        });
    } else {
        console.log('No dates found in the response.');
    }
})
.catch(error => console.error('Error fetching dates:', error));