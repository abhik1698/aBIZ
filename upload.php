<?php
// header("Location: ./view.php");
//Connection
$servername = "localhost";
$username = "id10788386_abiz";
$password = "abizd";
$dbname = "id10788386_abiz";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully to " . $_SERVER['SERVER_NAME'] . "<br>";
$name=  ucwords(trim($_POST['name']));
$email=  trim($_POST['email']);
$subject=  strtoupper(trim($_POST['subject']));
$contact=  trim($_POST['contact']);

//File Upload
$target_dir = "uploads/";
date_default_timezone_set('Asia/Kolkata');
$target_file = $target_dir . $name . ' ' . date('m-d-Y_H:i:s');
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }

//Sql Data Entry
$sql = "INSERT INTO details(name, email, subject, contact)
VALUES ('$name', '$email', '$subject', '$contact')";

if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}


//Email Notification
$msg = "Hi " . $name . ", we will contact you soon for your project on " . $subject . " through " .$contact . ".\nThank you for building-a-business with a deal.\n\nBest regards,\nTeam aBIZ,\nBangalore, India";

// send email
mail($email,"Registration Successfull",trim($msg));


$conn->close();
?>

<html>
   <head>
       <link rel="shortcut icon" href="./res/keyboard.png" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <title>@BIZ Projects</title>
    <style>
    	body{    		    		
    		background: linear-gradient(rgba(255,255,255,.65), rgba(255,255,255,.65)), url("./res/bg2.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
    	}
	</style>
   </head>
   <body>
      <center>
         <h1>@BIZ</h1>
         <label>No Scam!</label>
      </center>
         <?php
            $servername = "localhost";
            $username = "id10788386_abiz";
            $password = "abizd";
            $dbname = "id10788386_abiz";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql = "SELECT name, email, subject FROM details where email= '$email'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()){
                    $name = $row["name"];
                    $email = $row["email"];
                    $subject =  $row["subject"];                    
                }                
            }
            else {
                echo "0 results";
            }
            $conn->close();
            ?>
         <div class="container" style="padding:15px;">
            <center>
               <div style="padding:15px;">
                  <h2 ><?php echo 'Hi '.$name.', we will contact you soon for your project on '.$subject; ?></h2><br><br>
                  <h2 >We thank you for your interest in the deal!</h2>
               </div>
            </center>
         </div>
   </body>
</html>