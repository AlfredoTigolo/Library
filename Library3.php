<?php
/*
Date 11-20-08
Alfredo Tigolo III
File name: Library3.php
Description: This script allows the user to select different tables
*/

// dsn = data source name
include "Chapter8.php"; // Table, HTMLTables, RecordsTable
include "_odbc2access.php"; // code to write the dsnLibrary
include "_utils.php"; // code contains useful database functions

//error checking
$author = escapeshellcmd ($_POST['author']);
$title = escapeshellcmd ($_POST['title']);
$loc = escapeshellcmd ($_POST['loc']);
$table = ($_POST['tables']);
if ( empty($author) && empty($title) )
	//{ die ("please enter author's name or book title"); }
	{ $title = '1'; }
if ( empty($loc) ) { $loc = 'rm1'; }

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
print "author=$author";
print "<br>";
print "title=$title";
print "<hr>";
foreach ($table as $t);
{
	// if condition describes which table it is looking for
	if ( strtolower($t) == "checked out books"
		|| strtolower($t) == "book inventory"
		|| strtolower($t) == "books checked out to students"
	   )
	{
		$sql = "SELECT * FROM \"$t\" ";
		print "first";
		
	}
	elseif  ( strtolower($t) == "room-1" 
		|| strtolower($t) == "rm-1" )
	{
		$sql = "SELECT * FROM \"$t\" " . 
		"WHERE LOC = '$loc'";
		print "second";
	}
	elseif ( strtolower($t) == "book, author, or location search" )
	{
		$sql = "SELECT * FROM \"$t\" ". 
		"WHERE AUTHORLASTNAME LIKE '%$author%' AND TITLE LIKE '%$title%'";
		print "third";
	}
	else
	{	
		$sql = "SELECT * FROM \"$t\" ". 
		"WHERE AUTHOR LIKE '%$author%' AND TITLE LIKE '%$title%'"; 	
		print "forth";
	}
		//print $sql; //for debugging
		db_query($sql, $db_link_Library);
		print "<hr>";
	
	
}

/*$sql = "SELECT AUTHOR, TITLE, DDC, LOC, SOURCE, BC FROM ICSLIB " .
	"WHERE AUTHOR LIKE '%$author%' AND TITLE LIKE '%$title%';";
*/

db_disconnect();

?>