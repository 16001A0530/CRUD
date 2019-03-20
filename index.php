<?php require_once("header.php") ?>
<?php require_once("dataBase.php") ?>
<?php
    $query = "SELECT RollNumber, Name, Email, PhoneNo FROM Details WHERE Id = ?";
    $statement = $connection->prepare($query);
    if($statement) {
        $statement->bind_param("s", $rollNumber);
        if($statement->execute()) {
            $statement->bind_result($roll);
            while($statement->fetch()) {
                if($rollNumber === $roll) {
                   $rollCheck = "Roll Number must be UNIQUE."; 
                }
            }
        }
    }
?>

  <div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2 class="text-center" >Student Details</h2>
        </div>
        <div class="card-body">
        </div>
    </div>
  </div>


<?php require_once("footer.php") ?>