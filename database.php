<?php
$servername = "127.0.0.1";
$username = "root";
$password = "xyz";
$dbName = "movie_booking";

// Create connection
$conn = new MySQLi($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
	echo "gand phat gayi";
    die("Connection failed: " . mysqli_connect_error());
}

function getMovies($date) {
    global $conn;
    $sql = "select movie.name, movie.language, sh.start_time, sh.screen_id, sh.id as show_id from Movie movie
    INNER JOIN Movie_Show sh on movie.id = sh.movie_id where sh.show_date = '$date'";
    $result = $conn->query($sql);
    return $result;
} 

function getBookings($showId) {
	global $conn;
    $sql = "select * from Booking where show_id = $showId";
    $result = $conn->query($sql);
    return $result;
}

function getShow($showId) {
	global $conn;
    $sql = "select ms.movie_id, ms.screen_id, ms.start_time , ms.show_date from Movie_Show ms where ms.id = $showId";
    $result = $conn->query($sql);
    return $result;
}

function getMovie($movieId) {
	global $conn;
    $sql = "select * from Movie where id = $movieId";
    $result = $conn->query($sql);
    return $result;
}

function getSeatDetails($screedId) {
	global $conn;
    $sql = "select st.name, st.number_of_seats, screen.screen_name from Screen screen INNER JOIN Seat_Type st on screen.id = st.screen_id";
    $result = $conn->query($sql);
    return $result;
}

function getTheatreDetails($theatreId) {
	global $conn;
    $sql = "select * from Theatre where id = $theatreId";
    $result = $conn->query($sql);
    return $result;
}

function getScreenDetails($screenId) {
	global $conn;
    $sql = "select * from Screen where id = $screenId";
    $result = $conn->query($sql);
    return $result;
}

function insertBooking($bookings) {
	global $conn;

	$sql = "insert into Booking (show_id, seat_id, user_id) values ";
	for($i = 0; $i < count($bookings); $i++) {
		$valueString .= "(".$bookings[$i]["show_id"].", '". $bookings[$i]["seat_id"]. "', ".$bookings[$i]["user_id"].")";
		if($i != count($bookings) - 1) {
			$valueString = $valueString. ", ";
		}
	}
	$sql = $sql . $valueString;
	$result = $conn->query($sql);
}

?>
