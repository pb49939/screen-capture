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

$("#btn-add-task").click(function() {
  var websiteID = $("#websiteID").val();
  addTaskFlow(websiteID);
});

function addTaskFlow(websiteID) {
  Swal.mixin({
    input: "text",
    confirmButtonText: "Next &rarr;",
    showCancelButton: true,
    progressSteps: ["1", "2", "3", "4", "5", "6", "7"]
  })
    .queue([
      {
        title: "Task Name",
        text: 'ex. "Register for a class"'
      },
      {
        title: "Task URL",
        text: 'ex. "www.testwebsite.com/register"'
      },
      {
        title: "Task Screenshot",
        text:
          "This is optional, but can be helpful to reasure that testers are at the right spot in your website"
      },
      {
        title: "Task Description",
        text:
          "Describe what you want the user to acomplish fo this task. This is where you should include any test accounts for testers to log into you app with."
      },
      {
        title: "Upper Duration Threshold",
        text: "How many seconds is too long for a user to acomploish this task?"
      },
      {
        title: "Lower Duration Threshold",
        text:
          "How many seconds do you expect experienced users to take to acomplish this task?"
      },
      {
        title: "Desired Session Count",
        text:
          "How many user sessions would you like us to implement and record on your behalf?"
      }
    ])
    .then(result => {
      if (result.value) {
        Swal.fire({
          title: "All done!",
          html:
            "Your answers: <pre><code>" +
            JSON.stringify(result.value) +
            "</code></pre>",
          confirmButtonText: "Lovely!"
        });

        var taskName = result.value[0];
        var taskURL = result.value[1];
        var taskImagePath = result.value[2];
        var taskDescription = result.value[3];
        var taskUpperDuration = result.value[4];
        var taskLowerDuration = result.value[5];
        var taskSessions = result.value[6];

        var params = new Object();
        params.websiteID = websiteID;
        params.taskName = taskName;
        params.taskURL = taskURL;
        params.taskImagePath = taskImagePath;
        params.taskDescription = taskDescription;
        params.taskUpperDuration = taskUpperDuration;
        params.taskLowerDuration = taskLowerDuration;
        params.taskSessions = taskSessions;

        d_addNewTaskByWebsiteID(params).then(
          task => {
            d_getAllTasksByWebsiteID(websiteID).then(
              tasks => {
                buildTaskList(tasks);
                buildTaskCards(tasks);
              },
              () => {}
            );
          },
          () => {}
        );
      }
    });
}
