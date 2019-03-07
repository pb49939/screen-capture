//dynamically buildling markup with javascript

//we are trying to build and remove DOM elements in this file

function render(
  elementType,
  parentID,
  innerHTML,
  className,
  ID,
  onclick,
  href
) {
  if (typeof onclick !== "undefined" && onclick !== null && onclick !== "") {
    renderButton(elementType, parentID, innerHTML, className, ID, onclick);
  } else if (typeof href !== "undefined" && href !== null && href !== "") {
    renderAnchor(elementType, parentID, innerHTML, className, ID, href);
  } else {
    var container = document.getElementById(parentID);
    var el = document.createElement(elementType);
    el.innerHTML = innerHTML;
    el.className += className;
    el.id = ID;
    container.appendChild(el);
  }
}

function renderButton(
  elementType,
  parentID,
  innerHTML,
  className,
  ID,
  onclick
) {
  var container = document.getElementById(parentID);
  var el = document.createElement(elementType);
  el.innerHTML = innerHTML;
  el.className += className;
  el.id = ID;
  el.setAttribute("onclick", onclick);
  container.appendChild(el);
}

function renderOptions(parentID, innerHTML, val) {
  var select = document.getElementById(parentID);
  var opt = document.createElement("option");
  opt.value = val;
  opt.innerHTML = innerHTML;
  select.appendChild(opt);
}

function renderAnchor(elementType, parentID, innerHTML, className, ID, href) {
  var container = document.getElementById(parentID);
  var el = document.createElement(elementType);
  el.innerHTML = innerHTML;
  el.className += className;
  el.id = ID;
  el.setAttribute("href", href);
  container.appendChild(el);
}

function renderHtmlAsString(parentID, htmlVal) {
  var container = document.getElementById(parentID);
  var el = document.createTextNode(htmlVal);
  container.appendChild(el);
}

//if performance of rendering to DOM becomes slow, consider building a singular string containing all DOM elements to be rendered at any single time to only reach into DOM once
