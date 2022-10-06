<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="5; url={{ $link->link }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Redirecting to {{ $link->shortlink }}</title>
</head>
<body>
    <div class="container mx-auto my-5">
    <p>Redirecting you in <span id="count"></span></p>
    <h4>Redirecting you to <strong id="strip"></strong></h4>
    <p>Nama link: {{ $link->name }}</p>
    </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var timeleft = 5;
    var redirTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(redirTimer);
    document.getElementById("count").innerHTML = "Now";
  } else {
    document.getElementById("count").innerHTML = timeleft + " seconds";
  }
  timeleft -= 1;
}, 1000);
const url = '{{ $link->link }}';
const { hostname } = new URL(url);
$(document).ready(function () {
  $('#strip').text(hostname);
});
</script>
</html>