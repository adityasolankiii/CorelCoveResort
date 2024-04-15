<?php
   session_start();
   include("php/config.php");

   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    session_destroy();
   }
   
   if(isset($_SESSION['bookingid'])){
	unset($_SESSION['bookingid']);
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php include("includes/links.php"); ?>

    <title>Coral Cove Resort: Where Waves Meet Wonder</title>
</head>
<body>

    <?php include("includes/navbar.php")?>

	<!-- AUTO CHANGE IMAGE COROUSEL -->

		<div id="myCarousel" class="carousel slide px-lg-4 mt-4" data-bs-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img src="images/carousel/1.png" class="w-100 d-block" />
			</div>
			<div class="carousel-item ">
			<img src="images/carousel/3.png" class="w-100 d-block" />
			</div>
			<div class="carousel-item">
			<img src="images/carousel/4.png" class="w-100 d-block" />
			</div>
			<div class="carousel-item ">
			<img src="images/carousel/6.png" class="w-100 d-block" />
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
		</div>
 

<!-- OUR ROOMS -->
<div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
      <div class="h-line bg-dark col-1"></div> 
    </div>
 <div class="container">
 	<div class="row">



   <!-- 3 RANDOM CARD DB -->
   	<?php
	   	try
		{

		   $sql = "SELECT * FROM rooms";
		   $result = $conn->query($sql);

		   if ($result->num_rows > 0)
			{
			   $rows = [];
			   while ($row = $result->fetch_assoc())
				   {
				   		$rows[] = $row;
				   }
			   
				shuffle($rows);

			    for ($i = 1; $i <= 3; $i++)
				   {
						$row = $rows[$i];
						
						$roomName = $row['roomname'];
						$roomname = preg_replace('/([a-z])([A-Z])/', '$1 $2', $roomName);
						$price = number_format($row['price']);
						$category = preg_replace('/([a-z])([A-Z])/', '$1 $2', $row['category']);
						$capacity = $row['capacity'];
						$rating = $row['rating'];

						echo '<form action="roombook.php" method="get" class="col-lg-4 col-md-6 my-3">';
						//Set Hidden Form Fields
						echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
						echo '<input type="hidden" name="roomid" value="' . $row['roomid']. '">';

						// echo '<div class="col-lg-4 col-md-6 my-3">';
						echo '  <div class="card border-0 shadow home-card">';
						echo '    <img src="' . $row['image'] . '" class="card-img-top" alt="' . $roomname . '" style="max-height: 196.88px;">';
						echo '    <div class="card-body home-card-body">';
						echo '      <h5 class="card-title">' . $roomname . '</h5>';
						echo '      <h6 class="mb-4">&#8377;' . $price . ' per night</h6>';
						echo '      <div class="Category mb-4">';
						echo '        <h6 class="mb-1">Category</h6>';
						echo '        <span class="badge rounded-pill bg-light text-dark text-wrap">' . $category . '</span>';
						echo '      </div>';
						echo '      <div class="guests mb-4">';
						echo '        <h6 class="mb-1">Guests</h6>';
						echo '        <span class="badge rounded-pill bg-light text-dark text-wrap">' . $capacity . '</span>';
						echo '      </div>';
						echo '      <div class="rating mb-4">';
						echo '        <h6 class="mb-1">Rating</h6>';
						echo '        <span class="badge rounded-pill bg-light">';
						for ($j = 0; $j < $rating; $j++)
						{
							echo '          <i class="bi bi-star-fill text-warning"></i>';
						}
						echo '        </span>';
						echo '      </div>';
						echo '      <div class="d-flex justify-content-evenly mb-2">';
						echo '        <button class="btn btn-dark shadow-none col-4 px-1">Book Now</button>';
						echo '        <a href="rooms.php" class="btn btn-sm btn-outline-secondary shadow-none col-5 px-1">More details</a>';
						echo '      </div>';
						echo '    </div>';
						echo '  </div>';
				   		echo '</form>';
				   }
			   }
		   }
		   catch(Exception $ex)
		   {
		   		echo $ex;
		   }
		   finally{
		   		$conn->close();
		   }
?>
		<div class="col-lg-12 text-center mt-5">
 			<a href="rooms.php" class="btn btn-sm btn-outline-secondary rounded-2 fw-bold shadow-none">More Rooms</a>
 		</div>


<!-- OUR FACILITIES -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

 <div class="container">
 	<div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
 		<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
 			<img src="images/Facilities/wifi.svg" width="80px">
 			<h5 class="mt-3">Wifi</h5>
 		</div>
 		<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
 			<img src="images/Facilities/heater.svg" width="80px">
 			<h5 class="mt-3">Room Heater</h5>
 		</div>
 		<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
 			<img src="images/Facilities/ac.svg" width="80px">
 			<h5 class="mt-3">Air conditioner</h5>
 		</div>
 		<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
 			<img src="images/Facilities/geyser.svg" width="80px">
 			<h5 class="mt-3">Geyser</h5>
 		</div>
 		<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
 			<img src="images/Facilities/spa.svg" width="80px">
 			<h5 class="mt-3">Spa</h5>
 		</div>
 		<div class="col-lg-12 text-center mt-5">
 			<a href="#" class="btn btn-sm btn-outline-secondary rounded-2 fw-bold shadow-none">More Facilities</a>
 		</div>
 	</div>
 </div>
   
   <script type="text/javascript">
		const myCarouselElement = document.querySelector("#myCarousel");
		const carousel = new bootstrap.Carousel(myCarouselElement, {
		interval: 2500,
		loop:true,
		});
   </script>
    <?php include("includes/footer.php")?>
</body>
</html>