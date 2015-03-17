function get_location() {
  if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(get_coord, display_err);
    } else {
       $("#alerts").append("<div class='alert alert-danger' role='alert'>Warning! Geolocation not supported in this browser</div>");
    }
};

function get_coord(position) {
  var temperature=0;
  var lat1 = position.coords.latitude;
  var long1 = position.coords.longitude;
                                
    var options = {
    zoom: 10,
    center: new google.maps.LatLng(lat1, long1),
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"),options);
};

function display_err(err){
    if(err.code==1){
        $("#alerts").append("<div class='alert alert-info' role='alert'> Permission Denied</div>");
    }
    else if(err.code==2){
        $("#alerts").append("<div class='alert alert-info' role='alert'> Position Unavailable</div>");
    }
    else if(err.code==3){
        $("#alerts").append("<div class='alert alert-info' role='alert'> Request Timeout</div>");
    }
};

get_location();
