<?php
// session_start();
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
                            $result = mysqli_query($conn, $query); echo $employee_id;?> 
                            <h4 class="float-end">Details</h4>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php

                            if (mysqli_num_rows($result) > 0) 
                            {
                                $employee = mysqli_fetch_array($result);
                                // print_r($employee);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Employee Name</label>
                                        <p class="form-control">
                                            <?php echo $employee['name']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="" class="form-label">Contact</label>
                                        <p class="form-control">
                                            <?php echo $employee['phone']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <p class="form-control">
                                            <?php echo $employee['email']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="exampleInputEmail1" class="form-label">Department</label>
                                        <p class="form-control">
                                            <?php echo $employee['department']; ?>
                                        </p>
                                    </div>
                                    <!-- <div class="mb-3 form-group">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div> -->
                                    <div class="mb-3 form-group">
                                        <label for="" class="form-label">Image</label>
                                        <p class="">
                                            <img src="<?php echo "uploads/".$employee['image']; ?>" alt="oldimage" width="100" height="auto">
                                        </p>
                                    </div>
                                
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
