<?php
date_default_timezone_set('Asia/Jakarta');
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
$connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
$conn     = sqlsrv_connect( $host, $connInfo);

$hostmysqli = "10.0.0.10";  //replace your servername
$usernamemysqli = "dit";   //replace your username
$passwordmysqli = "4dm1n";        //replace your password
$dbnamemysqli = "db_qc";    //replace your database name
$con=mysqli_connect($hostmysqli,$usernamemysqli,$passwordmysqli,$dbnamemysqli);

$hostdye = "10.0.0.10";  //replace your servername
$usernamedye = "dit";   //replace your username
$passworddye = "4dm1n";        //replace your password
$dbnamedye = "db_dying";    //replace your database name
$condye=mysqli_connect($hostdye,$usernamedye,$passworddye,$dbnamedye);

//Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    echo ' not connected';
}

$hostname="10.0.0.21";
$database = "NOWPRD";
$user = "db2admin";
$passworddb2 = "Sunkam@24809";
$port="25000";
$conn_string = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname; PORT=$port; PROTOCOL=TCPIP; UID=$user; PWD=$passworddb2; DATABASE=$database;";
$conn2 = db2_connect($conn_string,'', '');
if($conn2) {
}
else{
exit("DB2 Connection failed");
}
?>