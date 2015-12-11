
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Readings extends CI_Controller {

    public function __construct(){
        parent::__construct();
        include_once(APPPATH."beans/Reading.php");
        $this->load->helper('form');
        $this->load->library('protection');
        $this->load->library('apphelper');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index(){
        $this->apphelper->loadDefaultViewData($data);
        if($this->protection->isUserLogged()){
            $this->load->model('model_user');
            $email = $this->session->userdata('email');
            $data['sessionUser'] = $this->model_user->getUserByEmail($email);
            $this->load->view('html/view_readings.php',$data);// implementar ADM dashboard
        }
        else{
            $this->apphelper->loadLoginInputs($data);
            $this->load->view('html/view_login',$data);
        }
    }

    public function read($id=null){
        $_POST['id'] = $id;
        $isLogged = $this->protection->isUserLogged();
        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();
        if($isLogged){
            $validationRules = array(
                array('field' => 'id', 'label' => 'ID', 'rules' => 'is_natural_no_zero')
            );
            $this->form_validation->set_rules( $validationRules );
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            $this->form_validation->set_message('is_natural_no_zero', 'O campo %s deve ser um número natural não nulo.');
            if( $this->form_validation->run() ){
                $data["status"] = true;
                $this->load->model('model_readings');
                if( $this->input->post('id') ){
                    $data["object"] = $this->model_readings->read(new Reading( $this->input->post('id'), null, null, null) );
                }else{
                    $data["object"] = $this->model_readings->read();
                }
            }else{
                $data["status"] = false;
                foreach($validationRules as $field){
                    $error = form_error($field['field']);
                    if($error != ""){
                        $data["errors"][] = $error;
                    }
                }
            }
        }else{
            $data['status'] = false;
            $data['errors'][] = $this->apphelper->getErrMsgs()['login'];
        }
        
        //prepare the answer
        $clientAccepts = $this->apphelper->getAcceptHeader();
        switch($clientAccepts[0]){
        case "text/html":
            $this->apphelper->loadDefaultViewData($data);
            if($isLogged){
                $viewName = 'html/view_readings.php';
                
                $this->load->model('model_user');
                $email = $this->session->userdata('email');
                $data['sessionUser'] = $this->model_user->getUserByEmail($email);
            }else{
                $viewName = 'html/view_login';
                $this->apphelper->loadLoginInputs($data);
            }
            break;
        case "application/json":
            $viewName = 'json_render.php';
            $data['jsonData']['status'] = &$data['status'];
            $data['jsonData']['object'] = &$data['object'];
            $data['jsonData']['errors'] = &$data['errors'];
            break;
        default:
            $viewName = 'text_render.php';
            $data['text'] = $this->apphelper->getErrMsgs()['unknowMIME'];
            break;
        }

        //sends the answer
        $this->load->view($viewName, $data);
    }
}

?>
