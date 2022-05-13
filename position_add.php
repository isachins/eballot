<!-- php to add position name to database -->
<?php

$name = $_GET['name'];
$description = $_GET['description'];

$query="INSERT INTO position VALUES ('$name', '$description')";
$data= mysqli_query($conn, $query);


if($data){
    echo "data inserted into database";
}
else{
    echo "failed";
}
?>
