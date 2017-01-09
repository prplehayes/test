<?php
namespace App\View\Helper;
use Cake\View\Helper;
class CommonHelper extends Helper
{
    public function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
		// open raw memory as file so no temp files needed, you might run out of memory though
		$f = fopen('php://memory', 'w'); 
		// loop over the input array
		
		foreach ($array as $line) { 
			// generate csv lines from the inner arrays
			
			fputcsv($f, $line, $delimiter); 
		}
		// rewrind the "file" with the csv lines
		fseek($f, 0);
		// tell the browser it's going to be a csv file
		header('Content-Type: application/csv');
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		// tell the browser we want to save it instead of displaying it
		header('Content-Disposition: attachement; filename="'.$filename.'"');
		// make php send the generated csv lines to the browser
		fpassthru($f);
    }
	function downloadFile($file){
	   $file_name = $file;
	   $mime = 'application/force-download';
	   header('Pragma: public'); 	
	   header('Expires: 0');		
	   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	   header('Cache-Control: private',false);
	   header('Content-Type: '.$mime);
	   header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	   header('Content-Transfer-Encoding: binary');
	   header('Connection: close');
	   readfile($file_name);	
	   exit();
	}
	public function ageCalculator($dob){
		if(!empty($dob)){
			$birthdate = $dob;
			$age = (date('Y') - date('Y',strtotime($birthdate)));;
			return $age;
		}else{
			return 0;
		}
	}
	public function uniqueNumber($pref='')
	{
		return $pref.substr(number_format(time() * rand(),0,'',''),0,6);
	}
}