<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="../js/md5.js" type="text/javascript"></script>
<script>
 
function reqListener() {
console.log(this.responseText);
}
// Create the XHR object.
function createCORSRequest(method, url) {
var xhr = new XMLHttpRequest();
if ("withCredentials" in xhr) {
// XHR for Chrome/Firefox/Opera/Safari.
xhr.open(method, url, true);
} else if (typeof XDomainRequest != "undefined") {
// XDomainRequest for IE.
xhr = new XDomainRequest();
xhr.open(method, url);
} else {
// CORS not supported.
xhr = null;
}
return xhr;
}

// Helper method to parse the title tag from the response.
function getTitle(text) {
return text.match('/campaign');
}

makeCorsRequest();
// Make the actual CORS request.
function makeCorsRequest() {
// This is a sample server that supports CORS.
var url = 'http://modicare.com/default.aspx';

var xhr = createCORSRequest('GET', url);
if (!xhr) {
alert('CORS not supported');
return;
 }

 // Response handlers.
xhr.onload = function() {
var text = xhr.responseText;
var title = getTitle(text);
alert('Response from CORS request to ' + url + ': ' + title);
 };

xhr.onerror = function() {
alert('Woops, there was an error making the request.');
};
 xhr.send();
}
 
 </script>