//***************************************************************************************
// HOUSE PLOT MAKE / DISPLAY FUNCTIONS **************************************************
// **************************************************************************************

// makeHousePlotDefault()
// @does: creates a default plot object 
// @ret:  a plot object of form plot.title, plot.avail, plot.x, plot.y, plot.data 
var makeHousePlotDefault = function() {
  return { 
    "title" : document.getElementById('housePlotTitle') ? document.getElementById('housePlotTitle').value : "house_plot",
    "avail" : Number(document.getElementById('makeHousePlotCount')),
    "x" : Number(document.getElementById("width").value), 
    "y" : Number(document.getElementById("height").value), 
    "data" : null
  };
};

// resetCount()
// @does: resets Total Seat Count Variable
var resetCount = function() {
  var count = document.getElementById('makeHousePlotCount');
    if (count) {
      count.innerHTML = Number(document.getElementById("width").value)*Number(document.getElementById("height").value);
    }
};

// TODO: (10) If time permits, add flow option
// makeHousePlot(displayID)
// @takes:
// || displayID => id of container that will be used for making the house plot
// @does: creates a modular sized house plot with the ability to save, and displays in all mode
var makeHousePlot = function(displayID) {
  var container = document.getElementById(displayID);
  var innards = '<div id="makeHouseController">';
  innards += 'Columns:<input type="number" name="width" id="width" onchange="displayHousePlot(\'housePlot\', makeHousePlotDefault(), \'all\'); resetCount();" value="10" min="1" required>';
  innards += 'Rows:<input type="number" name="height" id="height" onchange="displayHousePlot(\'housePlot\', makeHousePlotDefault(), \'all\'); resetCount();" value="5" min="1" required>';
  innards += 'Filename:<input type="text" id="housePlotTitle">'
  innards += '<button type="button" onclick="saveHousePlot(\'housePlotTableBody\')">Save</button>'; //initiate save dialogue
  innards += '<span>Total: <span id="makeHousePlotCount">50</span></span>';
  innards += '</div>';
  innards += '<div id="housePlot"></div>';
  container.innerHTML = innards;
  displayHousePlot("housePlot", makeHousePlotDefault(), "all");
};

// TODO: (5) Add docs for inc state, et al
// TODO: (4) Add support for other inc state modes
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

// saveHousePlot(displayID)
// @takes:
// || displayID => id of container that will be used for making the house plot
// @does: stores house plot in displayID to localstorage/a file named housePlotTitle.value
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
  plot.avail = Number(document.getElementById('makeHousePlotCount'));
  var filename = document.getElementById('housePlotTitle').value;
  if (!filename || filename == '') filename = 'housePlot'; //in case it doesn't exist, don't want to go making assumptions
  if (fs) {
    fs.writeFile('./plots/' + filename + '.json', JSON.stringify(plot), {'flag':'w+'});
  }
  localStorage.tcktr = JSON.stringify(JSON.parse(localStorage.tcktr).plots.push(plot));
  console.log(plot.data);
}

// displayHousePlot(displayID)
// @takes:
// || displayID => id of container that will be used for making the house plot
// || plot      => object with .x, .y, .data objects inside
// || mode      => string mode of function (all, sold, unsold, reserved)
// @does: builds plot with mode in displayID
var displayHousePlot = function(displayID, plot, mode) {
  //TODO: (6) Write algo for infinite lettering (A->Z, AA->AZ->ZZ, AAA->AAZ->AZZ->ZZZ, etc)
  var alpha = " ABCDEFGHIJKLMNOPQRSTUVWXYZ"
  var container = document.getElementById(displayID);
  var innards =   '<table id="housePlotTable">';
  innards += '<tbody id="housePlotTableBody">';
  if (mode == 'all') {
    for (var i = 0; i <= plot.y; ++i) {
      innards += '<tr>';
      for (var j = 0; j <= plot.x; ++j) {
        innards += "<td id = '" + (i ? alpha[(plot.y-i+1)%26] : "")  + (j ? j : "") + "'"
        if (i != 0 && j != 0) {
          innards += " onclick='incrementState(this, true, \"all\");'";
          innards += " onmouseover='incrementState(this, false, \"all\");' data-state='0'";
        }
        innards += ">" + (i ? alpha[(plot.y-i+1)%26] : "")  + (j ? j : "") + "</td>";
      }
      innards += '</tr>';
    }
    innards += '</tbody></table>';
    container.innerHTML = innards;
  }
  // TODO: (4) Add other display modes for sales.
};

//***************************************************************************************
// SHOW OBJECT CREATION / CONFIG ********************************************************
// **************************************************************************************

var autocomplete;
function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// TODO: (1) Make Show Function
var makeShow = function(displayID) {
  var container = document.getElementById(displayID);
  var innards = "<form id='makeShowForm'>";
  innards += "<label for='makeShowFormTitle'>Title:</label>";
  innards += "<input type='text' id='makeShowFormTitle'>";
  innards += "<label for='makeShowFormPlot'>Plot:</label>";
  innards += "<input type='text' id='makeShowFormPlot' list='plots'>";
  innards += "<datalist id='plots'>";
  var plots = JSON.parse(localStorage.tcktr).plots;
  for (var i = 0; i < plots.length; ++i) {
    innards += "<option value='" + plots[i].title + "'>"
  }
  innards += "</datalist>"
  innards += "<label for='makeShowFormCompany'>Company:</label>";
  innards += "<input type='text' id='makeShowFormCompany'>";
  innards += "<label for='autocomplete'>Venue:</label>";
  innards += "<input id='autocomplete' placeholder='Enter your address' type='text'></input>";
  innards += "</form>";
  container.innerHTML = innards;
  initialize(); //init google map lookup
};

// TODO: (2) Add Performance Function
// TODO: (1) Make ticket function

//***************************************************************************************
// BOX OFFICE DISPLAY / PRINT / OPERATION ***********************************************
// **************************************************************************************

// TODO: (3) Open Box Function / sell mode
// TODO: (4) Add print ticket function
// TODO: (4) Add print receipt function


//***************************************************************************************
// MAIN MENU DISPLAY / CREATION *********************************************************
// **************************************************************************************

var makeMenu = function(displayID) {
  var container = document.getElementById(displayID);
  var innards = "<ul id='mainMenu'><div class='header'><h1>tcktr</h1><p>Behind the Scenes</p></div>";
  links = [
    { "t" : "Make House Plot", "o" : "makeHousePlot('" + displayID + "');"},
    { "t" : "Make Show", "o" : "makeShow('" + displayID + "');"},
    { "t" : "Manager Performances", "o" : "makeHousePlot('" + displayID + "');"},
    { "t" : "Open Boxoffice", "o" : "makeHousePlot('" + displayID + "');"},
    { "t" : "Settings", "o" : "makeHousePlot('" + displayID + "');"}
  ];
  for (var i = 0; i < links.length; ++i) {
    innards += '<li><a href="#" onclick="' + links[i].o + '">' + links[i].t + '</a></li>';
  }
  innards += "</ul>";
  container.innerHTML = innards;
}

// TODO: (5) var docs
var mouseDown = 0;
var fs = null;
var nw = true; 
// TODO: (5) onload docs
window.onload = function() {
  // track mouse state
  document.body.onmousedown = function() {
    mouseDown = 1;
  }
  document.body.onmouseup = function() {
    mouseDown = 0;
  }
  // determine browser set and set fs
  try {
  // running in node-webkit
    fs = require('fs');
  } catch(e) {
    // running in regular browser
    nw = false;
    console.log('Not in kansas anymore...');
  }
  if (localStorage.tcktr) {
    localStorage.tcktr = JSON.stringify({
      "plots" : [],
      "shows" : [],
      "tickets" : []
    });
  }
  makeMenu("main"); // build menu :)
};