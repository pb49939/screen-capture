$(document).ready(function() {
  console.log("index.js");

  setActivePage("developer");

  var websiteID = $("#websiteID").val();

  d_getAllTasksByWebsiteID(websiteID).then(
    tasks => {
      buildTaskList(tasks);
      buildTaskCards(tasks);
    },
    () => {}
  );
});
