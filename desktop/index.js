var fs = null; 
try {
  fs = require('fs');
} catch(e) {
  console.log('Not in kansas anymore...');
}
// makeHousePlotDefault()
// @does creates a default plot object 
var makeHousePlotDefault = function() {
  return { 
    "x" : document.getElementById("width").value, 
    "y" : document.getElementById("height").value, 
    "data" : null 
  };
}

// TODO: If time permits, add flow option
// makeHousePlot(displayID)
// @displayID => id of container that will be used for making the house plot
// @does creates a modular sized house plot with the ability to save, and displays in all mode
var makeHousePlot = function(displayID) {
  var container = document.getElementById(displayID);
  var innards = '<div id="makeHouseController">';
  innards += '<input type="number" id="width" onchange="displayHousePlot(\'housePlot\', makeHousePlotDefault(), \'all\');" value="10">';
  innards += '<input type="number" id="height" onchange="displayHousePlot(\'housePlot\', makeHousePlotDefault(), \'all\');" value="5">';
  innards += '<button type="button" onclick="saveHousePlot(\'housePlotTableBody\')">Save</button>'; //initiate save dialogue
  innards += '<span>Total Count: <span id="makeHousePlotCount">50</span></span>';
  innards += '<input type="text" id="housePlotTitle">'
  innards += '</div>';
  innards += '<div id="housePlot"></div>';
  container.innerHTML = innards;
  displayHousePlot("housePlot", makeHousePlotDefault(), "all");
};

// TODO: Add docs for inc state, et al
var incrementState = function(me, isClick, mode){
  if (mouseDown || isClick) {
    var i = Number(me.getAttribute("data-state"));
    me.setAttribute("data-state", (i+1)%2);
    var count = document.getElementById('makeHousePlotCount');
    if (count) {
      count.innerHTML = Number(count.innerHTML) + i - ((i+1)%2);
    }
  }
};

// TODO: Add docs for house plot save
var saveHousePlot = function(displayID) {
  var container = document.getElementById(displayID);
  var tbody = container.children;
  var plot = makeHousePlotDefault();
  plot.data = [];
  for (var i = 1; i < tbody.length; ++i) {
    var innerChild = tbody[i].children;
    var row = [];
    for (var j = 1; j < innerChild.length; ++j) {
     row.push(innerChild[j].getAttribute('data-state'));
    }
    plot.data.push(row);
  }
  var filename = document.getElementById('housePlotTitle').value;
  if (!filename || filename == '') filename = 'housePlot'; //in case it doesn't exist, don't want to go making assumptions
  if (fs) {
    fs.writeFile('./plots/' + filename + '.json', JSON.stringify(plot), {'flag':'w+'});
  }
  console.log(plot.data);
}

// displayHousePlot(displayID)
// @displayID => id of container that will be used for making the house plot
// @plot      => object with .x, .y, .data objects inside
// @mode      => string mode of function (all, sold, unsold, reserved)
var displayHousePlot = function(displayID, plot, mode) {
  //TODO: Write algo for infinite lettering (A->Z, AA->AZ->ZZ, AAA->AAZ->AZZ->ZZZ, etc)
  var alpha = " ABCDEFGHIJKLMNOPQRSTUVWXYZ"
  var container = document.getElementById(displayID);
  var innards =   '<table id="housePlotTable">';
  innards += '<tbody id="housePlotTableBody">';
  for (var i = 0; i <= plot.y; ++i) {
    innards += '<tr>';
    for (var j = 0; j <= plot.x; ++j) {
      innards += "<td id = '" +i + "-" + j + "'"
      if (i != 0 && j != 0) {
        innards += " onclick='incrementState(this, true);'";
        innards += " onmouseover='incrementState(this);' data-state='0'";
      }
      innards += ">" + (i ? alpha[(plot.y-i+1)%26] : "")  + (j ? j : "") + "</td>";
    }
    innards += '</tr>';
  }
  innards += '</tbody></table>';
  container.innerHTML = innards;
};
// TODO: Make Show Function\n
// TODO: Add Performance Function
// TODO: Open Box Function / sell mode
// TODO: Add print ticket function
// TODO: Add print receipt function

var mouseDown = 0;
window.onload = function() {
  makeHousePlot("main");
  document.body.onmousedown = function() {
    mouseDown = 1;
  }
  document.body.onmouseup = function() {
    mouseDown = 0;
  }
};