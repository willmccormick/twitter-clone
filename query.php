<?php

//gets the query from the database and create a string that will create the necessary html
function htmlTableFromQuery($query){
    
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

	//validate that it is valid query - not necessar 
	//$query_copy_select = strtolower($query);
	//$tok_select = strtok($query_copy_select, " ");
	//if($tok_select != "select") {
	//	die("Invalid command");
	//}

    //states the query at the top of the page
    $html = $html . "<div id = 'query'>QUERY: " . $query . "</div>";

	
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

function htmlFromQuery($query){
    
    $html;
    
    $html = $html . "<link rel='stylesheet' href='stylesheet.css'>";
    $html = $html . "<link rel='stylesheet' href='query_stylesheet.css'>";

    $html = $html . htmlTableFromQuery($query);
    
    $html = $html . "<script type='text/javascript' src='header.js'></script>";
    
    return $html;
}

echo htmlFromQuery($_POST["query"]);

?>