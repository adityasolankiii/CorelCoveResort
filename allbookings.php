<?php
session_start();
include ("php/config.php");
if(!$_SESSION['userid']){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coral Cove Resort : Facilities</title>
    <?php
        include ("includes/links.php");
    ?>
</head>

<body>
    <?php include ("includes/navbar.php");?>
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">All Bookings</h2>
      <div class="h-line bg-dark col-1"></div> 
    </div>

    <?php

    if(isset($_POST['btnConfirm']))
    {
        if(isset($_POST['bookingid'])){
            $bid = $_POST['bookingid'];
            $userid = $_SESSION['userid'];
            
            try{
                $qry = "DELETE FROM ROOM_BOOK WHERE USERID='$userid' AND bookingid='$bid'";
                $result = $conn->query($qry);
                if($result){
                    $msg = "<div class='alert alert-success alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            <strong>Seashell Shifts : </strong>Effortlessly Adjusting Your Coral Cove Itinerary
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
                else{
                    $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            Something went wrong, Please try again later
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }
            catch(Exception $ex){
                echo $ex;
            }
            
            
        }
    }

    if(isset($msg)) echo $msg;
    try
    {
        $userid = $_SESSION['userid'];
        $qry = "SELECT rb.bookingid, rb.cname, rb.aadhar, rb.mobile, rb.adult, rb.children, r.category, r.roomname, rb.checkin, rb.checkout, rb.total,r.image
                FROM ROOM_BOOK rb
                INNER JOIN ROOMS r ON rb.roomid = r.roomid
                WHERE rb.userid = '".$userid."' ";
                $result = $conn->query($qry);

        if ($result->num_rows == 0)
        {
           echo "<div class='alert alert-danger fade show col-lg-5 align-self-center' role='alert'>
                    <h5 class='d-inline'> Ocean’s Whisper : </h5>  Your Coral Cove Journey Awaits Discovery
                        <ul>
                            <li><p>No Details Found for thiis user<p></li>
                        </ul>
                        </div>";
            

        } else {
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
                <form  method="post">
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
                                                    <?php echo $adults + $children . "</br>"; ?>
                                                </span>
                                                <span class="text-dark" style="font-size: small;";>
                                                    <?php echo "Adults : $adults &nbsp; Children : $children"; ?>
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

                                            <h6 class="mb-4"><?php echo 'Total Amount : &#8377;' . number_format($amount) ?></h6>
                                            <div class="d-flex" role="search">
                                                <button class="btn btn-dark shadow-none col-10 mb-3" type="button" data-bs-toggle="modal" data-bs-target="#cancelModel" name='btnCancel'>Cancel Booking</button>
                                            </div>
                                            <a  class="mt-1 btn btn-dark shadow-none col-10 " href="edit.php?bookingid=<?php echo $row['bookingid']; ?>">Update Details</a>
                                            <input type="hidden" name="bookingid" value="<?php echo $row['bookingid']; ?>">
                                        </div>
                                </div>                        
                            </div>
                        </div>
                    </div>

        <!-- Confirmation Popup -->
                    <div class="modal fade col-12" id="cancelModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title">
                                        Sailing Plans Changed? <br> We’ve Got You Covered.
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <h4>Cancellation Policy</h4>
                                    <ul>                                        
                                        <strong>No Stress Refunds:</strong> 
                                        <li>Cancel up to 48 hours before your check-in date for a full refund.</li>
                                        <strong>Late Cancellation:</strong> 
                                        <li>For cancellations within 48 hours of arrival, a nominal fee applies.</li>
                                        <strong>Instant Confirmation:</strong> 
                                        <li>Receive immediate email confirmation upon successful cancellation.</li>
                                    </ul>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark" name="btnConfirm">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                
                                </div>                            
                            </div>
                        </div>
                    </div>        
                </form>
    <?php
            }
        
        }

    }
    catch(Exception $ex){
        echo $ex;
    }


?>
<?php include("includes/footer.php")?>
</body>
</html>