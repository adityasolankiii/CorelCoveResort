<?php
session_start();
include ("php/config.php");
if(!$_SESSION['bookingid'] && !$_SESSION['userid']){
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coral Cove Resort : Details</title>
    <?php
       
        include ("includes/links.php");
    ?>
</head>
<body>
<?php include ("includes/navbar.php"); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Your Datails</h2>
        <div class="h-line bg-dark col-1"></div> 
    </div>
<?php

    try
    {
        $bookingid = $_SESSION['bookingid'];
        $userid = $_SESSION['userid'];
        $qry = "SELECT rb.bookingid, rb.cname, rb.aadhar, rb.mobile, rb.adult, rb.children, r.category, r.roomname, rb.checkin, rb.checkout, rb.total,r.image
                FROM ROOM_BOOK rb
                INNER JOIN ROOMS r ON rb.roomid = r.roomid
                WHERE rb.bookingid = '" . $bookingid . "' AND rb.userid = '".$userid."' ";
        $result = $conn->query($qry);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $bid = $row['bookingid'];
                $cname = $row['cname'];
                $aadhar = $row['aadhar'];
                $mobile = $row['mobile'];
                $adults = $row['adult'];
                $children = $row['children'];
                $category = $row['category'];
                $roomname = $row['roomname'];
                $chkindate = $row['checkin'];
                $chkoutdate = $row['checkout'];
                $amount = $row['total'];
                $image = $row['image'];
            ?>

                        <!-- CARD -->
                <div class="container col-lg-8">
 	                <div class="row">
                        <div class="card mb-4 border-0 shadow">
                            <div class="row g-0 p-lg-2">
                                <div class="col-md-5 align-self-center div-img">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded">
                                </div>
                                    <div class="col-lg-4 col-md-5 px-lg-3 px-md-4 px-0 ">
                                        <div class="mt-md-3 mb-1 col-md-12 mt-lg-4">
                                            <h4 class="text-sm-start"><?php echo $roomname; ?></h4>
                                        </div>
                                        <div class="mb-1">
                                            <h6 class="mb-2"><?php echo $category; ?></h6>
                                        </div>

                                        <div class="mb-1">
                                            <h6 class="d-inline">Booking ID : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $bid; ?>
                                            </span>
                                        </div> 
                                        <div class="mb-1">
                                            <h6 class="d-inline">Guest Name : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $cname; ?>
                                            </span>
                                        </div>
                                        <div class="mb-1">
                                            <h6 class="d-inline">Aadhar ID : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $aadhar; ?>
                                            </span>
                                        </div>
                                        <div class="mb-1">
                                            <h6 class="d-inline">Mobile : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $mobile; ?>
                                            </span>
                                        </div>
                                        <div class="mb-1">
                                            <h6 class="mb-1 d-inline">Total Guests : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $adults+$children. "</br>";?>
                                            </span>
                                            <span class="text-dark" style="font-size: small;";>
                                                <?php echo "Adults : $adults &nbsp; Children : $children";?>
                                            </span>                                
                                        </div>                            
                                    </div>

                                    <div class="col-md-2 mt-4 py-lg-5 py-md-5 col-lg-3 align-self-center">
                                        <div class="mb-1">
                                            <h6 class="mb-0 d-lg-inline">Check-in : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $chkindate; ?>
                                            </span>
                                        </div>
                                        <div class="mb-1">
                                            <h6 class="mb-0 d-lg-inline">Check-out : </h6>
                                            <span class="text-dark fs-6">
                                                <?php echo $chkoutdate; ?>
                                            </span>
                                        </div>

                                        <h6 class="mb-4"><?php echo 'Total Amount : &#8377;' . number_format($amount)  ?></h6>
                                        <a href="home.php" class="btn btn-sm btn-outline-secondary rounded-2 fw-bold shadow-none">Home</a>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>


    <?php   }
        
    } 
}
catch(Exception $ex){
    echo $ex;
}
finally{
    $conn->close();
}

?>
<?php include("includes/footer.php")?>
</body>
</html>