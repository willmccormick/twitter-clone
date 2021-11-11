<?php

echo "<link rel='stylesheet' href='stylesheet.css'>";

$servername = "cssql.seattleu.edu";
$username = "ll_wmccormick";
$password = "ll_wmccormick";
$dbname = "ll_wmccormick";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = $_POST["query"];

echo "QUERY: " . $_POST["query"] . "<br>";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr>";
    while ($field = mysqli_fetch_field($result)) {
        echo "<th>" . $field->name . "</th>";
    }
    echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for($i = 0; $i < mysqli_num_fields($result); $i++) {
            echo "<td>" . $row[$i] . "</td>";  
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Free result set
mysqli_free_result($result);
mysqli_close($conn);

?> 