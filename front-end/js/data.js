function d_saveNewUser(params) {
  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/addNewUser.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var user = JSON.parse(response);

        console.log(user);
        resolve(user);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_login(params) {
  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/authenticateUser.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        resolve(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_getAllTasks() {
  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/getAllTasks.php",
      type: "post",
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var tasks = JSON.parse(response);

        console.log(tasks);
        resolve(tasks);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_getAllTasksForUserTester(userID) {
  var params = new Object();
  params.userID = userID;

  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/getAllTasksForUserTester.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var tasks = JSON.parse(response);

        console.log(tasks);
        resolve(tasks);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_getAllRecordingsByTaskID(taskID) {
  var params = new Object();
  params.taskID = taskID;
  //params = JSON.stringify(params);

  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/getAllRecordingsByTaskID.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var recordings = JSON.parse(response);

        console.log(recordings);
        resolve(recordings);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_saveNewWebsite(websiteName, websiteURL) {
  var params = new Object();
  params.websiteName = websiteName;
  params.websiteURL = websiteURL;
  //params = JSON.stringify(params);

  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/addWebsite.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var website = JSON.parse(response);

        console.log(website);
        resolve(website);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_getAllWebsitesForUser(userID) {
  var params = new Object();
  params.userID = userID;

  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/getAllWebsitesForUser.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var websites = JSON.parse(response);

        console.log(websites);
        resolve(websites);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}

function d_getWebsiteInfoByWebsiteID(websiteID) {
  var params = new Object();
  params.websiteID = websiteID;

  var promiseObj = new Promise(function(resolve, reject) {
    request = $.ajax({
      url: "/screen-capture/BackEnd/requests/getWebsiteInfoByWebsiteID.php",
      type: "post",
      data: params,
      success: function(response, textStatus, jqXHR) {
        // Log a message to the console

        var websiteInfo = JSON.parse(response);

        console.log(websiteInfo);
        resolve(websiteInfo);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
        reject(errorThrown);
      }
    });
  });

  return promiseObj;
}
