$(document).ready(function() {
  setActivePage("developer-dashboard");

  d_getAllWebsitesForUser(1).then(
    websites => {
      buildDeveloperDashboard(websites);
      buildWebsiteChart(websites);
    },
    () => {}
  );
});

function buildWebsiteChart(websites) {
  var promiseResolveCounter = 0;
  for (var j = 0; j < websites.length; j++) {
    d_getWebsiteInfoByWebsiteID(websites[j].WebsiteID).then(
      websiteInfo => {
        var ctx = document.getElementById(
          "website-chart-" + promiseResolveCounter
        );

        var sessionsArr = getSessionArrayFromTasks(websiteInfo);
        $("#website-sessions-total-" + promiseResolveCounter).text(
          getSumOfNumberArray(sessionsArr)
        );
        var taskNameArr = getTaskNameArrayFromTasks(websiteInfo);
        var chartBackgroundColors = getRepeatedBackgroundStylesForCharts(
          websiteInfo,
          "background",
          0
        );
        var chartBorderColors = getRepeatedBackgroundStylesForCharts(
          websiteInfo,
          "border",
          0
        );
        promiseResolveCounter++;
        var myChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: taskNameArr,
            datasets: [
              {
                label: "Number of User Tester's Sessions",
                data: sessionsArr,
                backgroundColor: chartBackgroundColors,
                borderColor: chartBorderColors,
                borderWidth: 1
              }
            ]
          },
          options: {
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
      },
      () => {}
    );
  }
}
