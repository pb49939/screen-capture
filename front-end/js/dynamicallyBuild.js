function buildTaskList(tasks) {
  for (var i = 0; i < tasks.length; i++) {
    render(
      "a",
      "task-list",
      tasks[i].TaskName,
      "list-group-item",
      "task-" + tasks[i].TaskID,
      "",
      "#"
    );
  }
}

function buildTaskCards(tasks) {
  render(
    "div",
    "task-card-container",
    "",
    "row",
    "task-card-container-row",
    "",
    "#"
  );

  for (var i = 0; i < tasks.length; i++) {
    //for demo only, needs to be actually built out later

    var status;
    var image = tasks[i].TaskImagePath || tasks[0].TaskImagePath;
    var avgDuration;
    var avgPositiveFeel;
    var borderClass;

    if (tasks[i].TotalSessions == 0) {
      avgDuration = 0;
      avgPositiveFeel = 0;
    } else {
      avgDuration = roundUp(
        parseInt(tasks[i].TotalDuration) / parseInt(tasks[i].TotalSessions),
        1
      );

      avgPositiveFeel =
        roundUp(
          parseInt(tasks[i].TotalPositiveFeel) /
            parseInt(tasks[i].TotalSessions),
          2
        ) * 100;
    }

    let tooLong = parseInt(tasks[i].UpperDurationThreshold);
    let sortOfLong = parseInt(tasks[i].LowerDurationThreshold);

    if (avgDuration > tooLong) {
      borderClass = "border-bad";
    } else if (avgDuration > sortOfLong) {
      borderClass = "border-caution";
    } else {
      borderClass = "border-good";
    }

    if (avgPositiveFeel < 50) {
      borderClass = "border-bad";
    } else if (avgPositiveFeel < 75) {
      borderClass = "border-caution";
    }

    var description = tasks[i].TaskDescription || "No Description";

    var watchPath =
      "watch.php?tid=" +
      tasks[i].TaskID +
      "&af=[WILL_BE_ENCRYPTED:" +
      tasks[i].TaskID +
      "ANTI_FORGERY_KEY]";

    if (description !== null && description.length > 60) {
      description = description.substring(0, 60) + "...";
    }

    render(
      "div",
      "task-card-container-row",
      "",
      "col-lg-4 col-md-6 mb-4",
      "task-card-container-col-lg-4-col-md-6-mb-4-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-container-col-lg-4-col-md-6-mb-4-" + tasks[i].TaskID,
      '<a href="#"><img class="card-img-top card-task-img" src="' +
        image +
        '" alt="" / ></a>',
      "card h-100 " + borderClass + " card-task ",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      '<h4 class="card-title"> <a href = "' +
        watchPath +
        '" >' +
        tasks[i].TaskName +
        '</a> </h4><h5>alphasigs.org/</h5> <p class="card-text">' +
        description +
        "</p>",
      "card-body",
      "task-card-containercard-card-body-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      '<small class="text-muted">' +
        tasks[i].TotalSessions +
        " Sessions</small><br />" +
        '<small class="text-muted">' +
        avgDuration +
        " Seconds Avg.</small><br /> " +
        '<small class="text-muted">' +
        avgPositiveFeel +
        "% Positive Feel</small>",
      "card-footer",
      "task-card-containercard-card-footer-" + tasks[i].TaskID,
      "",
      "#"
    );
  }
}

function buildTaskCardsForUserTester(tasks) {
  render(
    "div",
    "task-card-container",
    "",
    "row",
    "task-card-container-row",
    "",
    "#"
  );

  for (var i = 0; i < tasks.length; i++) {
    //for demo only, needs to be actually built out later

    var status;
    var image = tasks[i].TaskImagePath || tasks[0].TaskImagePath;
    var tempID;

    tempID = "get-screen" + i;

    if (i % 4 === 0) {
      status = "bad";
      // image = "../images/asp-register.png";
    } else if (i % 2 == 0) {
      status = "good";
      // image = "../images/asp-login.png";
    } else {
      status = "caution";
      //image = "../images/asp-excuse-screenshot.png";
    }

    var description = tasks[i].TaskDescription || "No Description";

    if (description !== null && description.length > 60) {
      description = description.substring(0, 60) + "...";
    }

    render(
      "div",
      "task-card-container-row",
      "",
      "col-lg-4 col-md-6 mb-4",
      "task-card-container-col-lg-4-col-md-6-mb-4-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-container-col-lg-4-col-md-6-mb-4-" + tasks[i].TaskID,
      '<a href="#"><img class="card-img-top card-task-img" src="' +
        image +
        '" alt="" / ></a>',
      "card h-100 border-" + status + " card-task ",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      '<h4 class="card-title"> <div class="pretend-link" id="' +
        tempID +
        '"onclick="startRecordingFlow(' +
        tasks[i].TaskID +
        ')">' +
        tasks[i].TaskName +
        '</div> </h4><h5>alphasigs.org/</h5> <p class="card-text">' +
        description +
        "</p>",
      "card-body",
      "task-card-containercard-card-body-" + tasks[i].TaskID,
      "",
      "#"
    );

    render(
      "div",
      "task-card-containercard-h-100 border-bad-card-task-" + tasks[i].TaskID,
      '<small class="text-muted">' +
        tasks[i].TotalSessions +
        " Sessions</small>",
      "card-footer",
      "task-card-containercard-card-footer-" + tasks[i].TaskID,
      "",
      "#"
    );
  }
}

function buildTaskCardsHoldingRecordings(recordings) {
  let duration;
  let tooLong;
  let sortOfLong;
  let borderClass;
  let recordingPath;
  for (var i = 0; i < recordings.length; i++) {
    duration = parseInt(recordings[i].Duration);
    tooLong = parseInt(recordings[i].UpperDurationThreshold);
    sortOfLong = parseInt(recordings[i].LowerDurationThreshold);

    if (duration > tooLong) {
      borderClass = "border-bad";
    } else if (duration > sortOfLong) {
      borderClass = "border-caution";
    } else {
      borderClass = "border-good";
    }

    recordingPath = recordings[i].RecordingPath;

    render(
      "div",
      "task-cards-holding-recordings-row",
      '<div class="card h-100 ' +
        borderClass +
        ' card-task-recording">' +
        '<a href="#" onClick ="loadNewVideo(\'' +
        recordingPath +
        '\')"> <img class="card-img-top card-task-img" src="images/asp-register.png" alt=""></a>' +
        '<div class="card-body"><h4 class= "card-title" ><div onClick ="loadNewVideo(\'' +
        recordingPath +
        "')\" >" +
        recordings[i].Duration +
        " seconds</div></h4 ></div >" +
        '<div class="card-footer"><small class= "text-muted"> Session of prbaldwin7</small ></div ></div>',
      "",
      "task-cards-holding-recordings-" + recordings[i].RecordingID,
      "",
      "#"
    );
  }
}

function buildVideoPlayer(videoPath) {
  render(
    "div",
    "recording-active",
    '<video class="d-block img-fluid dash-hero-img" alt="First slide" controls="" autoplay="" name = "media" id = "screen-view" ><source id="recording-source" src="' +
      videoPath +
      '" type="video/webm"></video>',
    "carousel-item active",
    "",
    "",
    "#"
  );
}
