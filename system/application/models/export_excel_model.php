<?php
class Export_excel_model extends Model
{

	function Export_excel_model()
	{
		parent::Model();
	}
	
	
	function GenerateExcelFile($hdrs,$all_vals,$filename) //function to generate excel file
	{
		//print_r($hdrs)."<br>";
		//print_r($all_vals)."<br>";
		
		//echo count($hdrs)."<br>";
		//echo count($all_vals);
		$header="";
		
		//to print headers to the excel file
		for($i=0;$i<sizeof($hdrs['values']);$i++) {
		$header .= $hdrs['values'][$i]."\t"; 
		}
		$data="";
		for($i=0;$i<sizeof($all_vals);$i++) 
 		{ 
 			$line = ''; 
 			for($j=0;$j<count($all_vals[$i]);$j++){ 
			if ((!isset($all_vals[$i][$j]) OR ($all_vals[$i][$j]=="")))
				{ 
 					$value = "\t"; 
 				} //end of if
				else 
				{ 
 					$value = str_replace('"', '""', $all_vals[$i][$j]); 
 					$value = '"' . $value . '"' . "\t"; 
 				} //end of else
 				$line .= $value; 
 			} //end of foreach
 			$data .= trim($line)."\n"; 
 		}//end of the while 
 		$data = str_replace("\r", "", $data); 
		if ($data == "") 
 		{ 
 			$data = "\n(0) Records Found!\n"; 
 		} 
		//echo $data;
		header("Content-type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  
	
	
	}

}
?>