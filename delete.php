<?php require_once("header.php") ?>
<?php require_once("database.php") ?>


<?php $roll = $_GET["rollNumber"]; ?>
<?php
    $query = "DELETE FROM details WHERE RollNumber = ?";
    $statement = $connection->prepare($query);
    if($statement){
        $statement->bind_param("s", $roll);
        if($statement->execute()) {
            echo '<div class="text-center container mt-5 alert alert-success rounded" role="alert">
                Sucessfully Deleted.
            </div>';
        }else {
            echo '<div class="text-center container mt-5 alert alert-success rounded" role="alert">
                Error Occured.
            </div>';
        }
    }
    
?>    

<?php require_once("footer.php") ?>