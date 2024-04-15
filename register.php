<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.3.3/dist/css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
      <div class="form-container">
        <div class="box form-box py-2">

        <?php 
         
        include("php/config.php");
        if(isset($_POST['btnSubmit']))
        {
            function generateAlphanumericID() 
            {
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                $id = '';
                for ($i = 0; $i < 7; $i++) 
                {
                    $id .= $chars[rand(0, strlen($chars) - 1)];
                }
                return $id;
            }

            $userid = generateAlphanumericID();
            $username = $_POST['txtUName'];
            $email = $_POST['txtEmail'];
            $dob = $_POST['txtDob'];
            $pass = $_POST['txtPass'];
            $cpass=$_POST['txtCpass'];


            //EMAIL  VALIDATE
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Invalid Email</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }
                //PASSWORD AND CONFIRM PASSWORD
            else if($pass!==$cpass)
            {         
                $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Password do not match!</strong> Please try again
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
            } else
            {
                try
                {
                    //verifying the unique email
                    global $result;
                    $qry = "SELECT email FROM users WHERE email='$email' ";
                    $result = $conn->query($qry);

                    if ($result->num_rows > 0)
                    {
                        $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong> Email is alreay used!</strong> try another email.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></>
                                </div>";
                    } else
                    {
                        try
                        {
                            $qry = "INSERT INTO users(userid,username,email,dob,pass) VALUES('$userid','$username','$email','$dob','$cpass')";
                            $result = $conn->query($qry);
                            if ($result)
                            {
                                $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                <strong>Registration Success!. <a href='index.php' style='text-decoration: none;'>Sign In</a></strong>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                            } else
                            {
                                $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                            <strong> Something went wrong!,</strong> Please Try again.
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>";
                            }
                        } catch (Exception $e)
                        {
                            $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong> Something went wrong!,</strong> Please Try again.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                        } finally
                        {
                            $conn->close();
                        }
                    }

                } catch (Exception $ex)
                {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong> Email is alreay used!</strong> Something went wrong, Please try again later
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }
            
         }
         
        ?>


            <div class="px-4">
                <h3 class="fw-bold h-font text-center">Discover Serenity by the Sea 🌊</h3>
                <div class="h-line bg-dark col-8"></div> 
            </div>            
            
            <form action="" method="post">
                <header>Create Your Account and Join the Coral Cove Family</header>
                    <div class="container-fluid">
                          <?php if(isset($success)) echo $success; ?>
                           <?php if(isset($error)) echo $error; ?>

                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="txtUName" id="username" autocomplete="off" required>
                    
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="txtEmail" id="email" autocomplete="off" required>
                

                        <label for="age" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="txtDob" id="dob" autocomplete="off" required>
                
                        <label for="password"class="form-label">Password</label>
                        <input type="password"class="form-control" name="txtPass" id="pass" autocomplete="off" required>

                        <label for="password"class="form-label">Confirm Password</label>
                        <input type="password"class="form-control" name="txtCpass" id="cpass" autocomplete="off" required>
                        
                        <button class="btn btn-dark mt-4 mb-2" name="btnSubmit">Register</button>

                        <div class="links">
                            Already have an account? <a href="index.php">Sign In</a>
                        </div>
                    </div>
            </form>
        </div>
      </div>
        <script src="bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="app.js"></script>
</body>
</html>