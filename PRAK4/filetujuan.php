<?php
parse_str($_REQUEST['dataku'], $hasil);
//print_r($_REQUEST);
//$hasil = $_REQUEST;
echo $sql = "INSERT INTO USER
					VALUES (
					'$hasil[firstName]',
					'$hasil[lastName]',
					'$hasil[username]',
					'$hasil[email]',
					'$hasil[address]',
					'$hasil[address2]',
					'$hasil[country]',
					'$hasil[state]',
					'$hasil[zip]',
					'$hasil[payment]',
					'$hasil[nameCard]',
					'$hasil[creditCardNumber]',
					'$hasil[expiration]',
					'$hasil[cvv]'
					)
					";

//$hostname = "localhost";
//$username = "root";
//$password = "";
//$databaseName = "billing";
$link = mysqli_connect("localhost","root","","billing");

$sql =	"INSERT INTO `user`(`firstName`, `lastName`, `username`, `emai`, `address`, `address2`, `country`, `state`, `zip`, `payment`, `nameCard`, `creditCardNumber`, `expiration`, `cvv`, `timeInsert`) VALUES ('$hasil[firstName]','$hasil[lastName]','$hasil[username]','$hasil[email]','$hasil[address]','$hasil[address2]','$hasil[country]','$hasil[state]','$hasil[zip]','$hasil[payment]','$hasil[nameCard]','$hasil[creditCardNumber]','$hasil[expiration]','$hasil[cvv]',now())";


if(mysqli_query($link,$sql))
{
  echo "records added successfully.";}
  else
  {
    echo "ERROR: Could not able to execute $sql.".
    mysqli_error($link);
  }
mysqli_close($link);

?>