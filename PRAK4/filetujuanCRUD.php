<?php
$koneksi = mysqli_connect("localhost", "root", "", "billing");
parse_str($_POST['datakirim'], $hasil);
$action = $_POST['action'];

if ($action == 'insert') {
	$syntaxsql = "INSERT INTO user(firstName, lastName, username, email, address, address2, country, state, zip, payment, nameCard, creditCardNumber, expiration, cvv, timeInsert) VALUES ('$hasil[firstName]','$hasil[lastName]','$hasil[username]','$hasil[email]','$hasil[address]','$hasil[address2]','$hasil[country]','$hasil[state]','$hasil[zip]','$hasil[payment]','$hasil[nameCard]','$hasil[creditCardNumber]','$hasil[expiration]','$hasil[cvv]',now())";
}
elseif ($action == 'update') {
	parse_str($_POST['dataTambahan'], $tambahan);
	$syntaxsql = "UPDATE user SET firstName='$hasil[firstName]',lastName='$hasil[lastName]',username='$hasil[username]',email='$hasil[email]',address='$hasil[address]',address2='$hasil[address2]',country='$hasil[country]',state='$hasil[state]',zip='$hasil[zip]',payment='$hasil[payment]',nameCard='$hasil[nameCard]',creditCardNumber='$hasil[creditCardNumber]',expiration='$hasil[expiration]',cvv='$hasil[cvv]' WHERE username='$tambahan[ketTambahan]'";
}
elseif ($action == 'delete') {
	$syntaxsql = "DELETE FROM user WHERE username='$hasil[username]'";
}
elseif ($action == 'read') {
	$syntaxsql = "SELECT firstName, lastName, username, email, address, address2, country, state, zip, payment, nameCard, creditCardNumber, expiration, cvv FROM user WHERE username='$hasil[username]'";
}
else {
	echo "ERROR ACTION";
	exit();
}

if (mysqli_errno($koneksi)) {
	echo "Gagal Terhubung ke Database".$koneksi -> connect_error; 
	exit();
}else{
	//echo "Database Terhubung";	
}

if ($koneksi -> query($syntaxsql) === TRUE) {
	echo "$action Successfully";
}
elseif ($koneksi->query($syntaxsql) === FALSE){
	echo "Error:  $syntaxsql" .$koneksi -> error;
}
else {
	$result = $koneksi->query($syntaxsql); //bukan true false tapi data array asossiasi
	if($result->num_rows > 0){
		echo "<table id='tresult' class='table table-striped table-bordered'>";
		echo "<thead><th>firstname</th><th>lastname</th><th>username</th><th>email</th><th>address</th><th>address2</th><th>country</th><th>state</th><th>zip</th><th>payment</th><th>nameCard</th><th>creditCardNumber</th><th>expiration</th><th>CVV</th></thead>";
		//echo "<tbody>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row['firstName']."</td><td>". $row['lastName']."</td><td>".$row['username']."</td><td>". $row['email']."</td><td>".$row['address']."</td><td>". $row['address2']."</td><td>".$row['country']."</td><td>". $row['state']."</td><td>".$row['zip']."</td><td>". $row['payment']."</td><td>".$row['nameCard']."</td><td>". $row['creditCardNumber']."</td><td>".$row['expiration']."</td><td>". $row['cvv']."</td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else{
		echo "Data Tidak Tersedia";
	}
}
$koneksi->close();
?>