<?php
// Include employeeDAO file
require_once('./dao/entityDAO.php');
 
// Define variables and initialize with empty values
$name = $dob = "";
$telNo = "";
$name_err = $telNo_err = $dob_err = "";
$entityDAO = new entityDAO(); 

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    
    
    // Validate phone number
    $input_telNo = trim($_POST["telNo"]);
    if(empty($input_telNo)){
        $telNo_err = "Please enter the phone number.";     
    } elseif(!ctype_digit($input_telNo)){
        $telNo_err = "Please enter the correct phone number.";
    } else{
        $telNo = $input_telNo;
    }

    
    
    //validate date of birth
    // $input_dob = trim($_POST["dob"]);
    // if(empty($input_dob)){
    //     $dob_err = "Please enter the date of birth.";
    // } elseif(!filter_var($input_dob, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"^([0-9]{2})/([0-9]{2})/([0-9]{4})$")))){
    //     $dob_err = "The date of birth is not a valid date in the format YYYY/MM/DD.";
    // } else{
    //     $dob = $input_dob;
    // }
    $input_dob = trim($_POST["dob"]);
    $month = substr($input_dob, -5,2);    
    $day = substr($input_dob, -2);    
    $year = substr($input_dob, -10, 4); 
    if(empty($input_dob)){
        $dob_err = "Please enter the date of birth.";     
    }elseif($month > 12 || $day > 31 || $year > 2022){
        $dob_err = "The date of birth is not a valid date in the format YYYY/MM/DD.";
    }else{
        $dob = $input_dob;
    }


    // Check input errors before inserting in database
    if(empty($name_err) &&  empty($telNo_err) && empty($dob_err)){   
        $student = new student($id, $name, $telNo, $dob);
        $result = $entityDAO->updateStudent($student);
        echo '<br><h6 style="text-align:center">' . $result . '</h6>';   
        header( "refresh:2; url=index.php" ); 
        // Close connection
        $entityDAO->getMysqli()->close();
    }

} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        $student = $entityDAO->getStudent($id);
                
        if($student){
            // Retrieve individual field value
            $name = $student->getName();
            $telNo = $student->getTelNo();
            $dob = $student->getDob();
        } else{
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit();
        }
    } else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
    // Close connection
    $entityDAO->getMysqli()->close();
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the student record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Tel No</label>
                            <input type="text" name="telNo" class="form-control <?php echo (!empty($telNo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telNo; ?>">
                            <span class="invalid-feedback"><?php echo $telNo_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth</label>
                            <textarea name="dob" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>"><?php echo $dob; ?></textarea>
                            <span class="invalid-feedback"><?php echo $dob_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>