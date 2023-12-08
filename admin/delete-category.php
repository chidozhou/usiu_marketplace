<?php 
    //Include constants.php file here
    include('../config/constants.php');
    //echo "Delete category";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and Delete
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name!="")
        {
            //Image is Available. So remove it
            $path = "../images/category/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the session Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the Process
                die();
            }
        }
        //Delete data from database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
 
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is deleted from database or not
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //Redirect to Manage Category Page with message
    }
    else
    {
        //Redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');

    }

    
?> 