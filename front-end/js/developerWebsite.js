$(document).ready(function() {
  console.log("index.js");

  setActivePage("developer");

  d_getAllTasks().then(
    tasks => {
      buildTaskList(tasks);
      buildTaskCards(tasks);
    },
    () => {}
  );
});
