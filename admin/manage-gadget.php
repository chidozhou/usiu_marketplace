<?php include('partials/menu.php') ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">    
            <div class="wrapper">
                <h1> Manage gadget</h1>  
                
                </br> </br>
                
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-gadget.php" class="btn-primary">Add gadget</a>
                </br></br></br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
                ?>

                <table class="tbl-full"> 
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Create a SQL Query to Get all the gadget
                        $sql = "SELECT * FROM tbl_gadget";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have gadgets or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and assign value as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have gadget in Database
                            //Get the gadgets from Database and Display

                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get the Values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            //Chcek whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, Display Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/gadgets/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-gadget.php?id=<?php echo $id; ?>" class="btn-secondary">Update gadget</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-gadget.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete gadget</a> 
                                    </td>
                                </tr>


                                <?php

                            }
                        }
                        else
                        {
                            //gadget not Available
                            echo "<tr><td colspan='7' class='error'> gadget not Added Yet. </td></tr>";
                        }
                    ?>

                    
                    
                </table>

            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>