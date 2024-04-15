<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['userid'])){
        header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include ("includes/links.php"); ?>
    <title>Coral Cove : Update Details</title>
</head>
<body>

  <?php include("includes/navbar.php")?>

    <div class="my-5 px-4">
        <h3 class="fw-bold h-font text-center">Update Your Details</h3>
        <div class="h-line bg-dark col-2"></div> 
    </div>

<?php

if (isset($_POST['btnUpdate']))
{           
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

    $price = $_POST['roomprice'];
    $bid = $_POST['bookingid'];
    $userid = $_SESSION['userid'];
    $total = $diff * (int)$price;


    // Aadhar validation
    if(!preg_match("/^\d{12}$/", $aadhar))
    {
        $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                        <strong>Enter valid Aadhar number</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }

    //Mobile validation
    else if(!preg_match('/^[6-9]\d{9}$/', $mobile))
    {
        $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                        <strong>Enter valid Mobile number</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }

    //Date Validation
    else if($checkin<$currentDate || $checkout<$currentDate)
    {
        $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                        <strong>Date can't be in past </strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }
    else if($checkin>=$checkout)
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
            $qry = "UPDATE room_book SET cname = '$name', aadhar = $aadhar, mobile = $mobile, adult = $adult,
                            children = $child, checkin = '$checkin', checkout = '$checkout',
                            total = $total WHERE userid = '$userid' AND bookingid = '$bid'";
            ;
            $result = $conn->query($qry);
            if ($result)
            {
                header("Location:allbookings.php");
            } else
            {
                $msg = "<div class='alert alert-danger col-lg-5 alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                        <strong> Something went wrong!,</strong> Please Try again.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
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
//***************************************************************

if(isset($msg)) echo $msg;

if (isset($_GET['bookingid']) && isset($_SESSION['userid']))
{
    $bid = $_GET['bookingid'];
    $userid = $_SESSION['userid'];
    try
    {        
        $qry = "SELECT rb.cname, rb.aadhar, rb.mobile, rb.adult, rb.children, rb.checkin, rb.checkout, rb.total,r.price
                FROM ROOM_BOOK rb
                INNER JOIN ROOMS r ON rb.roomid = r.roomid
                WHERE rb.bookingid = '" . $bid . "' AND rb.userid = '".$userid."' ";
       
       $result = $conn->query($qry);

        if ($result->num_rows == 0)
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                    <strong> Something went wrong!,</strong> Please Try again.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        }
        else
        {
            while ($row = $result->fetch_assoc())
            {
                $cname = $row['cname'];
                $aadhar = $row['aadhar'];
                $mobile = $row['mobile'];
                $adults = $row['adult'];
                $children = $row['children'];
                $chkindate = $row['checkin'];
                $chkoutdate = $row['checkout'];
                $roomprice = $row['price'];
                $amount = $row['total'];
            ?>
            <form method="post">
                <input type="hidden" name="bookingid" value="<?php echo $bid ?>">
                <input type="hidden" name="roomprice" value="<?php echo $roomprice ?>">
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
                            value=" <?php echo $cname ?>"
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
                                value="<?php echo $aadhar ?>"
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
                                value="<?php echo $mobile ?>"
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
                                value="<?php echo $adults ?>"
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
                                value="<?php echo $children ?>"
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
                                value="<?php echo $chkindate ?>"
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
                                value="<?php echo $chkoutdate ?>"
                                required
                            />
                            </div>
                        </div>
                        <button class="btn btn-dark add-btn mt-3 mb-4" name="btnUpdate">Update Details</button>
                        <a href="allbookings.php" class="btn btn-outline-secondary rounded-2 mt-3 mb-4">Go Back</a>
                    </div>
                </div>
            </form>
                
    <?php   }
        }
    }
    catch(Exception $ex){
        $msg = "<div class='alert alert-danger alert-dismissible fade show col-lg-5 align-self-center' role='alert'>
                    <strong> Something went wrong!,</strong> Please Try again.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
              
    }
}
            
                
?>



<?php include("includes/footer.php")?>
</body>
</html>