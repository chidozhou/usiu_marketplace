<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Gadget</h1>

        </br> </br>
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add'])) //Checking whether the Session is Set of Not
            {
                echo $_SESSION['add']; //Display the Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
           
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Gadget">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Gadget"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Create PHP Code to display categories from Database
                                //1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query
                                $res = mysqli_query($conn, $sql);

                                //Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //If count is greater than zero, we have categories else we don't have categories
                                if($count>0)
                                {
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //We do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                            ?>
                            
                        </select>
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
                        <input type="submit" name="submit" value="Add Gadget" class="btn-secondary">
                    </td>
                </tr>
</table>
        </form>

        <?php
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Gadget in database
                //echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting the default value
                } 
                
                //2. Upload the image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //Image is selected
                        //A. Rename the image
                        //Get the extension of selected image (jpg, png, gif, etc.) e.g. "special.Gadget1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Create new name for image
                        $image_name = "Gadget-Name-".rand(0000, 9999).".".$ext; //e.g. Gadget-Name-654.jpg

                        //B. Upload the image
                        //Get the src path and destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination path for the image to be uploaded
                        $dst = "../images/gadgets/".$image_name;

                        //Finally upload the Gadget image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether the image uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload the image
                            //Redirect to Add Gadget Page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-gadget.php');
                            //Stop the process
                            die();
                        }

                    }
                }
                else
                {
                    $image_name = ""; //Setting default value as blank
                }

                //3. Insert into Database
                //Create a SQL Query to Save or Add Gadget
                //For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_gadget SET 
                title = '$title',
                `description` = '$description',
                price = '$price',
                `image_name` = '$image_name',
                category_id = $category,
                featured = '$featured',
                `active` = '$active'
                ";


                // Before executing the query, echo the SQL query for debugging purposes
                echo $sql2;

                //  Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check for errors
                if ($res2) {
                // Query Executed and Gadget Added
                $_SESSION['add'] = "<div class='success'>Gadget Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-gadget.php');
                } else {
                // Failed to Add Gadget
                $_SESSION['add'] = "<div class='error'>Failed to Add Gadget. " . mysqli_error($conn) . "</div>";
                header('location:'.SITEURL.'admin/manage-gadget.php');
                }

            }


        ?>

    </div>
</div>

<?php include('partials/footer.php');?>