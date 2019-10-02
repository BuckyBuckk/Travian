<?php
session_start();
require_once('../connect.php');

//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
    //3.1.1 Assigning posted values to variables.
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = password_hash(mysqli_real_escape_string($connection,$_POST['password']), PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

    //Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        //Check if the passwords match
        if($_POST['password'] == $_POST['repeatPassword']){
            //3.1.2 Checking if the username is alread taken
            $loginSql = $connection->prepare('SELECT * FROM `users` WHERE username= ?');
            $loginSql->bind_param('s',$username);
            $loginSql->execute();
            
            if ($loginSql->get_result()->num_rows === 0){

                //Check if the email is already taken
                $mailSql = $connection->prepare('SELECT * FROM `users` WHERE email= ?');
				$mailSql->bind_param('s',$email);
				$mailSql->execute();
				
				if ($mailSql->get_result()->num_rows === 0){

                    //Registeres user
                    $registerSql = $connection->prepare("INSERT INTO `users` (username, password, email) VALUES (?, ?, ?)");
					$registerSql->bind_param("sss", $username, $password, $email);
					$registerSql->execute();

					if($registerSql->affected_rows == 1){
                        $smsg = "User registered succesfully!";
                    }
                    else{
                        $fmsg = "Error registering user!";
                    }

                }
                else{
                    $fmsg = "E-mail already registered!";
                }

            } 
            else{
                $fmsg = "Username already in use!";
            }
        }
        else{
            $fmsg = "Passwords do not match!";
        }
    }
    else{
        $fmsg = "Invalid E-mail!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="Travian Login">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">TRAVIAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/login">Login<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php if(isset($smsg)){ ?><div class="alert alert-success text-center" role="alert"> <?php echo $smsg; ?> </div> <?php } ?>
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger text-center" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

    <!-- Login Form -->
    <div class="container text-center">
        <form class="form-group w-50 m-auto" method="POST">
            <h2 class="form-signin-heading">Register</h2>
            <input type="text" name="username" class="form-control w-100 my-2 username-field input-lg" placeholder="Username" required autofocus>
            <input type="password" name="password" id="inputPassword" class="form-control w-100 mb-2" placeholder="Password" required>
            <input type="password" name="repeatPassword" id="repeatPassword" class="form-control w-100 mb-2" placeholder="Repeat password" required>
            <input type="email" name="email" id="email" class="form-control w-100 mb-2" placeholder="E-mail" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <a class="btn btn-lg btn-primary btn-block" href="/login">Login</a>
        </form>
    </div>
</body>
</html>