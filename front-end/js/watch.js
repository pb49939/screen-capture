$(document).ready(function() {
  console.log("watch.js");

  d_getAllRecordingsByTaskID($("#taskID").val()).then(
    recordings => {
      buildTaskCardsHoldingRecordings(recordings);
    },
    () => {}
  );
});

function loadNewVideo(videoPath) {
  $("#recording-active").empty();
  buildVideoPlayer(videoPath);
}
