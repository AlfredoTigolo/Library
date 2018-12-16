<?php

// functions for communicating with the database

// connecting with the database
function db_connect($dataSourceName)
{
	global $dsn, $db_user, $db_pass;
    //$db_link = odbc_connect($dsn, $db_user, $db_pass,  SQL_CUR_USE_ODBC);
	$db_link = odbc_connect($dataSourceName, $db_user, $db_pass,  SQL_CUR_USE_ODBC);
	//$db_link = odbc_connect($dataSourceName, $db_user, $db_pass,  SQL_CUR_USE_DRIVER);
	//$db_link = odbc_connect($dataSourceName, $db_user, $db_pass);
	if (!$db_link)
		{ exit("Connection Failed: " . $db_link . $dataSourceName); }
		//{ exit("Connection Failed: " . $db_link ); }

    return $db_link;
}

// disconnecting from database
function db_disconnect()
{
	global $db_link;
	if ($db_link)
	{
		odbc_close($db_link);
	}
	else
	{
		odbc_close_all();
	}
}

// execute a query.  need to pass the query and the database link
function db_query($sqlquery, $database_link)
{
	global $db_link, $rs;
	//return ($rs = odbc_exec ( $db_link, $sqlquery));
	//return ($rs = odbc_exec ( $database_link, $sqlquery));
	$rs = odbc_exec ( $database_link, $sqlquery );
	$libraryTable = new RecordsTable ( $rs );
	$libraryTable->output();
}

//returns a record set 'rs'
function showRecords($rs)
{
	global $rs;
    // Assign the field names to $resultSet['fieldNames']
	
	echo "<pre>";		
   
   $fCount = odbc_num_fields($rs);
   for ($i=1; $i<= $fCount; $i++){
	  $fNames[$i] = odbc_field_name($rs, $i);
	  echo $fNames[$i] . "\t";
   }

   $resultSet['fieldNames']=$fNames;
	   
	echo "<br>";	
	// Assign the records
	
   for ($i=1; odbc_fetch_row($rs,$i); $i++){

	  $record=array();
	  for ($j = 1; $j <= $fCount; $j++){
		 $fName = odbc_field_name($rs, $j);
		 $record[$fName]=odbc_result($rs, $j);
		 echo $record[$fName] . "\t";
	  }
	   echo "\n";
	
	  $resultSet[$i]=$record;
   }
   echo "</pre>";
}
function showRecords2($rs)
{
	global $rs;
	
	while (odbc_fetch_row($rs))
	{		 
	     for($j=1;$j<=odbc_num_fields($rs);$j++)
	     {
	         echo odbc_field_name($rs,$j) . " = " .  odbc_result($rs,$j) ;	
	     }
	     echo "<br>";
	}
}

function showRecords3($rs)
{
	global $rs;
	
	while (odbc_fetch_row($rs))
	{		 
	     for($j=1;$j<=odbc_num_fields($rs);$j++)
	     {
	         //echo odbc_field_name($rs,$j) . " = " .  odbc_result($rs,$j) ;
	         echo odbc_result($rs, $j);
	     }
	     echo "<br>";
	}
}


?>