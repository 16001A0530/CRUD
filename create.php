<?php require_once("header.php") ?>
<?php require_once("dataBase.php") ?>

<?php 
    $message = "";
    if(isset($_POST["rollNumber"]) && isset($_POST["stdName"])
     && isset($_POST["email"]) && isset($_POST["phone"]))  {
         $rollNumber = $_POST["rollNumber"];
         $stdName = $_POST["stdName"];
         $email = $_POST["email"];
         $phone = $_POST["phone"];

         $roll = "";
         $rollCheck = "";
         $query = "SELECT RollNumber FROM Details WHERE RollNumber = ?";
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
         
         $query = "INSERT INTO Details (RollNumber, StudentName, Email, PhoneNo) VALUES (?, ?, ?, ?)";
         $statement = $connection->prepare($query);
         if($statement) {
             $statement->bind_param("ssss", $rollNumber, $stdName, $email, $phone);
             if($statement->execute()) {
                 $message = "Data Send Successfully.";
                 $statement->close();
             } else {
                 $message = "Error Occured.";
             }
         }

         $connection->close();
    }
?>

    <div class="container mt-5">
        <div class="card mt-5">
            <div class="card-header">
                <h2 class="text-center" >Enter Student Details</h2>
            </div>
            <div class="card-body">
                <?php if((empty($rollCheck)) ): ?>
                    <?php if(!empty($message)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                        <?= $message ?>
                        <!-- <?php echo $message ?> -->
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <form action="create.php" method="post">
                    <div class="form-group">
                        <?php $rollNumber = isset($_POST['rollNumber']) ? $_POST['rollNumber'] : "" ?>
                        <label for="rollNumber">Roll Number :</label>
                        <input type="text" name="rollNumber" id="rollNumber" class="form-control" value="<?php echo $rollNumber ?>" placeholder="Roll Number" required/>
                    </div>
                    <?php if(!empty($rollCheck)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" >
                    <?= $rollCheck ?>
                    <!-- <?php echo $message ?> -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php $stdName = isset($_POST['stdName']) ? $_POST['stdName'] : "" ?>
                        <label for="stdName">Student Name :</label>
                        <input type="text" name="stdName" id="stdName" class="form-control" placeholder="Student Name" value="<?php echo $stdName ?>" required/>
                    </div>

                    <div class="form-group">
                        <?php $email = isset($_POST['email']) ? $_POST['email'] : "" ?>
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email ID" value="<?php echo $email ?>" required/>
                    </div>
                    <div class="form-group">
                    <?php $phone = isset($_POST['phone']) ? $_POST['phone'] : "" ?>
                        <label for="phone">Phone Number :</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone ?>" required/>
                    </div>
                    <div class="form-group row">
                        <input type="reset" value="Reset Details" class="btn btn-sm btn-danger col-md-2 ml-4" >
                        <span class="col-md-7 " ></span>
                        <input type="submit" value="Submit Details" class="btn btn-sm btn-info col-md-2  ml-5">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require_once("footer.php") ?>