<?php require_once("header.php") ?>
<?php require_once("database.php") ?>

<?php $roll = $_GET["rollNumber"]; ?>
<?php
    $temp_name = "";
    $query = "SELECT StudentName, PhoneNo, Email FROM details WHERE RollNumber = ?";
    $statement = $connection->prepare($query);
    if($statement){
        $statement->bind_param("s", $roll);
        if($statement->execute()) {
            $statement->bind_result($stdName, $phone, $email);
            $statement->execute();
            while($statement->fetch()){    
                $temp_name = $stdName;
                $temp_phone = $phone;
                $temp_email = $email;
            }       
        }
    }
?> 

<div class="container mt-5">
    <div class="card mt-5">
        <div class="card-header">
            <h3 class="text-center" >Edit <?php echo $roll; ?> Details</h3>
        </div>
        <div class="card-body">
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="rollNumber">Roll Number :</label>
                    <input type="text" name="rollNumber" value="<?php echo $roll; ?>" id="rollNumber" class="form-control" placeholder="Roll Number" required/>
                </div>
                <div class="form-group">
                    <label for="stdName">Student Name :</label>
                    <input type="text" name="stdName" value="<?php echo $temp_name; ?>" id="stdName" class="form-control" placeholder="Student Name" required/>
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" value="<?php echo $temp_email; ?>" id="email" class="form-control" placeholder="Email ID" required/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number :</label>
                    <input type="text" name="phone" value="<?php echo $temp_phone; ?>" id="phone" class="form-control" placeholder="Phone Number" required/>
                </div>
                <div class="form-group row">
                    <span class="col-9 mr-2"></span>
                    <input type="submit" value="Update Details" class="btn btn-sm btn-info col-2  ml-5">
                </div>
            </form>
        </div>
    </div>
</div>

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
             $statement->bind_param("ssss", $rollNumber, $stdName, $email, $phone);
             if($statement->execute()) {
                 $message = "Data Send Successfully.";
                 $statement->close();
             } else {
                 $message = "Error Occured.";
             }
         } else {
             $message = "";
         }

         $connection->close();
    }
?>


<?php require_once("footer.php") ?>