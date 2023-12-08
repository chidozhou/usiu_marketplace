<?php
    include('../config/constants.php');
    //echo "Delete gadget Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
        //echo "Process to Delete";

        //1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        //Check whether the image is available or not and Delete only if available
        if($image_name!="")
        {
            //It has image and need to remove from folder
            //Get the Image Path
            $path = "../images/gadgets/".$image_name;

            //Remove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //Redirect to Manage gadget
                header('location:'.SITEURL.'admin/manage-gadget.php');
                //Stop the Process of Deleting gadget
                die();
            }
        }

        //3. Delete gadget from Database
        $sql = "DELETE FROM tbl_gadget WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        if($res==true)
        {
            //gadget Deleted
            $_SESSION['delete'] = "<div class='success'>gadget Deleted Successfully.</div>";
            //Redirect to Manage gadget
            header('location:'.SITEURL.'admin/manage-gadget.php');
        }
        else
        {
            //Failed to Delete gadget
            $_SESSION['delete'] = "<div class='error'>Failed to Delete gadget.</div>";
            //Redirect to Manage gadget
            header('location:'.SITEURL.'admin/manage-gadget.php');
        }
    }
    else
    {
        //Redirect to Manage gadget
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-gadget.php');

    }
?>