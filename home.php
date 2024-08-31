<?php
session_start();
include('includes/header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
                include('includes/message.php');
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>Student Data
                        <a href="index.php" class="btn btn-primary float-end">Add</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                include ('includes/dbconnect.php');

                                $fetch_query = "SELECT * FROM students";
                                $result = mysqli_query($conn, $fetch_query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    foreach($result as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td>
                                                <img src="<?php echo "uploads/" .$row['image'] ?>" width="80" height="75" alt="image">
                                            </td>
                                            <td>
                                                <a href="read.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">View</a>
                                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                                <form action="code.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="image" value="<?php echo $row['image'];?>">
                                                    <button class="btn btn-danger" value="<?php echo $row['id'];?>" name="delete">Delete</button>
                                                </form>
                                                <!-- <a href="" class="btn btn-danger"></a> -->
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No records found";
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>