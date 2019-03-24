function roundUp(num, precision) {
  precision = Math.pow(10, precision);
  return Math.ceil(num * precision) / precision;
}

function getDurationArrayFromRecordings(recordings) {
  recordingsDuration = [];
  for (var i = 0; i < recordings.length; i++) {
    recordingsDuration.push(parseInt(recordings[i].Duration));
  }

  return recordingsDuration;
}

function getUsernameArrayFromRecordings(recordings) {
  recordingsUsername = [];
  for (var i = 0; i < recordings.length; i++) {
    recordingsUsername.push(recordings[i].Username);
  }

  return recordingsUsername;
}

function getRepeatedBackgroundStylesForCharts(
  data,
  styleType,
  colorArrayIndexer
) {
  var opacity;
  if (styleType === "background") {
    opacity = "0.2";
  } else if (styleType === "border") {
    opacity = "1";
  }
  var colorArray = [
    "rgba(255, 99, 132, " + opacity + ")",
    "rgba(54, 162, 235, " + opacity + ")",
    "rgba(255, 206, 86, " + opacity + ")",
    "rgba(75, 192, 192, " + opacity + ")",
    "rgba(153, 102, 255, " + opacity + ")",
    "rgba(255, 159, 64, " + opacity + ")"
  ];

  recordingsBackgroundColor = [];
  for (var i = 0; i < data.length; i++) {
    if (colorArrayIndexer === 6) {
      colorArrayIndexer = 0;
    }
    recordingsBackgroundColor.push(colorArray[colorArrayIndexer]);
    colorArrayIndexer++;
  }
  return recordingsBackgroundColor;
}

function getPositveFeelArrayFromRecordings(recordings) {
  positiveFeel = [];
  var positiveFeelCount = 0;
  for (var i = 0; i < recordings.length; i++) {
    positiveFeelCount += parseInt(recordings[i].PositiveFeel, 10);
  }

  positiveFeel.push(positiveFeelCount);
  positiveFeel.push(recordings.length - positiveFeelCount);

  return positiveFeel;
}

//accepts an array of numbers
function getMean(numbers) {
  var total = 0,
    i;
  for (i = 0; i < numbers.length; i += 1) {
    total += numbers[i];
  }
  return total / numbers.length;
}

//accepts an array of numbers
function getMedian(numbers) {
  // median of [3, 5, 4, 4, 1, 1, 2, 3] = 3
  var median = 0,
    numsLen = numbers.length;
  numbers.sort();

  if (
    numsLen % 2 ===
    0 // is even
  ) {
    // average of two middle numbers
    median = (numbers[numsLen / 2 - 1] + numbers[numsLen / 2]) / 2;
  } else {
    // is odd
    // middle number only
    median = numbers[(numsLen - 1) / 2];
  }

  return median;
}

//accepts an array of numbers
function getMode(numbers) {
  // as result can be bimodal or multi-modal,
  // the returned result is provided as an array
  // mode of [3, 5, 4, 4, 1, 1, 2, 3] = [1, 3, 4]
  var modes = [],
    count = [],
    i,
    number,
    maxIndex = 0;

  for (i = 0; i < numbers.length; i += 1) {
    number = numbers[i];
    count[number] = (count[number] || 0) + 1;
    if (count[number] > maxIndex) {
      maxIndex = count[number];
    }
  }

  for (i in count)
    if (count.hasOwnProperty(i)) {
      if (count[i] === maxIndex) {
        modes.push(Number(i));
      }
    }

  var modes = modes.sort();

  return modes[modes.length - 1];
}

//accepts an array of numbers
function getRange(numbers) {
  numbers.sort();
  return numbers[numbers.length - 1] - [numbers[0]];
}

function getStandardDeviation(values) {
  var avg = average(values);

  var squareDiffs = values.map(function(value) {
    var diff = value - avg;
    var sqrDiff = diff * diff;
    return sqrDiff;
  });

  var avgSquareDiff = average(squareDiffs);

  var stdDev = Math.sqrt(avgSquareDiff);
  return stdDev;
}

function average(data) {
  var sum = data.reduce(function(sum, value) {
    return sum + value;
  }, 0);

  var avg = sum / data.length;
  return avg;
}

function setCookie(cookieName, cookieValue) {
  var date = new Date("Februari 10, 2020");
  var dateString = date.toGMTString();
  var cookieString = cookieName + "=" + cookieValue;
  document.cookie = cookieString;
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function trimString(string, trimLength) {
  if (string.length > trimLength - 1) {
    var trimmedString = string.substring(0, trimLength);
    trimmedString += "...";
  }

  return trimmedString || string;
}
