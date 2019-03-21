let stream;
let mediaRecorder;
let chunks = [];
let videoStartTime;
let videoEndTime;
const video = document.getElementById("screen-view");

function play() {
  video.pause();
  video.currentTime = 0;
  video.play();
}

function initializeRecordExtension() {
  const EXTENSION_ID = "bhbnblpflpkjffjfkpnoajfnglaldmla";
  let videoSource;

  chrome.runtime.sendMessage(EXTENSION_ID, "version", response => {
    if (!response) {
      console.log("No extension");
      return;
    }
    console.log("Extension version: ", response.version);

    const getScreen = document.getElementById("get-screen");
    const stopScreen = document.getElementById("stop-screen");
    const request = {
      sources: ["window", "screen", "tab"]
    };

    getScreen.addEventListener("click", event => {
      chrome.runtime.sendMessage(EXTENSION_ID, request, response => {
        if (response && response.type === "success") {
          navigator.mediaDevices
            .getUserMedia({
              video: {
                mandatory: {
                  chromeMediaSource: "desktop",
                  chromeMediaSourceId: response.streamId
                }
              }
            })
            .then(returnedStream => {
              stream = returnedStream;
              mediaRecorder = new MediaRecorder(stream);

              mediaRecorder.start();

              videoStartTime = new Date();

              mediaRecorder.onstop = function(e) {
                console.log(
                  "data available after MediaRecorder.stop() called."
                );

                var blob = new Blob(chunks, {
                  type: "video/x-matroska;codecs=avc1"
                });

                chunks = [];

                video.srcObject = null;

                try {
                  video.srcObject = blob;
                } catch (error) {
                  video.src = window.URL.createObjectURL(blob);
                }

                var file = blobToFile(blob, "test123.mp4");

                uploadFile(file);

                console.log("recorder stopped");
              };

              mediaRecorder.ondataavailable = function(e) {
                chunks.push(e.data);
              };
              console.log(mediaRecorder.state);
              console.log("recorder started");

              try {
                video.srcObject = stream;
              } catch (error) {
                video.src = window.URL.createObjectURL(stream);
              }

              getScreen.style.display = "none";
              stopScreen.style.display = "inline";
            })
            .catch(err => {
              console.error("Could not get stream: ", err);
            });
        } else {
          console.error("Could not get stream");
        }
      });
    });

    stopScreen.addEventListener("click", event => {
      mediaRecorder.stop();

      videoEndTime = new Date();

      console.log(mediaRecorder.state);
      console.log("recorder stopped");
      stream.getTracks().forEach(track => track.stop());

      stopScreen.style.display = "none";
      getScreen.style.display = "inline";
    });
  });
}

function _(el) {
  return document.getElementById(el);
}

function uploadFile(file) {
  // alert(file.name+" | "+file.size+" | "+file.type);
  var positiveFeel = readCookie("POSITIVE_FEEL");
  var formdata = new FormData();
  formdata.append("file1", file);
  formdata.append("taskID", $("#taskID").val());
  formdata.append("positiveFeel", readCookie("POSITIVE_FEEL"));
  formdata.append("duration", (videoEndTime - videoStartTime) / 1000);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "../../BackEnd/file_upload_parser.php");
  ajax.send(formdata);
}

function progressHandler(event) {
  _("loaded_n_total").innerHTML =
    "Uploaded " + event.loaded + " bytes of " + event.total;
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
  _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
  Swal.fire({
    type: "success",
    title: "Success!",
    text: "Session recording uploaded",
    footer:
      '<div class="pretend-link">' +
      (videoEndTime - videoStartTime) / 1000 +
      " Seconds </div>"
  });
}

function errorHandler(event) {
  _("status").innerHTML = "Upload Failed";
  Swal.fire({
    type: "error",
    title: "Oops...",
    text: "Something went wrong!",
    footer: "<a href>Why do I have this issue?</a>"
  });
}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}

function blobToFile(theBlob, fileName) {
  //A Blob() is almost a File() - it's just missing the two properties below which we will add
  theBlob.lastModifiedDate = new Date();
  theBlob.name = fileName;
  return theBlob;
}
