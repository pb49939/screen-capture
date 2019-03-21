$(document).ready(function() {
  console.log("userTester.js");

  d_getAllTasks().then(
    tasks => {
      buildTaskList(tasks);
      buildTaskCardsForUserTester(tasks);
      initializeRecordExtension();
    },
    () => {}
  );
});

function startRecordingFlow(taskID) {
  Swal.fire({
    title: "<strong>Record a Session</strong>",
    type: "info",
    html:
      "You will be asked to use our Browser Extension to share your screen with us.",
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<div onClick=""<i class="fa fa-thumbs-up" id="get-screen"></i> Record</div>',
    cancelButtonText: '<i class="fa fa-thumbs-down"></i> Cancel'
  }).then(result => {
    if (result.value) {
      $("#taskID").val(taskID);
      $("#get-screen").click();

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
            confirmButtonText: '<i class="fa fa-thumbs-up">Great!</i>',
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
