var tasksGlobal;
$(document).ready(function() {
  setActivePage("user-tester");

  var websiteID = $("#websiteID").val();

  d_getAllTasksForUserTester(websiteID).then(
    tasks => {
      tasksGlobal = tasks;
      buildTaskList(tasks);
      buildTaskCardsForUserTester(tasks);
      initializeRecordExtension();
    },
    () => {}
  );
});

function startRecordingFlow(taskID, description) {
  Swal.fire({
    title: "<strong>Record a Session</strong>",
    type: "info",
    html:
      "You will be asked to use our Browser Extension to share your screen with us. <br /> " +
      description,
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      "<a href='https://" +
      tasksGlobal[0].WebsiteURL +
      "' target='blank'><span style='color: white;'>Record</span></a>",
    cancelButtonText: "Cancel"
  }).then(result => {
    if (result.value) {
      $("#taskID").val(taskID);
      $("#get-screen").click();
      //populate the descriptions for the pop up
      $("#taskDescription").val(description);

      Swal.fire({
        title: "<strong>Stop Recording</strong>",
        type: "info",
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText:
          '<div onClick=""><i class="fas fa-stop"></i> Stop</div>'
      }).then(result => {
        if (result.value) {
          Swal.fire({
            title: "<strong>How did it go?</u></strong>",
            type: "info",
            html: "How did you feel using the application for this task?",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-thumbs-up"></i> <span style="color: white;">Great!</span>',
            confirmButtonAriaLabel: "Thumbs up, great!",
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> Not Great...',
            cancelButtonAriaLabel: "Thumbs down"
          }).then(result => {
            let positiveFeel = false;
            if (result.value) {
              positiveFeel = true;
            }

            if (positiveFeel) {
              setCookie("POSITIVE_FEEL", true);
            } else {
              setCookie("POSITIVE_FEEL", false);
            }

            $("#stop-screen").click();
          });
        }
      });
    }
  });
}
