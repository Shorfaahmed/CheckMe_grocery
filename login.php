<?php
$email = $_POST['email'];
$password = $_POST['password'];

// Create connection
$conn = new mysqli('localhost','root','','mydb');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {

     // $sql = "INSERT INTO registration(name, email, password, contact, city, address) VALUES ('" . $name . "', '" . $email . "', '" . $password . "','" . $contact . "','" . $city . "' ,'" . $address . "')";
        $sql = "SELECT * FROM registration WHERE email = '".$email."' AND password = '".$password."'";
        $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo'<h1>  You are successfully loged In <h1>';
      } 
      else {
        echo "<h1> You are not registerd yet. <h1>" ;
      }
}


    

  ?>

