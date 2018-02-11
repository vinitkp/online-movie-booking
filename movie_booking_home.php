<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home </title>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

   

    <!-- Custom scripts for this template -->

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            $("#go-btn").click(function() {
                var date = $("#movie-date").val();
                console.log(date);
                window.location = "http://localhost:9000/movie_booking_home.php?date="+date;
            })
        });
    </script>
</head>

<?php
    include 'database.php';
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

    <div class="container-fluid" style="margin-top: 10px ">
        <div class="row">
            <div class="col-md-4">
                <input type="date" class="form-control" id="movie-date">
            </div>
            <div class="col-md-2">
                <button id="go-btn" class="btn-primary">GO</button>
            </div>
            <div class="col-md-6"></div>
        </div>

        <div>
            <h2> Movies</h2>
            <?php
                $date = $_GET['date'];
                $result = getMovies($date);

                $movieNames = array();
                $movieShowIds = array();
                $showIdsMap = array();

                while($row = $result->fetch_assoc()) {
                    $movieName = $row["name"];
                    $language = $row["language"];

                    $displayMovieName = $movieName . "(" . $language . ")";

                    if(!is_array($timings[$displayMovieName])) {
                        $timings[$displayMovieName] = array();
                    }
                    if(!is_array($showIdsMap[$displayMovieName])) {
                        $showIdsMap[$displayMovieName] = array();
                    }
                    array_push($timings[$displayMovieName], $row["start_time"]);
                    array_push($showIdsMap[$displayMovieName], $row["show_id"]);
                }
            ?>

            <table class="table">
                <?php
                    if(count($timings)) {
                        $displayMovieNames = array_keys($timings);
                        for($i = 0; $i < count($displayMovieNames); $i++) {
                            $displayMovieName = $displayMovieNames[$i];
                            echo "<tr> <td>", $displayMovieName . "</td>";
                            echo "<td>";
                            for($j = 0; $j < count($timings[$displayMovieName]); $j++) {
                                $showId = $showIdsMap[$displayMovieName][$j];
                                $href = "http://localhost:9000/movie_booking_seats.php?show_id=$showId";
                                $uri = "<a href=".$href.">". substr($timings[$displayMovieName][$j], 0, 5) . "</a> ";
                                echo $uri . "&nbsp &nbsp &nbsp";
                            }
                            echo "</td> </tr>";
                        }
                    }  else {
                        echo " <h2> No movies for the selected date. Select another date!!! BBYE!! </h2>";
                    } 
                ?>
            </table>
        </div>
    </div>

</body>
</html>
