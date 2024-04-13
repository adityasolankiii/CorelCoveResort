<?php
session_start();
@include ("php/config.php");
if(!$_SESSION['userid']){
    header("Location: index.php");
}
if(isset($_SESSION['bookingid'])){
	unset($_SESSION['bookingid']);
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        @include ("includes/links.php");
    ?>
</head>
<body>
    <?php  @include ("includes/navbar.php"); ?>
    
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
      <div class="h-line bg-dark col-1"></div> 
    </div>

<div class="container">
 	<div class="row">
    

<?php
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
        $category = $row['category'];
        $roomName = $row['roomname'];
        $roomname = preg_replace('/([a-z])([A-Z])/', '$1 $2', $roomName);
        $cat = preg_replace('/([a-z])([A-Z])/', '$1 $2', $category);

        echo '<form action="roombook.php" method="get" class="col-lg-4 col-md-6 my-3 frm-card">';
        //Set Hidden Form Fields
        echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
        echo '<input type="hidden" name="roomid" value="' . $row['roomid']. '">';
        
        echo '  <div class="card border-0 shadow">';
        echo '    <img src="' . $row['image'] . '" class="card-img-top" alt="' . $roomname . '">';
        echo '    <div class="card-body all-card-body">';
        echo '      <h5 class="card-title">' . $roomname . '</h5>';
        echo '      <h6 class="mb-3">&#8377;' . number_format($row['price']) . ' per night</h6>';
        echo '      <div class="Category mb-3">';
        echo '        <strong>Category</strong>';
        echo '        <span class="badge rounded-pill bg-light text-dark text-wrap">' . $cat . '</span>';
        echo '      </div>';
        echo '      <div class="features mb-4">';
        echo '        <strong>Features</strong>';
        $features = explode(', ', $row['features']);
        foreach ($features as $feature)
        {
            echo '        <span class="badge rounded-pill bg-light text-dark text-wrap">' . $feature . '</span>';
        }
        echo '      </div>';
        echo '      <div class="Facilities mb-3">';
        echo '        <strong>Facilities</strong>';
        $facilities = explode(', ', $row['facilities']);
        foreach ($facilities as $facility)
        {
            echo '        <span class="badge rounded-pill bg-light text-dark text-wrap">' . $facility . '</span>';
        }
        echo '      </div>';
        echo '      <div class="guests mb-3">';
        echo '        <strong>Guests</strong>';
        echo '       <span class="badge rounded-pill bg-light text-dark text-wrap">' . $row['capacity'] . '</span>';
        echo '      </div>';
        echo '      <div class="rating mb-4">';
        echo '        <strong>Rating</strong>';
        echo '        <span class="badge rounded-pill bg-light">';
        for ($i = 0; $i < $row['rating']; $i++)
        {
            echo '          <i class="bi bi-star-fill text-warning"></i>';
        }
        echo '        </span>';
        echo '      </div>';
        echo '      <div class="d-flex">';
        echo '        <button class="btn btn-dark shadow-none col-5 px-1">Book Now</button>';
        echo '      </div>';
        echo '    </div>';

        echo '  </div>';
        echo '</form>';
    }
}
?>


</div>
</div>

<?php @include ("includes/footer.php"); ?>
  </div>
</div>
