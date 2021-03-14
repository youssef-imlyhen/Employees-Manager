<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php 
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $name = $phone = $job = $email = "";
    $name_err = $phone_err = $job_err = $email_err = "";

    // Processing from data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate name
        $input_name = trim($_POST["name"]);
        
        
        if (empty($input_name)) {
            $name_err = "Please enter a name.";
        }  elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
        } else{
            $name = $input_name;
        }
        
        // Validate job
        $input_job = trim($_POST["job"]);
        
        if (empty($input_job)) {
            $job_err = "Please enter a job.";
        }  elseif(!filter_var($input_job, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $job_err = "Please enter a valid job title.";
        } else{
            $job = $input_job;
        }

        // Remove all illegal characters from email
        $email_input = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (!filter_var($email_input, FILTER_VALIDATE_EMAIL) === false) {
            $email = $email_input;
        } else {
            $email_err = "Please enter a valid eamil title.";
        }

        // Validate phone number
        $phone_input = $_POST["phone"];
        if(strlen($phone_input) >= 10 && strlen($phone_input) <= 15) {
            $phone = $phone_input;
        }else {
            $phone_err = "Please enter a valid phone number.";
        }
        
        // Check input errors before inserting in database
        if (empty($name_err) && empty($phone_err) && empty($job_err) && empty($phone_err)) {
            // prepare an insert statement
            $sql = "INSERT INTO employeesList (name, email, job, phone) VALUES (?, ?, ?,?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_job, $param_phone);

                // set parameters
                $param_name = $name;
                $param_email = $email;
                $param_job = $job;
                $param_phone = $phone;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Records created succssfully.
                      header("location: employees-list.php");


                }else {
                    echo "Something went wrong. Please try aguain later.";
                }
            
                
            } // Close statement
            mysqli_stmt_close($stmt);
        }else {
 
            echo <<<"eof"
            <div class="final-error" style="    width: 100vw;
            height: 300px;
            background-color: lightblue;
            color: #400;">
            <span class="error">    $name_err</span>

            <span class="error">    $email_err</span>
            
            <span class="error">   $phone_err </span>
            </div>
            eof;
        }

        
        // Close connection
        mysqli_close($link);
    }
?>
<!-- 
    prepare the variables inside the form
 -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Employees List</title>
    <style>
        .mat{
            margin-top:10px;
        }
    </style>
  </head>
  <body>

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="dash.php">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
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
                    <input type="search" class="form-control form-control-sm search-input" placeholder="Search.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="searchBtn btn btn-sm btn-success" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </form>

            <a href="logout.php"" class="ml-3 btn btn-sm btn-warning">Log Out</a>

          </div>
        </div>
    </nav>
    <!-- nav -->

    <!-- dashboard contents -->

    <div class="container-fluid mat">
        <div class="row mt-3">
            <div class="col-lg-3 col-md-3">
                <div class="list-group small">
                    <div class="list-group-item active">Employee Data</div>
                    <a href="#" class="list-group-item" data-toggle="modal" data-target="#add_employee">Add Employee</a>
                    <a href="employees-list.php" class="list-group-item">View all Employees</a>
                </div>
            </div>
            
            <div class=" col-lg-9 col-md-9 table-responsive mat" >
                <table class="table table-striped table-hover bg-light small ">
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
    <?php
        // Include config file
        require_once "config.php";

        // Attempt select query execution
        $sql = "SELECT * FROM employeesList";
        if($result = mysqli_query($link, $sql)){
          if(mysqli_num_rows($result) > 0){ 
            while($row = mysqli_fetch_array($result)){
                   
                   echo <<<"EOT"
                    <tr id="{$row['name']}">
                        <td id="td{$row['id']}">{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        
                        <td ><a href="#" data-toggle="modal" data-target="#employee_details1" data-id="{$row['id']}" class="details btn btn-sm btn-block btn-info">Details</a></td>
                        
                        <td><a href="#" data-toggle="modal" data-target="#employee_edit_details1"data-id="{$row['id']}" class="edit btn btn-sm btn-block btn-warning">Edit</a></td>
                        
                        <td><a href="#" class="delete btn btn-sm btn-block btn-danger"data-id="{$row['id']}">Delete</a></td>
                        <input type="hidden" data-id="{$row['id']}" data-name="{$row['name']}" data-email="{$row['email']}" data-job="{$row['job']}" data-phone="{$row['phone']}" class="infos">
                    </tr>
                    EOT;
                    
                }
         } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        // Close connection
        mysqli_close($link);
        ?>
                </table>
            </div>
        </div>
    </div>
    <!-- dashboard contents -->

    <!-- Add Employee Modal -->
    <div class="modal fade" id="add_employee" tabindex="-1" aria-labelledby="add_employee" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Employee Name" required >
                    </div>
<span class="error"> <?php echo $name_err; ?></span>                    
                    <div class="mb-3">
                        <input type="email"name="email" class="form-control form-control-sm" placeholder="Employee Email ID" required>
                    </div>
<span class="error"><?php  echo $email_err;   ?></span>
                    <div class="mb-3">
                        <input type="tel" name="phone" class="form-control form-control-sm" placeholder="Employee Phone Number" required>
                    </div>
<span class="error"><?php echo $phone_err; ?></span>
                    <div class="mb-3">
                        <select class="form-control form-control-sm" name="job">
                            <option value="Graphic Designer">Graphic Designer</option>
                            <option value="Web Designer">Web Designer</option>
                            <option value="Web Developer">Web Developer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="addBtn btn btn-sm btn-success btn-block">Add New Employee</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Details Model -->
    <div class="modal fade" id="employee_details1" tabindex="-1" aria-labelledby="employee_details1" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <table class="table table-striped table-hover bg-light small">
                <tr>
                    <th>ID</th>
                    <td class="dt-id"></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td class="dt-name"></td>
                </tr>
                <tr>
                    <th>Email ID</th>
                    <td class="dt-email"></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td class="dt-phone"></td>
                </tr>
                <tr>
                    <th>Job</th>
                    <td class="dt-job"></td>
                </tr>
            </table>
        </div>
        </div>
    </div>

    <!-- Edit Employee Detaisl -->
    <div class="modal fade" id="employee_edit_details1" tabindex="-1" aria-labelledby="employee_edit_details1" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="data">
                    <div class="mb-3">
                        <input type="text" class="dt-name form-control form-control-sm" name="name" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="dt-email form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" name="phone" class="dt-phone form-control form-control-sm"  required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" name="job" class="dt-job form-control form-control-sm"  required>
                    </div>
                    <div class="mb-3"> <!--data-dismiss="modal"-->
                        <button type="submit"  class="edit-btn btn btn-sm btn-success btn-block" > Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="./index.js"></script>
  </body>
</html>