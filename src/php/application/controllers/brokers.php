
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brokers extends CI_Controller {

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

    public function create(){
        $isLogged = $this->protection->isUserLogged();

        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();

        if($isLogged){
            $validationRules = array(
                array('field' => 'ip_address', 'label' => 'Endereço IP', 'rules' => 'required'),
                array('field' => 'port', 'label' => 'Porta', 'rules' => 'required|is_natural_no_zero'),
                array('field' => 'topic', 'label' => 'Tópico', 'rules' => 'required')
            );
            $this->form_validation->set_rules( $validationRules );
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            $this->form_validation->set_message('is_natural_no_zero', 'O campo %s deve ser um número natural não nulo.');
            if( $this->form_validation->run() ){
                $data["status"] = true;
                $newBroker = new Broker(null, $this->input->post('ip_address'), $this->input->post('port'), $this->input->post('topic'));
                $this->load->model('model_brokers');
                $data["object"] = $this->model_brokers->create($newBroker);
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
    
    public function read($id=null){
        $isLogged = $this->protection->isUserLogged();

        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();
        
        if($isLogged){
            $this->load->model('model_brokers');
            if($id){//if there's an id
                if(preg_match("/^\d+$/i",$id, $matches)){//this id must to be only numbers
                    $data['status'] = true;
                    $data["object"] = $this->model_brokers->read( new Broker($id, null, null, null) );
                }else{
                    $data['status'] = false;
                    $data['errors'][] = $this->apphelper->getErrMsgs()['onlyNumbers'];
                }
            }else{
                $data['status'] = true;
                $data["object"] = $this->model_brokers->read();
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
    
    public function update(){
        $isLogged = $this->protection->isUserLogged();

        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();

        if($isLogged){
            $validationRules = array(
                array('field' => 'id', 'label' => 'ID', 'rules' => 'required|is_natural_no_zero')
            );
            $this->form_validation->set_rules( $validationRules );
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            $this->form_validation->set_message('is_natural_no_zero', 'O campo %s deve ser um inteiro positivo.');
            if( $this->form_validation->run() ){
                $id = $this->input->post('id');
                $broker = new Broker($id, null, null, null);

                if( $this->input->post('ip_address') ){
                    $broker->setIpAddress( $this->input->post('ip_address') );
                }
                
                if( $this->input->post('port') ){
                    $broker->setPort( $this->input->post('port') );
                }
                
                if( $this->input->post('topic') ){
                    $broker->setTopic( $this->input->post('topic') );
                }
                
                $data['status'] = true;
                $this->load->model('model_brokers');
                $data["object"] = $this->model_brokers->update( $broker );
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
    
    public function delete(){
        $isLogged = $this->protection->isUserLogged();
        
        $data['status'] = null;
        $data['object'] = array();
        $data['errors'] = array();

        if($isLogged){
            $validationRules = array(
                array('field' => 'id', 'label' => 'ID', 'rules' => 'required|is_natural_no_zero')
            );
            $this->form_validation->set_rules( $validationRules );
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            $this->form_validation->set_message('is_natural_no_zero', 'O campo %s deve ser um inteiro positivo.');
            if( $this->form_validation->run() ){
                $broker= new Broker($this->input->post('id'), null, null, null);
                $data["status"] = true;
                $this->load->model('model_brokers');
                $data["object"] = $this->model_brokers->delete( $broker );
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
