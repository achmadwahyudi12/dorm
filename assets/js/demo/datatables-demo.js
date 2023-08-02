// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    columnDefs: [
      {
        targets: '_all', // Apply to all columns
        orderable: false, // Disable sorting
      }
    ]
  });
});
