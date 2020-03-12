<?php 
session_start();
include('include/db_connect.php');


$data = $_POST;
if (isset($data['submit_reg']))
{
    //

    $errors = array();
    if(trim($data['user_name']) == '')
    {
        $errors[] = 'Введите имя!';
    }

    if(trim($data['email']) == '')
    {
        $errors[] = 'Введите Email!';
    }

    if($data['password'] == '')
    {
        $errors[] = 'Введите пароль!';
    }   

    if($data['password_confirmation'] != $data['password'])
    {
        $errors[] = 'Повторный пароль введен не верно!';
    }

    if(empty($errors))
{
  
$pass = md5($data["password"]);
$pass   = strrev($pass);
$pass   = strtolower("mb03foo51".$pass."qj2jjdp9");

$result = $mysqli->query("INSERT INTO comment_table (name, email, password) VALUES('".$data["user_name"]."', '".$data["email"]."', '$pass')") or die($mysqli->error);
//echo '<div style="color: green;">Вы успешно зарегистрированны!</div>';
}else
{
// echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.html">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
<?php echo '<div style="color: green;">Вы успешно зарегистрированны!</div>'; ?>
<?php require_once 'process.php'; ?>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">
                                <form method="POST">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="user_name" autofocus value="<?php echo @$data['user_name']; ?>">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php 
                                                        if(trim($data['user_name']) == '')
                                                        {
                                                          echo $errors[] = 'Введите имя!';
                                                        }
                                                         ?>   
                                                    </strong>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('name') is-invalid @enderro" name="email" autofocus value="<?php echo @$data['email']; ?>">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        <?php 
                                                        if(trim($data['email']) == '')
                                                        {
                                                           echo $errors[] = 'Введите Email!';
                                                        }
                                                         ?>   
                                                    </strong>
                                                </span>                                            
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('name') is-invalid @enderro" name="password"  autocomplete="new-password" value="<?php echo @$data['password']; ?>">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        <?php 
                                                    if($data['password'] == '')
                                                    {
                                                    echo $errors[] = 'Введите пароль!';
                                                    } 
                                                         ?>   
                                                    </strong>
                                                </span>                                               
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                       <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control @error('name') is-invalid @enderro" name="password_confirmation"  autocomplete="new-password" value="<?php echo @$data['password_confirmation']; ?>">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        <?php 
                                                    if($data['password_confirmation'] != $data['password'])
                                                    {
                                                    echo $errors[] = 'Повторный пароль введен не верно либо пуст!';
                                                    } 
                                                         ?>   
                                                    </strong>
                                                </span>                                             
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" name="submit_reg" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
