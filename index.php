<?php require_once("header.php") ?>
<?php require_once("dataBase.php") ?>
<?php
    $roll = "";
    $name = "";
    $email = "";
    $phone = "";
    $query = "SELECT RollNumber, StudentName, Email, PhoneNo FROM Details";
    $statement = $connection->prepare($query);
    if($statement) {
        if($statement->execute()) {
            $statement->bind_result($roll, $name, $email, $phone);
            ;
            
        }
    }
?>

  <div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2 class="text-center" >Student Details</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered" >
                <tr>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                
                    <?php while($statement->fetch()): ?>
                    <tr>
                        <td><?php echo $roll ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $email ?></td>
                        <td>
                            <a href="edit.php?rollNumber=<?php echo $roll ?>" class="ml-2 btn btn-light btn-sm active" role="button">Edit Details</a>
                            <a href="delete.php?rollNumber=<?php echo $roll ?>" onclick="return confirm('Dou you want to delete this entry?')" class="ml-2 btn btn-light btn-sm active" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
               
            </table>
        </div>
    </div>
  </div>


<?php require_once("footer.php") ?>