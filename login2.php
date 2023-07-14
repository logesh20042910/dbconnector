<?php

$uname = $_POST['uname'];
$upswd = $_POST['upswd'];

if (!empty($uname) && !empty($upswd) )
{
  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "logesh";
  // Create connection
  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error())
  {
    die('Connect Error ('. mysqli_connect_errno() .') '
      . mysqli_connect_error());
  }
  else
  {
    // Checking the User Name
    $SELECT = "SELECT uname1 From register Where uname1 = ? Limit 1";
    //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $uname);
     $stmt->execute();
     $stmt->bind_result($uname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0)
      {
        $stmt->close();
        echo "User Name Not Found<br>";
       }
       else
       {
        echo "User Name Found<br>";
        // Checking the User Name
        $SELECT = "SELECT upswd1 From register Where uname1 = ?";
        //Prepare statement
         $stmt = $conn->prepare($SELECT);
         $stmt->bind_param("s", $uname);
         $stmt->execute();
         $stmt->bind_result($pswd);
         $stmt->fetch();
         echo "<br>Registered Password: ".$pswd;
         echo "<br>Entered Password: ".$upswd;
        if ($upswd == $pswd) {
           echo "<br>Correct Password<br>Successfully Logged In";
        }
        else {
          echo "<br>Incorrect Password";
        }
       }
       $stmt->close();
       $conn->close();
  }
}
else
{
 echo "All field are required";
 die();
}
?>
