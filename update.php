<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>

<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $phone = $job = $email = "";
$id = $_REQUEST['id'];
$name_err = $phone_err = $job_err = $email_err = "";




// Processing from data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);

    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    }
    elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate job
    $input_job = trim($_POST["job"]);

    if (empty($input_job)) {
        $job_err = "Please enter a job.";
    }
    elseif(!filter_var($input_job, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $job_err = "Please enter a valid job title.";
    } else {
        $job = $input_job;
    }

    // Remove all illegal characters from email
    $email_input = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validate e-mail
    if (!filter_var($email_input, FILTER_VALIDATE_EMAIL) === false) {
        $email = $email_input;

    } else {
        $email_err = "Please enter a valid eamil.";
    }

    // Validate phone number
    $phone_input = $_POST["phone"];
    if (strlen($phone_input) >= 10 && strlen($phone_input) <= 15) {
        $phone = $phone_input;
    } else {
        $phone_err = "Please enter a valid phone number.";
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($email_err) && empty($job_err) && empty($phone_err)) {
        // prepare an insert statement
        $sql = "UPDATE employeesList SET name = ?, email = ?, job =  ?, phone = ? WHERE id = ? ;";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_job, $param_phone,$param_id);

            // set parameters
            $param_id = $id;
            $param_name = $name;
            $param_email = $email;
            $param_job = $job;
            $param_phone = $phone;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // echo $sql;        
                $myArr = array($name,$email,$job,$phone);

                $myJSON = json_encode($myArr);

                echo $myJSON;
            }else {
                
            }
        } else {
                echo "ERROR: Could not execute query: $sql. ".mysqli_error($link);
        }

        
      // Close statement
      mysqli_stmt_close($stmt);  

    }else{
        $errs = array("0",$name_err,$phone_err,$job_err,$email_err);
        $errJSON = json_encode($errs);
        echo $errJSON;
    }

// Close connection
mysqli_close($link);

}
?>