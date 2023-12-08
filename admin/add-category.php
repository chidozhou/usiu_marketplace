<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
       <h1> Add Category</h1>
       
         </br> </br>
         <?php
            if(isset($_SESSION['add'])) //Checking whether the Session is Set of Not
            {
                echo $_SESSION['add']; //Display the Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
            if(isset($_SESSION['upload'])) //Checking whether the Session is Set of Not
            {
                echo $_SESSION['upload']; //Display the Session Message if Set
                unset($_SESSION['upload']); //Remove Session Message
            }
        ?>
         
        </br></br>

        <!--Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!--Add Category Form Ends -->

        <?php
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Button Clicked
                //echo "Button Clicked";
                //Get the Value from Category Form
                $title = $_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the Value from Form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set the Default Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the Value from Form
                    $active = $_POST['active'];
                }
                else
                {
                    //Set the Default Value
                    $active = "No";
                }
                //Check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Upload the Image only if image is selected
                    if($image_name!="")
                    {
                        //Auto Rename our Image
                        //Get the Extension of our Image (jpg, png, gif, etc) e.g. "special.gadget1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Gadget_Category_".rand(000, 999).'.'.$ext; //e.g. Gadget_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //Set Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }


                //Create a SQL Query to Save or Add Category
                //For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                //$res = mysqli_query($conn, $sql);
                $res = mysqli_query($conn, $sql);

                if ($res === false) {
                // Query execution failed, display the error message
                    echo "Error: " . mysqli_error($conn);
                }


                //Check whether the query executed successfully or not
                if($res==TRUE)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add Category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>