<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.3.3/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="form-container">
        <div class="box form-box ">
        <?php 
            
          include("php/config.php");    
          if(isset($_POST['btnSubmit'])){
            $email = $_POST['txtEmail'];
            $password = $_POST['txtPass'];
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {            
                $qry = " SELECT * FROM users WHERE email='$email' AND pass='$password' ";
                $result = $conn->query($qry);
                $row = $result->fetch_assoc();
                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['dob'] = $row['dob'];
                    $_SESSION['userid'] = $row['userid'];
                    header("Location: home.php");
                }else{
            
                    $error =  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong> Incorrect Login Credentials.</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            
                }
            } else {
                $error =  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong> Please Enter Valid Email</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }
        }        
        ?>
            <div class="my-5 px-4">
                <h3 class="fw-bold h-font text-center">Welcome Back to Paradise! 🌴</h3>
                <div class="h-line bg-dark col-8"></div> 
            </div>

                <header>Please Log In to Continue Your Journey at Coral Cove.</header>
                <form action="index.php" method="post" class="floating needs-validation" novalidate>

                     <?php if(isset($error)) echo $error; ?>
                    
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="txtEmail" id="email" autocomplete="off" class="form-control" required>
                
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="txtPass" id="password" autocomplete="off" class="form-control"required>
            
                    <button class="btn btn-dark mt-4 mb-2" name="btnSubmit">Login</button>                        
                    
                    <div class="links">
                        Don't have account? <a href="register.php">Sign Up Now</a>
                    </div>
                </form>
        </div>
    </div>
    <script src="bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>\
    <script src="app.js"></script>
</body>
</html>