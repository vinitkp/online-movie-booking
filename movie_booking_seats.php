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
        .seat-vacant {
            width : 20px;
            height : 20px;
            border: 2px solid red;
            float: left;
            margin:5px;
            background: white;
        }

        .seat-booked {
            width : 20px;
            height : 20px;
            background: #333;
            float: left;
            margin:5px;
        }

        .seat-selected {
            width : 20px;
            height : 20px;
            border: 2px solid red;
            background: red;
            float: left;
            margin:5px;
        }

    </style>

    <script type="text/javascript">
        
        $(document).ready(function() {
            delete_cookie('selectedSeats');

            var selectedSeats = [];
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

            $(".table").on("click", ".seat-vacant", function(e) {
                $(this).removeClass('seat-vacant');
                $(this).addClass('seat-selected');
                var selectedSeatId = $(this).attr('id');
                if(selectedSeats.indexOf(selectedSeatId) == -1) {
                    selectedSeats.push(selectedSeatId);
                }
                console.log(selectedSeats);
                //set_cookie('selectedSeats', getCookie('selectedSeats') + "," + selectedSeatId);
            });

            $(".table").on("click", ".seat-selected", function(e) {
                $(this).removeClass('seat-selected');
                $(this).addClass('seat-vacant');
                var selectedSeatId = $(this).attr('id');
                var index = selectedSeats.indexOf(selectedSeatId);
                if(index > -1) {
                    selectedSeats.splice(index, 1);
                }
                console.log(selectedSeats);
                //set_cookie('selectedSeats', getCookie('selectedSeats') + "," + selectedSeatId);
            });

            $("#book").click(function(e) {
                var stringifiedSelectedSeats = "";
                selectedSeats.forEach(function(e) {
                    stringifiedSelectedSeats = stringifiedSelectedSeats + e + ",";
                });
                if(stringifiedSelectedSeats.length == 0) {
                    alert("no seats selected");
                    return;
                }

                var hostname = $(location).attr("host");
                var href = $(location).attr("href");
                var path = $(location).attr("pathname");
                var protocol = $(location).attr("protocol") + "//";

                var showId = getParameterByName("show_id");

                var url = protocol + hostname + "/movie_booking_confirm.php?seats=" + encodeURIComponent(stringifiedSelectedSeats) + "&show_id=" + showId;
                console.log(url);
                window.location = url;
            });
        });
    </script>
</head>

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
        <div>
            <h2> Show Details</h2>
            <?php
                $showId = $_GET['show_id'];
                $showDetails = getShow($showId)->fetch_assoc();
                $bookings = getBookings($showId);
                echo "<h5> Date ".$showDetails["show_date"]. "</h5>";
                echo "<h5> Time - ".$showDetails["start_time"]. "</h5>";
                $movieId = $showDetails["movie_id"];
                $movieDetails = getMovie($movieId)->fetch_assoc();
                echo "<h5> Movie - " . $movieDetails["name"] . "(".$movieDetails["language"].")";
                $screenId = $showDetails["screen_id"];
                $startTime = $showDetails["start_time"];
                $screenSeatDetails = getSeatDetails($screenId);

                $alreadyBookedSeats = array();
                while($row = $bookings->fetch_assoc()) {
                    $alreadyBookedSeats[$row["seat_id"]] = 1;
                }
            ?>

                <?php 
                    $rowNumber = 'A';
                    while($row = $screenSeatDetails->fetch_assoc()) { 
                        $seat_type = $row["name"];
                        $number_of_seats = $row["number_of_seats"];
                        
                        $number_of_rows = $number_of_seats / 10;
                        echo "<h2>$seat_type</h2>";
                        echo '<table class="table">';
                        for($i = 1; $i <= $number_of_rows; $i++) {
                           
                            echo "<tr> ";
                            for($j = 1;$j <= 10;$j++) {
                                $id = $seat_type . "_" . $rowNumber . "_" . $j;
                                $className = "seat-vacant";
                                if($alreadyBookedSeats[$id] == 1) {
                                    $className = "seat-booked";
                                }

                                echo '<td> <div class="' . $className . '" id="' . $id . '"> </div></td>'; 
                            }
                            echo "</tr>";
                            $rowNumber++;
                        }
                        echo '</table>';
                    }

                ?>
            </table> 

            <button id="book" class="btn-primary">Book</button>
            
        </div>
    </div>

</body>
</html>
