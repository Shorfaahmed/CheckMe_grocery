<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$country = $_POST['country'];
$subject = $_POST['subject'];




// Create connection
$conn = new mysqli('localhost','root','','promaf');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {

      $sql = "INSERT INTO contactus(FirstName, LastName,  Country, Subject) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $country . "','" . $subject . "')";

      if ($conn->query($sql) === TRUE) {
        echo'<h1>Thanks!   Successfully submitted your message. <h1>';
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
//       $stmt->bind_param('ssssss',$first name,$last name,$country,$subject);
//       $stmt->execute();
//       echo'Thanks!  Successfully submitted your message.';
//     }

//   ?>



