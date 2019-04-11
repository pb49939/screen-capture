console.log("This is coming from screen-catpure chrome extension");

/* if (document.getElementById("tssPopup").value == "true") {
  var el = document.createElement("div");
  el.innerHTML = "THE SESSION SANCTUM CHROME EXTENSION";
  el.className += "session-sanctum-mount";
  el.id = "session-sanctum-mount";
  el.style.width = "350px";
  el.style.height = "300px";
  el.style.position = "fixed";
  el.style.right = "10px";
  el.style.top = "10px";
  el.style.backgroundColor = "#007bff";
  el.style.color = "white";
  el.style.borderRadius = "5px";
  el.style.opacity = ".5";

  document.body.appendChild(el);
} */

window.addEventListener("​testEvent", function() {
  alert("test!");
  console.log("test!");
});

var port = chrome.runtime.connect();

window.addEventListener(
  "message",
  function(event) {
    // We only accept messages from ourselves
    if (event.source != window) return;

    if (event.data.type && event.data.type == "FROM_PAGE") {
      console.log("Content script received: " + event.data.text);
      loadPopup(event.data.text);
      port.postMessage(event.data.text);
    }
  },
  false
);

function loadPopup(description) {
  var el = document.createElement("div");
  el.innerHTML = description;
  el.className += "session-sanctum-mount";
  el.id = "session-sanctum-mount";
  el.style.width = "350px";
  el.style.height = "300px";
  el.style.position = "fixed";
  el.style.right = "10px";
  el.style.top = "10px";
  el.style.backgroundColor = "#007bff";
  el.style.color = "white";
  el.style.borderRadius = "5px";
  el.style.opacity = ".5";
  el.style.zIndex = "1031";

  document.body.appendChild(el);
}

chrome.browserAction.getPopup(details, function() {
  console.log("test");
});
