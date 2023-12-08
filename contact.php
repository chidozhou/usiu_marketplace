<?php include('partials-front/menu.php'); ?>

<style>


/* .mycontainer {
    width: 600px;
    height: 500px;
    background-color:  #ff6b81;
    text-align: center;
    border: 1px solid black;
    margin: 50px auto;
}

.contact{
    padding: 50px 20px;
    line-height: 1;
}

.address{
    padding: 50px 20px;
    line-height: 1;
} */

<head>
    <title>Contact Us</title>
    <style>
        /* Add CSS styles here for better presentation */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin-top: 80px;
            padding: 0;
        }
        .mycontainer {
            display: flex;
            justify-content: space-around;
            padding-top: 100px;
            padding-bottom: 20px;
        }
        .address, .email, .phone {
            text-align: center;
            padding: 20px;
        }
        
        i {
            font-size: 90px;
            color: #ff6b81;
        }
        h3 {
            font-size: 20px;
            margin: 10px 0;
        }
        p {
            font-size: 20px;
            margin: 10px 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

</style>

<div class="mycontainer">
    <div class="address">
        <i class="fa-solid fa-location-dot"></i>
        <h3>Address</h3>
        <p>123 Main Street, Cityville, State 12345</p>
    </div>
   
 
    <div class="address">
        <i class="fas fa-phone"></i>
        <h3>Phone</h3>
        <p>123-456-7890</p>
    </div>

    <div class="email">
        <i class="fas fa-envelope"></i>
        <h3>Email</h3>
        <p>info@example.com </p>
    </div>
</div>



       


<?php include('partials-front/footer.php'); ?>