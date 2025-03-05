let currentDate = new Date();
let selectedDays = [4, 5, 8, 9, 11, 12, 16]; // Example: Pre-selecting the first 3 days
let clickedDay = null;  // Variable to store clicked date
let lastClickedDay = null; // Store the previously clicked day to reset its background color

// Store the elements
const calendarDays = document.getElementById("calendarDays");
 // Ensure this exists in your HTML
const calendarContainer = document.getElementById("calendarContainer");
const selectedDateDisplay = document.getElementById("eventDetails");  // Calendar container

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
let isFocused = false; // Declare the isFocused variable

// Make sure inputRemainder exists
 // Make sure selectedDateDisplay exists

renderCalendar();
 // Display area for selected date
 const selected_date=selectedDateDisplay.innerHTML;
const inputRemainder = document.getElementById('input_remainder'); 
 const textData=inputRemainder.value;
// Add an event listener for the focus event
inputRemainder.addEventListener('focus', function() {
  isFocused = true;
});

// Add an event listener for the blur event
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
    // Show success message
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: 'Remainder submitted successfully!',
    });

    inputRemainder.value = ''; // Clear input field after submission
  })
  .catch((error) => {
    console.error('Error:', error);
    // Show error message if something goes wrong
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong while submitting the remainder.',
    });
  });
}
