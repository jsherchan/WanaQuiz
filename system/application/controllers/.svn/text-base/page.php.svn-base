<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Page extends Front_controller {

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Page()
	{
		parent::Front_controller();
		
		// Load required files
		$this->load->model('pages_model');
		$this->load->library('parser');
	}

	// --------------------------------------------------------------------
    
	/**
	 * Initial Method
	 *
	 * @access	public
	 */
	function index()
	{
		$this->show();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the page passed as uri segment
	 *
	 * @access	public
	 */	
	function show($url='')
	{		
       if($url=="session_expired" && $this->session->userdata('wannaquiz_user_id')!="")
			$this->session->destroy();
			
		$ttle=str_replace('_',' ',$url);
		$data['title']=ucwords($ttle) ." | wannaquiz";
		
		$data['main']="contents/page";
		if($url=='faq')
			$data['nav']="faq";
                
                $user_id = $this->session->userdata('wannaquiz_user_id');
        
                if($user_id)
                {
                    $filter = $this->Member_model->get_filter($user_id);                    
                    if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                    else $this->session->unset_userdata('filtered');
                    
                    $data['filter'] = $filter;
                }
                
		$data['page'] =$this->pages_model->get($url);
		$meta=$this->pages_model->get($url);
		$data['meta_desc']=$meta->CMSMeta_desc;
		$data['meta_keywords']=$meta->CMSMeta_keywords;
		$data['cms_variable']=1;
                $data['url']=$url;
		$this->load->view('index',$data);
	}
		
	function howitworks($content='howitworks'){
		$data['title']="howitworks";
                if($content=='howitworks')
					$data['flag'] = 'howitworks';
             else 
			 		$data['flag'] = 'making_questions';
                
                $user_id = $this->session->userdata('wannaquiz_user_id');
                if($user_id)
                {
                    $filter = $this->Member_model->get_filter($user_id);                    
                    if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                    else $this->session->unset_userdata('filtered');
                    
                    $data['filter'] = $filter;
                }                
             
                $data['main']="howitworks/howitworks";
                $data['page'] =$this->pages_model->get($content);
                $data['cms_variable']=$content;
		$data['meta_desc']=$meta->CMSMeta_desc;
		$data['meta_keywords']=$meta->CMSMeta_keywords;
		$data['nav']='howitworks';
		$this->load->view('index',$data);
	}

        function content($url)
        {
                $user_id = $this->session->userdata('wannaquiz_user_id');
                if($user_id)
                {
                    $filter = $this->Member_model->get_filter($user_id);                    
                    if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                    else $this->session->unset_userdata('filtered');
                    
                    $data['filter'] = $filter;
                }
                
        $data['page'] =$this->pages_model->get($url);
		$meta=$this->pages_model->get($url);
		$data['meta_desc']=$meta->CMSMeta_desc;
		$data['meta_keywords']=$meta->CMSMeta_keywords;
		$data['cms_variable']=1;
        $data['main'] = 'content';
		$this->load->view('index',$data);
        }
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */