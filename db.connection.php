<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "regitration_form_data";

$connection = mysqli_connect($server, $user, $password, $db);

if ($connection) {
?>
<!-- <script>
    alert("Connection Successfull");
</script> -->
<?php
}
else {
?>
<script>
    alert("No Connection");
</script>
<?php
}


?>