<?php require_once("header.php") ?>
<?php require_once("database.php") ?>

<?php 
    $message = "";
    if(isset($_POST["rollNumber"]) && isset($_POST["stdName"])
     && isset($_POST["email"]) && isset($_POST["phone"]))  {
         $rollNumber = $_POST["rollNumber"];
         $stdName = $_POST["stdName"];
         $email = $_POST["email"];
         $phone = $_POST["phone"];
         
         $query = "UPDATE details SET RollNumber = ?, StudentName = ?, Email = ?, PhoneNo = ? WHERE RollNumber = ?";
         $statement = $connection->prepare($query);
         if($statement) {
             $statement->bind_param("sssss", $rollNumber, $stdName, $email, $phone, $rollNumber);
             if($statement->execute()) {
                 echo '<div class="alert alert-info text-center mt-5 container" role="alert" >
                        Data Updated Successfully
                    </div>';
                    header("Location:index.php");
                 $statement->close();
             } else {
                echo '<div class="alert alert-danger text-center mt-5 container" role="alert" >
                        Error Occured
                </div>';
             }
         } else {
             $message = "";
         }

         $connection->close();
    }
?>

<?php require_once("footer.php") ?>