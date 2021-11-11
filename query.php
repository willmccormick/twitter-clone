<?php

function tableFromQuery($query){
    
    //put your seattle u name here
    $seattleu = "wmccormick";
    
    //used to access database
    $servername = "cssql.seattleu.edu";
    $username = "ll_" . $seattleu;
    $password = "ll_" . $seattleu;
    $dbname = "ll_" . $seattleu;
    
    //return value
    $html;

    //create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //quit if connection fails
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //states the query at the top of the page
    $html = $html . "<h1>QUERY: " . $query . "</h1><br>";

    //gets the result of a query
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        
        //starts the table
        $html = $html . "<table>";
        
        //creates a row in the table for the headers
        $html = $html . "<tr>";
        while ($field = mysqli_fetch_field($result)) {
            $html = $html . "<th>" . $field->name . "</th>";
        }
        $html = $html . "</tr>";
        
        //creates the remaining rows in the table
        while($row = mysqli_fetch_row($result)) {
            $html = $html . "<tr>";
            for($i = 0; $i < mysqli_num_fields($result); $i++) {
                $html = $html . "<td>" . $row[$i] . "</td>";  
            }
            $html = $html . "</tr>";
        }
        
        $html = $html . "</table>";
    } else {
        $html = $html . "0 results";
    }
    
    // Free result set and close connection
    mysqli_free_result($result);
    mysqli_close($conn);
    
    return $html;
}

echo "<link rel='stylesheet' href='stylesheet.css'>";
echo "<link rel='stylesheet' href='query_stylesheet.css'>";

echo tableFromQuery($_POST["query"]);
?> 