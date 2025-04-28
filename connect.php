 <?PHP 
   $host = '127.0.0.1'; 
   $db = 'student'; // database name  
   $user = 'root'; // Replace with your MySQL username 
   $pass = ''; // Replace with your MySQL password 
   // Create a connection 
   $conn = new mysqli($host, $user, $pass, $db); 
 
   // Check the connection 
   if ($conn->connect_error) { 
       die("Connection failed: " . $conn->connect_error); 
   } 
   else{
    echo '';
   }


$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$service    = $_POST['service']    ?? '';
$period    = $_POST['period']    ?? '';
$sql= "INSERT INTO tross(username,email,service,period) VALUES ('$fullName','$email','$service','$period')";

   echo "<h1>AMAKURU YABITSWE NEZA<H1>";

   
   mysqli_query($conn,$sql);


   ?>