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
    <title>Coral Cove : Booking</title>
    <?php
        include ("includes/links.php");
    ?>
</head>
<body>
    
<?php include ("includes/navbar.php"); ?>

        <div class="my-5 px-4">
            <h3 class="fw-bold h-font text-center">Book the Beachfront Bliss at Coral Cove Resort</h3>
            <div class="h-line bg-dark col-4"></div> 
        </div>
<?php

if (isset($_POST["txtBook"]))
{

    function generateID()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $id = '';
        for ($i = 0; $i < 10; $i++)
        {
            $id .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $id;
    }
    $bookingid = generateID();
    if (isset($_GET['roomid']) && isset($_GET['price']))
    {
        $roomid = $_GET['roomid'];
        $price = $_GET['price'];
        $date1 = new DateTime($_POST['checkin']);
        $date2 = new DateTime($_POST['checkout']);
        $interval = $date1->diff($date2);
        $diff = $interval->days;

        $name = $_POST['txtName'];
        $aadhar = $_POST['txtAadhar'];
        $mobile = $_POST['txtMobile'];
        $adult = $_POST['txtAdult'];
        $child = $_POST['txtChild'];

        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $currentDate = date('Y-m-d'); //current date

        $userid = $_SESSION['userid'];

        $total = $diff * $price;
        
        // Aadhar validation
        if (!preg_match("/^\d{12}$/", $aadhar))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            <strong>Enter valid Aadhar number</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }

        //Mobile validation
        else if (!preg_match('/^[6-9]\d{9}$/', $mobile))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            <strong>Enter valid Mobile number</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }

        //Date Validation
        else if ($checkin < $currentDate || $checkout < $currentDate)
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            <strong>Date can't be in past </strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        } 
        else if ($checkin >= $checkout)
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                            <strong>Check-out date must be after the check-in date</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        } 
        else
        {
            try
            {
                $qry = "INSERT INTO room_book (userid, bookingid, cname, aadhar, mobile, adult, children, roomid, checkin, checkout, total)
                        VALUES ('$userid','$bookingid','$name',$aadhar,$mobile,$adult,$child,'$roomid','$checkin','$checkout',$total)";
                $result = $conn->query($qry);
                if ($result)
                {
                    $_SESSION['bookingid'] = $bookingid;
                    header("Location:show.php");
                } else
                {
                    echo "Not inserted";
                }
            } 
            catch (Exception $ex)
            {
                echo $ex;
            } 
            finally
            {
                $conn->close();
            }

        }
    }
}
?>

<?php if(isset($msg)) echo $msg; ?>
<!--<div class="form-container"> -->
<!-- <div class="box reg-box mt-3"> -->
<form method="post">
    <div class="row mt-3">
    <div class="col-8 offset-2">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                type="text"
                id="name"
                name="txtName"
                placeholder="Enter your name"
                class="form-control"
                required
                />
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="aadhar" class="form-label">Aadhar Number</label>
                    <input
                    type="number"
                    id="aadhar"
                    name="txtAadhar"
                    placeholder="Aadhar number (12 digits)"
                    class="form-control"
                    required
                    />
                </div>

                <div class="mb-3 col-md-6">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input
                    type="number"
                    id="mobile"
                    name="txtMobile"
                    placeholder="+91 xxxx xxx xxx"
                    class="form-control"
                    required
                    />
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="adult" class="form-label">Adults</label>
                    <input
                    type="number"
                    id="adult"
                    name="txtAdult"
                    placeholder="Enter number of Adults"
                    class="form-control"
                    required
                    />
                </div>

                <div class="mb-3 col-md-6">
                    <label for="child" class="form-label">Children</label>
                    <input
                    type="number"
                    id="child"
                    name="txtChild"
                    placeholder="Enter number of Children"
                    class="form-control"
                    />
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                <label for="checkin" class="form-label">Check-IN Date</label>
                <input
                    type="date"
                    id="checkin"
                    name="checkin"
                    class="form-control"
                    required
                />
                </div>

                <div class="mb-3 col-md-6">
                <label for="checkout" class="form-label">Check-OUT Date</label>
                <input
                    type="date"
                    id="checkout"
                    name="checkout"
                    class="form-control"
                />
                </div>
            </div>
            <button class="btn btn-dark add-btn mt-3 mb-4" name="txtBook">Confirm Booking</button>
            <a href="allbookings.php" class="btn btn-outline-secondary rounded-2 mt-3 mb-4">Go Back</a>
    </div>
    </div>
</form>
<!-- </div> -->
<!-- </div> -->

    <?php include("includes/footer.php"); ?>
</body>
</html>

<?php
        
        
?>

