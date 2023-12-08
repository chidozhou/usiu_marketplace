
<?php include('partials-front/menu.php'); ?>

<!-- gadget sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        
        <form action="<?php echo SITEURL; ?>gadget-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for the gadget.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- gadget sEARCH Section Ends Here -->



<!-- gadget MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Gadgets Menu</h2>

        <?php 
            //Display gadgets that are Active
            $sql = "SELECT * FROM tbl_gadget WHERE active='Yes'";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //CHeck whether the gadgets are availalable or not
            if($count>0)
            {
                //gadgets Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //CHeck whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/gadgets/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //gadget not Available
                echo "<div class='error'>gadget not found.</div>";
            }
        ?>

        

        

        <div class="clearfix"></div>

        

    </div>

</section>
<!-- gadget Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>