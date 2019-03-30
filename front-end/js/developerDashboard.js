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
  for (var j = 0; j < websites.length; j++) {
    d_getWebsiteInfoByWebsiteID(websites[j].WebsiteID).then(
      websiteInfo => {
        if (websiteInfo !== null && websiteInfo.length > 0) {
          var renderNodeID = "website-chart-" + websiteInfo[0].WebsiteID;
          var ctx = document.getElementById(renderNodeID);

          var sessionsArr = getSessionArrayFromTasks(websiteInfo);
          $("#website-sessions-total-" + websiteInfo[0].WebsiteID).text(
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
        }
      },
      () => {}
    );
  }
}
