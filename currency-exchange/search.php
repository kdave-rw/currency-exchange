<?php
include('php/connection.php');
$conn = mysqli_connect($host, $user, $password, $database);

// Retrieve the search term from the URL
$search_term = $_GET['search_term'];

// Prepare the SQL query
$query = "SELECT * FROM records WHERE name LIKE '%$search_term%'";

// Execute the query
$result = mysqli_query($conn, $query);

// Display the results
while ($row = mysqli_fetch_assoc($result)) {
  echo $row['name'] . "<br>";
}

// Close the database connection
mysqli_close($conn);
?>