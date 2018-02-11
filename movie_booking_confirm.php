<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'database.php';
        $selectedSeats = array();
    ?>
    <meta charset="UTF-8">
    <title>Home </title>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">

    </style>

    <script type="text/javascript">
        
        $(document).ready(function() {
            
            function set_cookie(name, value) {
              document.cookie = name +'='+ value +'; Path=/;';
            }

            function delete_cookie(name) {
              document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }

            function getCookie(name) 
            {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return "";
            }

            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }

      
        });
    </script>
</head>

<?php
    $seatString = urldecode($_GET["seats"]);
    $show_id = $_GET["show_id"];

    $bookings = array();
    $seats = explode(",", $seatString);
    for($i = 0; $i < count($seats) - 1; $i++) {
        $bookings[$i] = array();
        $bookings[$i]["seat_id"] = $seats[$i];
        $bookings[$i]["show_id"] = $show_id;
        $bookings[$i]["user_id"] = 1;
    }

    //TODO check if the seat is already not booked
    insertBooking($bookings);

    $showDetails = getShow($show_id)->fetch_assoc();

    $movieId = $showDetails["movie_id"];
    $screenId = $showDetails["screen_id"];
    $startTime = $showDetails["start_time"];

    $screenDetails = getScreenDetails($screenId)->fetch_assoc();
    $screenName = $screenDetails["screen_name"];
    $theatreId = $screenDetails["theatre_id"];
    $theatreDetails = getTheatreDetails($theatreId)->fetch_assoc();
    $theatreName = $theatreDetails["name"];
    $city = $theatreDetails["city"];
    
?>

<body>
     <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Online Movie Booking </a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="http://localhost:9000/movie_booking_home.php">Home</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid" >
       Your Booking is confirmed <br>
       Seats -  <b>
           <?php 
                for($i = 0; $i < count($seats); $i++) {
                    echo $seats[$i];
                    if($i != count($seats) -1) {
                        echo ", ";
                    }
                }
            ?>
       </b>                      <br>
       Screen -      <?php echo $screenName; ?>            <br>
       Show Timing - <?php echo $startTime; ?>             <br>
       Theatre -     <?php echo $theatreName . " " . $city; ?>            <br>
    </div>

</body>
</html>
