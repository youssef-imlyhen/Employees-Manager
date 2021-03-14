<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Dash</title>
  </head>
  <body>
    
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="dash.php">
          Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome Again.
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="employees-list.php">Employees</a>
              </li>
            </ul>
            <form class="d-flex">
                <div class="input-group">
                    <input type="search" class="form-control form-control-sm" placeholder="Search.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-sm btn-success" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <div class="buttons" style="margin-top: 3px;">
              <a href="logout.php" class="ml-3 btn btn-sm btn-danger">Log Out</a>
              <a href="reset-password.php" class="ml-3 btn btn-sm btn-warning">Reset Your Password</a>
            </div>
            

          </div>
        </div>
    </nav>
    <!-- nav -->

    <!-- dashboard contents -->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-3 col-md-3">
                <div class="card card-border">
                    <div class="card-body">
                        <h4 class="card-title">

                          <?php
                            require_once "config.php";

                            $result = mysqli_query($link,"SELECT id FROM employeesList;");
                            $row_cnt = mysqli_num_rows($result);
                            echo $row_cnt;
                            /* close result set */
                            mysqli_free_result($result);
                            /* close connection */
                            mysqli_close($link);
                            
                         ?> 
                         <small class="text-muted">Employees</small></h4>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="employees-list.php" class="list-group-item list-group-item-primary">View all</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- dashboard contents -->

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>