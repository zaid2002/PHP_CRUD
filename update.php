<?php
session_start();
include('includes/header.php');
include('includes/dbconnect.php');
?>
<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php
                include('includes/message.php');
            ?>

                <div class="card">
                    <div class="card-header">
                        <h4 class="d-inline-flex flex-row">ID : <?php if (isset($_GET['id'])) {
                            $employee_id = $_GET['id'];
                            $query = "SELECT * FROM employee WHERE id='$employee_id' ";
                            $result = mysqli_query(mysql: $conn, query: $query); echo $employee_id;?> 
                            <h4 class="float-end">Update</h4>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php

                            if (mysqli_num_rows(result: $result) > 0) 
                            {
                                $employee = mysqli_fetch_array(result: $result);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3 form-group">
                                        <input type="hidden" class="form-control" value = "<?php echo $employee['id']; ?>" name="id" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" value = "<?php echo $employee['name']; ?>" name="name" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="" class="form-label">Contact</label>
                                        <input type="number" class="form-control" value = "<?php echo $employee['phone']; ?>" name="phone" id="">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" value = "<?php echo $employee['email']; ?>" name="email" id="email">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Department</label>
                                        <input type="text" class="form-control" value = "<?php echo $employee['department']; ?>" name="department" id="department">
                                    </div>
                                    
                                    <div class="mb-3 form-group">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="file">
                                        <input type="hidden" name="image_old" value = "<?php echo $employee['image']; ?>">
                                        <img src="<?php echo "uploads/".$employee['image']; ?>" alt="oldimage" width="70" height="auto">
                                    </div>
                                    <button type="submit" name="update_image" class="btn btn-primary">Update</button>
                                </form>
                                <?php
                            } else {
                                echo "NO such id found";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
