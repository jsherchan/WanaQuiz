<?php
class Export_report extends Controller {

	function Export_report()
	{
		parent::Controller();	
	 	$this->load->library('parser');
		$this->load->library('session');
	}
	
	function export($file_name)
	{
	$this->load->model('export_excel_model');
	//code to download the data of report in the excel format
	$fn=$file_name.".xls";
		
	//setting the values of the headers and data of the excel file
	$this->export_excel_model->GenerateExcelFile($this->session->userdata('excel_headers'),$this->session->userdata('report_values'),$fn);
	
		
	}


		
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */