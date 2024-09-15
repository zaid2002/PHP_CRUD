<?php
session_start();
include('includes/dbconnect.php');

//For Inserting values in Table
if (isset($_POST['save_data'])) 
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $image = $_FILES['image']['name'];

    // Check if the email already exists
    $email_check_query = "SELECT * FROM employee WHERE email='$email'";
    $email_check_result = mysqli_query(mysql: $conn, query: $email_check_query);

    if (mysqli_num_rows(result: $email_check_result) > 0) 
    {
        $_SESSION['warning'] = "Email already exists, try using another emailID";
        header(header: 'location: index.php');
        exit(0); // Stop further execution
    }
    else 
    {
        // Check if the image already exists
        if (file_exists(filename: "uploads/" . $_FILES['image']['name'])) 
        {
            $filename = $_FILES['image']['name'];
            $_SESSION['warning'] = $filename . "  Image already exists, try another Image ";
            header(header: 'location: index.php');
            exit(0);
        } 
        else
        {
            $insert_query = "INSERT INTO employee(name,phone,email,department,image) VALUES ('$name','$phone','$email','$department','$image')";
            $result = mysqli_query(mysql: $conn, query: $insert_query);
        
            if ($result) 
            {
                move_uploaded_file(from: $_FILES['image']['tmp_name'], to: "uploads/" . $_FILES['image']['name']);
                $_SESSION['success'] = "Data Stored Successfully";
                header(header: 'location: home.php');
            } 
            else 
            {
                $_SESSION['danger'] = "Image not Stored";
                header(header: 'location: index.php');
            }
        }
    }
}



//For Updating Existing Data
if (isset($_POST['update_image'])) 
{
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $old_image = $_POST['image_old'];
    $new_image = $_FILES['image']['name'];

    if ($new_image != '') {
        if (file_exists(filename: "uploads/" . $new_image)) {
            // If the new image already exists, keep the old image
            $update_filename = $old_image;
            $_SESSION['warning'] = $new_image . " Image already exists. Keeping the existing image.";
        } else {
            $update_filename = $new_image;
        }
    } else {
        $update_filename = $old_image;
    }

    // Update the database with the new information
    $update_query = "UPDATE employee SET name='$name', phone='$phone', email='$email', department='$department', image='$update_filename' WHERE id='$user_id'";
    $update_query_run = mysqli_query(mysql: $conn, query: $update_query);

    if ($update_query_run) 
    {
        // If a new image was uploaded and doesn't already exist, move it and delete the old one
        if ($new_image != '' && !file_exists(filename: "uploads/" . $new_image)) 
        {
            move_uploaded_file(from: $_FILES['image']['tmp_name'], to: "uploads/" . $new_image);
            if ($old_image != $new_image) {
                unlink(filename: "uploads/" . $old_image);
            }
        }
        $_SESSION['success'] = "Data Updated Successfully";
        header(header: 'location: home.php');
    } 
    else 
    {
        $_SESSION['danger'] = "Data Update Failed";
        header(header: 'location: edit.php');
    }
}




//For Deleting Data
if (isset($_POST['delete']))
{
    $employee_id = $_POST['delete'];
    $image = $_POST['image'];
    $delete_query = "DELETE FROM employee WHERE id='$employee_id' ";
    $delete_run = mysqli_query(mysql: $conn, query: $delete_query);

    if($delete_run)
    {
        unlink(filename: "uploads/".$image);
        $_SESSION['success'] = "  Data Deleted Successfully";
        header(header: 'location: home.php');
    }
    else
    {
        $_SESSION['danger'] = "  Data Not Deleted ";
        header(header: 'location: home.php');
    }
}

?>
