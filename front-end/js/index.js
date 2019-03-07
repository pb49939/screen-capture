$(document).ready(function () {
  console.log("index.js");

  d_getAllTasks().then(
    tasks => {
      buildTaskList(tasks);
      buildTaskCards(tasks)
    },
    () => {}
  );
});