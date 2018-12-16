<?php

set_time_limit (900); // 900 seconds is about 15 minutes

// objects in php // seperate classes to seperate files

//################
// first_class
//################3
class first_class
{	
	var $name = "harry";
	
	function first_class ( $n )
	{
		$this->name = $n;
	}
	function sayHello()
	{
		print "Hello, my name is $this->name<br>";
	}
}

class second_class extends first_class
{

	function sayHello()
	{
		print "not telling you my name--";
		first_class::sayHello();
	}
	
}
//################
// Table
//################3

class Table
{
	var $table_array = array();
	var $headers = array();
	var $cols;
	
	function Table ( $headers )
	{
		$this->headers = $headers;
		$this->cols = count ( $headers );
	}
	
	function addRow ( $row )
	{
		if ( count ( $row ) != $this->cols )
			return false;
		array_push ( $this->table_array, $row );
		
		return true;
	}
	
	function addRowAssocArray ( $row_assoc )
	{
		$row = array();
		foreach ( $this->headers as $header)
		{
			if ( !isset( $row_assoc[$header] ))
				$row_assoc[$header] = "";
			$row[] = $row_assoc[$header];
		}
		
		array_push ( $this->table_array, $row );
		
		return true;
			
	}
	
	function output()
	{

		print "<pre>";
		
		foreach ( $this->headers as $header )
			print "<B>$header</B> ";
		print "\n";
		
		foreach ( $this->table_array as $y )
			{
			foreach ( $y as $xcell )
				print "$xcell ";
			print "\n";
			}
		print "</pre>";
	}
}// end Table class

//################
// HTMLTable
//################3
class HTMLTable extends Table
{
	var $bgcolor;
	var $cellpadding = "2";
	
	function HTMLTable( $headers, $bg="#ffffff" )
	{
		Table::Table($headers);
		$this->bgcolor=$bg;
	}
	
	function setCellpadding( $padding )
	{
		$this->cellpadding = $padding;
	}
	
	function output()
	{
		print "<table cellpadding=\"$this->cellpadding\" border=1>";
		foreach ( $this->headers as $header )
			print "<td bgcolor=\"$this->bgcolor\"><b>$header</b></td>";
		foreach ( $this->table_array as $row=>$cells )
		{
			print "<tr>";
			foreach ( $cells as $cell )
				print "<td bgcolor=\"$this->bgcolor\">$cell</td>";
			print "</tr>";
		}
		print "</table>";
	}
}// end HTMLTable

class RecordsTable extends HTMLTable
{
	function RecordsTable ( $rs , $bg="#ffffff" )
	{	
		// get field names
		 $fCount = odbc_num_fields($rs);
		   for ($i=1; $i<= $fCount; $i++){
			  $fNames[$i] = odbc_field_name($rs, $i);
			  //echo $fNames[$i] . "\t";
		   }
		
		   $result['fieldNames']=$fNames; //headers
		   
		Table::Table($fNames); // calls the parent class with headers
		
		// assign records into array
		
			for ($i=1; odbc_fetch_row($rs,$i); $i++){
		
			  $record=array();
			  for ($j = 1; $j <= $fCount; $j++){
				 $fName = odbc_field_name($rs, $j);
				 $record[$fName]=odbc_result($rs, $j);
				 //echo $record[$fName] . "\t";
				 
			  }
			   //echo "\n";
			   $this->addRow ( $record ); // add to html table
			  $result[$i]=$record;
	 }
		
		$this->bgcolor=$bg;
	}//end fuction RecordsTable
	
	function RecordsTable2 ( $rs, $bg="#ffffff" )
	{
		$this->RecordsTable( $rs ); 
	}//end function RecordsTableMySQL	
		
}//end RecordsTable

class RecordsTableMySQL extends HTMLTable
{
	function RecordsTableMySQL ( $rs, $bg="#ffffff" )
	{
	// get field names
		 $fCount = mysql_num_fields($rs);
		   for ($i=0; $i< $fCount; ++$i){
			  $fNames[$i] = mysql_field_name($rs, $i);
			  //echo $fNames[$i] . "\t";
		   }

		   $result['fieldNames']=$fNames; //headers

		Table::Table($fNames); // calls the parent class with headers

		// assign records into array
		
			  while ($line = mysql_fetch_array($rs, MYSQL_ASSOC)) {
			  
    			$this->addRow ( $line ); // add to html table
    			/*
    			foreach ($line as $col_value)
    			{
    				echo $col_value;
    			}
    			echo "<br>";
    			*/
    			
			   }//end while
			   
	$this->bgcolor=$bg;
	}//end function RecordsTableMySQL
}//end class RecordsTableMySQL

/* testing classes

$obj = new first_class("bob");
$obj2 = new first_class("harry");
$obj3 = new second_class("son of harry");

print "$obj->name<br>";
print "$obj2->name<br>";
print $obj3->sayHello() ."<br>";


$test = new HTMLTable( array("a","b","c") );
$test->addRow( array (1, 2, 3) );
$test->addRow( array (4, 5, 6) );
$test->addRowAssocArray( array ( "b"=>0, "a"=>6, "c"=>3 ) );
$test->output();

*/

?>
