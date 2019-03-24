$(document).ready(function() {
  console.log("watch.js");

  d_getAllRecordingsByTaskID($("#taskID").val()).then(
    recordings => {
      buildTaskCardsHoldingRecordings(recordings);
      buildDurationChart(recordings);
      buildPositiveFeelChart(recordings);
      calculateStats(recordings);
    },
    () => {}
  );
});

function loadNewVideo(videoPath) {
  $("#recording-active").empty();
  buildVideoPlayer(videoPath);
}

function buildDurationChart(recordings) {
  chartData = getDurationArrayFromRecordings(recordings);
  chartLabels = getUsernameArrayFromRecordings(recordings);
  chartBackgroundColors = getRepeatedBackgroundStylesForCharts(
    recordings,
    "background",
    0
  );
  chartBorderColors = getRepeatedBackgroundStylesForCharts(
    recordings,
    "border",
    0
  );
  var ctx = document.getElementById("duration").getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: chartLabels,
      datasets: [
        {
          label: "Session Duration to Complete This Task (seconds)",
          data: chartData,
          backgroundColor: chartBackgroundColors,
          borderColor: chartBorderColors,
          borderWidth: 1
        },
        {
          data: chartData,
          type: "line",
          backgroundColor: chartBackgroundColors
        }
      ]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true
            }
          }
        ]
      }
    }
  });
}

function buildPositiveFeelChart(recordings) {
  chartData = getPositveFeelArrayFromRecordings(recordings);
  var data = {
    datasets: [
      {
        data: chartData,
        backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)"],
        borderColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"]
      }
    ],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: ["Positive Fee", "Lacking Positive Feel"]
  };
  var ctx = document.getElementById("positive-feel").getContext("2d");
  var options = Chart.defaults.doughnut;
  var myDoughnutChart = new Chart(ctx, {
    type: "doughnut",
    data: data,
    options: options
  });
}

function calculateStats(recordings) {
  var durationArray = getDurationArrayFromRecordings(recordings);
  var mean = getMean(durationArray);
  var standardDeviation = getStandardDeviation(durationArray);
  var median = getMedian(durationArray);
  var mode = getMode(durationArray);
  var range = getRange(durationArray);

  $("#mean-val").text(roundUp(mean, 1));
  $("#standard-deviation-val").text(roundUp(standardDeviation, 1));
  $("#median-val").text(median);
  $("#mode-val").text(mode);
  $("#range-val").text(range);

  $("#upper-duration-threshold-val").text(recordings[0].UpperDurationThreshold);
  $("#lower-duration-threshold-val").text(recordings[0].LowerDurationThreshold);

  var positiveFeelArray = getPositveFeelArrayFromRecordings(recordings);
  var positiveFeel = positiveFeelArray[0] + "/" + recordings.length;
  var lackingPositiveFeel = positiveFeelArray[1] + "/" + recordings.length;

  $("#positive-feel-val").text(positiveFeel);
  $("#lacking-positive-feel-val").text(lackingPositiveFeel);
}
