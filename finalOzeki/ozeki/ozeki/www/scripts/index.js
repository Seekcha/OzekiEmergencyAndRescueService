var latitude = "";
var longitude = "";
var message = "";
var newmessage = "";

document.addEventListener("deviceready", onDeviceReady, false);

// device APIs are available
function onDeviceReady() {
    var options = {
        maximumAge: 3600000,
        timeout: 3000, //getting position every 3 seconds
        enableHighAccuracy: true,
    }
    navigator.geolocation.watchPosition(onSuccess, onError,options);
}

// onSuccess Geolocation
function onSuccess(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    
}

// onError Callback receives a PositionError object
function onError(error) {
  alert('code: ' + error.code + '\n' +
        'message: ' + error.message + '\n');
}

var app = {
    sendSms: function () {
        var number = document.getElementById('numberTxt').value;;
        var message = document.getElementById('messageTxt').value;
        console.log("number=" + number + ", message= " + message);

        //CONFIGURATION
        var options = {
            replaceLineBreaks: false, // true to replace \n by a new line, false by default
            android: {
                intent: 'INTENT'  // send SMS with the native android SMS messaging
                //intent: '' // send SMS without open any other app 
            }
        };

        newmessage = latitude + ";" + longitude  + " ;"   + message ;
        var success = function () { alert('Message sent successfully'); };
        var error = function (e) { alert('Message Failed:' + e); };
        sms.send(number, newmessage, options, success, error);
    }
};
