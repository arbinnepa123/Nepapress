
// $(function () {

//   $("#datepicker").datepicker();

//   dateFormat: "MM d, yy"

// });


// // const datePicker = document.getElementById("datepicker");

// // // Add event listener to input element
// // datePicker.addEventListener("focus", function() {
// //   // Create a date picker element
// //   const picker = document.createElement("input");
// //   picker.type = "date";
  
// //   // Set up change event listener
// //   picker.addEventListener("change", function() {
// //     // Get selected date from date picker
// //     const selectedDate = picker.value;
// //     console.log("Selected date:", selectedDate);
    
// //     // Set the selected date as the input value
// //     datePicker.value = selectedDate;
    
// //     // Remove the date picker element
// //     picker.parentNode.removeChild(picker);
// //   });
  
// //   // Trigger click event on date picker element
// //   picker.click();
// // });
// // jQuery(document).ready(function($) {
// //   $("#my-date-picker").datepicker({
// //     dateFormat: "mm/dd/yy", // Customize the date format as desired
// //     changeYear: true, // Enable year dropdown
// //     yearRange: "1900:2030" // Customize the year range as desired
// //   });
// // });

jQuery(document).ready(function($) {
  $("#my-date-picker").datepicker({
    dateFormat: "mm/dd/yy", // Customize the date format as desired
    changeYear: true, // Enable year dropdown
    yearRange: "1900:2030" // Customize the year range as desired
  });
});
