<?php
// connects to database through odbc
	$db_name = "cs122";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $dbqMDB ="C:\e7\CedarsDBforE7";
    $dsnCedars = "DRIVER={Microsoft Access Driver (*.mdb)};".
    		"Dbq=$dbqMDB;".
    		"Uid=Admin;Pwd=;";
    
    //$dbq = "C:\\e7\LibraryInventoryE7"; // location of database   	
    $dbq ="C:\wamp64\www\BetaLibraryWebSearch\LibraryInventoryE7";
    //$dsnLibrary = "DRIVER={Microsoft Access Driver (*.mdb)};".
    $dsnLibrary = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};".
    		"Dbq=$dbq;".
    		"Uid=Admin;Pwd=;";
/*
12-16-18 UPDATE
To work on a 64 bit system running Windows 10 and WAMP 3.1.4 64 bit, the Microsoft Access Database Engine 2010 Redistribution 
had to be installed https://www.microsoft.com/en-us/download/details.aspx?id=13255 The open the 64 bit odbc through windows and add the database.
*/

/*
EXAMPLES
http://us.php.net/manual/en/function.odbc-connect.php

odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . "\_database\dbname.mdb", "", "")

// #############

To connect and show tables in a Microsoft Access data base (created in *.asp pages)...

$dbq    =    str_replace("/", "\\", $_SERVER["DOCUMENT_ROOT"]) . "\\path\\to\\database.mdb";
if    (!file_exists($dbq)) { echo "Crap!<br />No such file as $dbq"; }

$db_connection = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbq", "ADODB.Connection", "password", "SQL_CUR_USE_ODBC");

$result = odbc_tables($db_connection);

while (odbc_fetch_row($result)) {
    if(odbc_result($result,"TABLE_TYPE")=="TABLE") {
        echo "<br />" . odbc_result($result,"TABLE_NAME");
    }
}

*/

?>

