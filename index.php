<?php
session_start();
include('includes/header.php');
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
                        <h4>Employee Details </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 form-group">
                                <label for="exampleInputEmail1" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Contact</label>
                                <input type="number" class="form-control" name="phone" id="">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="exampleInputPassword1" class="form-label">Department</label>
                                <input type="text" class="form-control" name="department" id="department">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="file">
                            </div>
                            <button type="submit" name="save_data" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
