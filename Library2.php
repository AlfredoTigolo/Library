<?php
/*
Date 11-20-08
Alfredo Tigolo III
File name: Library2.php
Description: An attempt to use html forms to accept user input.
The input is then assigned to an sql query string.
This PHP scripts checks for post input from index.html and also
checks if the inputs are blank.  Default table is ICSLIB
*/

// dsn = data source name
include "Chapter8.php"; // Table, HTMLTables, RecordsTable
include "_odbc2access.php"; // code to write the dsnLibrary
include "_utils.php"; // code contains useful database functions

//error checking
$author = escapeshellcmd ($_POST['author']);
$title = escapeshellcmd ($_POST['title']);
//$ddc = escapeshellcmd ($_POST['ddc']);
$bc = escapeshellcmd ($_POST['bc']);
if ( empty($author) && empty($title) )
	{ die ("please enter author's name or book title"); }
//elseif ( empty($author) )
//	{ die ("please enter author's name" ); }


//global $dsnLibrary; // moved to _utils.php
$db_link_Library = db_connect ($dsnLibrary);
//$rs = array();

/*
$sql = "SELECT * FROM ICSLIB WHERE AUTHOR LIKE 'A%';";
$rs = db_query($sql, $db_link_Library);
showRecords($rs);
print "<hr>";
*/

/*
$sql = "SELECT AUTHOR, TITLE, DDC, LOC FROM ICSLIB WHERE AUTHOR LIKE 'A%';";
$rs = db_query($sql, $db_link_Library);
showRecords2($rs);
print "<hr>";
*/

/*
$sql = "SELECT AUTHOR, TITLE, DDC, LOC FROM ICSLIB WHERE AUTHOR LIKE 'A%';";
$rs = db_query($sql, $db_link_Library); // sends results to this array
//showRecords3($rs);
print "<hr>";

$libraryTable = new RecordsTable ( $rs );
$libraryTable->output();

*/
//debugging input
/*
print "author=$author";
print "<br>";
print "title=$title";
print "<hr>";
*/
$sql = "SELECT AUTHOR, TITLE, DDC, LOC, SOURCE, BC FROM ICSLIB " .
	//"SELECT * FROM ICSLIB " . //shows all the fields
	"WHERE AUTHOR LIKE '%$author%' " .
	"AND TITLE LIKE '%$title%' " .
	"AND BC LIKE '%$bc%' ";
//	"AND DDC LIKE '%$ddc%'";

db_query($sql, $db_link_Library);

/*
print "<hr>";
//debugging sql string
$sql = str_replace("WHERE", "<br>WHERE", $sql);
$sql = str_replace("AND", "<br>AND", $sql);

print $sql;
*/

db_disconnect();

?>
