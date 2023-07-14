<?php 
$uname=$_POST['UNAME'];
$email1=$_POST['email1'];
$upswd1=$_POST['upswd1'];
$upswd2=$_POST['upswd2'];
if (!empty($uname))||(!empty($email))||(!empty($upswd1))||(!empty($upswd2))
{ $host="localhost";
$dbusername="root";
$dppassword="";
$dbname="logesh";

$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
if(musqli_connect_error())
{die('connect Error('.mysqli_connect_errno().').mysqli_connect_error());}
else{
$SELECT="SELECT email From register where email=? Limit 1";
$INSERT="INSERT into register(uname1,email,upswd1,upswd2)values(?,?,?,?)";

$stmt=$conn->prepare($SELECT);
$stmt->bind_param("S",$email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum=$stmt->num_rows;

if($rnum==0)
{
$stmt->close();
$stmt=$conn->prepare($INSERT);
$stmt->bind_param("SSSS",$uname1,$email,$upswd1,$upswd2);
$stmt->execute();
echo" New record inserted Successfully";
}
else
{
echo"someone already registered using this email";
}
$stmt->close();
$conn->close();
}
else
{
echo"All fields are required";
die();
}
?>
