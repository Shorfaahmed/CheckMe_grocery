<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$city = $_POST['city'];
$address = $_POST['address'];


// Create connection
$conn = new mysqli('localhost','root','','mydb');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {

      $sql = "INSERT INTO registration(name, email, password, contact, city, address) VALUES ('" . $name . "', '" . $email . "', '" . $password . "','" . $contact . "','" . $city . "' ,'" . $address . "')";

      if ($conn->query($sql) === TRUE) {
        echo'<h1>Congratulations!  You are successfully registered <h1>';
      } 
      else {
        echo "<h1> There is problem <h1>" . $conn->error ;
      }
}





// $conn->close();

// //database connection
// $conn = new mysqli('localhost','root','','promaf');
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }
//   else{
//       $stmt = $conn->prepare('insert into registration(name, email, password, contact, city, address) values(?,?,?,?,?,?)');
//       $stmt->bind_param('ssssss',$name,$email,$password,$contact,$city,$address);
//       $stmt->execute();
//       echo'Congratulations!  You are successfully registered.';
//     }

//   ?>



