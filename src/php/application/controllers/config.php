
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

    public function __construct(){
        parent::__construct();
        include_once(APPPATH."beans/Broker.php");
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
            $this->load->view('html/view_brokers.php',$data);// implementar ADM dashboard
        }
        else{
            $this->apphelper->loadLoginInputs($data);
            $this->load->view('html/view_login',$data);
        }
    }

    public function read($key=null){
        $_POST['key'] = $key;
        $isLogged = $this->protection->isUserLogged();
        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();
        if($isLogged){
            $data["status"] = true;
            $this->load->model('model_configs');
            if( $this->input->post('key') ){
                $setting = new StdClass;
                $setting->key= $this->input->post('key');
                $data["object"] = $this->model_configs->read( $setting );
            }else{
                $data["object"] = $this->model_configs->read();
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
    
    public function update(){
        $isLogged = $this->protection->isUserLogged();

        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();

        if($isLogged){
            $validationRules = array(
                array('field' => 'key', 'label' => 'Chave', 'rules' => 'required'),
                array('field' => 'value', 'label' => 'Valor', 'rules' => 'required')
            );
            $this->form_validation->set_rules( $validationRules );
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            if( $this->form_validation->run() ){
                $data['status'] = true;
                
                $setting = new StdClass;
                $setting->key= $this->input->post('key');
                $setting->value= $this->input->post('value');
                $this->load->model('model_configs');
                $data["object"] = $this->model_configs->update( $setting  );
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
                $viewName = 'html/view_brokers.php';
                
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
