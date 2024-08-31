<?php
session_start();
include('includes/dbconnect.php');

//For Inserting values in Table
if (isset($_POST['save_data'])) 
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];

    // Check if the email already exists
    $email_check_query = "SELECT * FROM students WHERE email='$email'";
    $email_check_result = mysqli_query($conn, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) 
    {
        $_SESSION['warning'] = "Email already exists, try using another emailID";
        header('location: index.php');
        exit(0); // Stop further execution
    }
    else 
    {
        // Check if the image already exists
        if (file_exists("uploads/" . $_FILES['image']['name'])) 
        {
            $filename = $_FILES['image']['name'];
            $_SESSION['warning'] = $filename . "  Image already exists, try another Image ";
            header('location: index.php');
            exit(0);
        } 
        else
        {
            $insert_query = "INSERT INTO students(name,phone,email,image) VALUES ('$name','$phone','$email','$image')";
            $result = mysqli_query($conn, $insert_query);
        
            if ($result) 
            {
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $_FILES['image']['name']);
                $_SESSION['success'] = "Data Stored Successfully";
                header('location: home.php');
            } 
            else 
            {
                $_SESSION['danger'] = "Image not Stored";
                header('location: index.php');
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
    $old_image = $_POST['image_old'];
    $new_image = $_FILES['image']['name'];

    if ($new_image != '') {
        if (file_exists("uploads/" . $new_image)) {
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
    $update_query = "UPDATE students SET name='$name', phone='$phone', email='$email', image='$update_filename' WHERE id='$user_id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) 
    {
        // If a new image was uploaded and doesn't already exist, move it and delete the old one
        if ($new_image != '' && !file_exists("uploads/" . $new_image)) 
        {
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $new_image);
            if ($old_image != $new_image) {
                unlink("uploads/" . $old_image);
            }
        }
        $_SESSION['success'] = "Data Updated Successfully";
        header('location: home.php');
    } 
    else 
    {
        $_SESSION['danger'] = "Data Update Failed";
        header('location: edit.php');
    }
}




//For Deleting Data
if (isset($_POST['delete']))
{
    $student_id = $_POST['delete'];
    $image = $_POST['image'];
    $delete_query = "DELETE FROM students WHERE id='$student_id' ";
    $delete_run = mysqli_query($conn, $delete_query);

    if($delete_run)
    {
        unlink("uploads/".$image);
        $_SESSION['success'] = "  Data Deleted Successfully";
        header('location: home.php');
    }
    else
    {
        $_SESSION['danger'] = "  Data Not Deleted ";
        header('location: home.php');
    }
}

?>