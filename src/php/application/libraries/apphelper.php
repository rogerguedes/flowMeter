<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppHelper{

    private $siteName = "FlowMeter";
    private $baseUrl;
    private $indexPage;
    static $errMsgs = array(
        'login' => "LoginVocê precisa estar logado para realizar essa ação.",
        'unknowMIME' => "Eu não sei lidar com esse tipo de dado.",
        'onlyNumbers' => "Apenas números são permitidos",
        'validation' => array(
            'empty' => "não pode ser vazio."
        )
    );

    public function getErrMsgs(){
        return self::$errMsgs;
    }

    public function getAppFullPath(){
        $CI =& get_instance();
        $CI->load->helper('url');
        $this->baseUrl = base_url();
        $this->indexPage = index_page();
        if( $this->indexPage == ""){
            return $this->baseUrl;
        }else{
            return $this->baseUrl.$this->indexPage."/";
        }
    }

    public function loadDefaultViewData(&$dataArray){
        $CI =& get_instance();
        $CI->load->helper('url');
        $this->baseUrl = base_url();
        $this->indexPage = index_page();
        $dataArray['siteName'] = $this->siteName;
        $dataArray['baseUrl'] = $this->baseUrl;
        $dataArray['indexPage'] = $this->indexPage;
        $dataArray['appFullPath'] = $this->getAppFullPath();
    }

    public function loadLoginInputs(&$dataArray){
        $dataArray['login_form_inputs']["email"] = array(
            'type'=>'email',
            'id'=>'inputEmail',
            'name'=> 'email',
            'formGroupClass'=>'form-group',
            'class'=>'form-control input-lg',
            'placeholder'=>'Email'
        );
        $dataArray['login_form_inputs']['password'] = array(
            'type'=>'password',
            'id'=>'inputEmail',
            'name'=> 'password',
            'formGroupClass'=>'form-group',
            'class'=>'form-control input-lg',
            'placeholder'=>'Password'
        );
    }

    public function getRequestHeaders(){
        if( function_exists( 'apache_request_headers' ) ){
            return apache_request_headers();
        }
        else{
            foreach($_SERVER as $key => $value) {
                if (substr($key, 0, 5) <> 'HTTP_') {
                    continue;
                }
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[$header] = $value;
            }
            return $headers;
        }
    }

    function getAcceptHeader() {
        $hdr = $this->getRequestHeaders()["Accept"];
        $accept = array();
        foreach(preg_split('/\s*,\s*/', $hdr) as $i => $term){
            $o = new \stdclass;
            $o->pos = $i;
            if (preg_match(",^(\S+)\s*;\s*(?:q|level)=([0-9\.]+),i", $term, $M)) {
                $o->type = $M[1];
                $o->q = (double)$M[2];
            } else {
                $o->type = $term;
                $o->q = 1;
            }
            $accept[] = $o;
        }
        usort($accept, function ($a, $b) {
            /* first tier: highest q factor wins */
            $diff = $b->q - $a->q;
            if ($diff > 0) {
                $diff = 1;
            } else if ($diff < 0) {
                $diff = -1;
            } else {
                /* tie-breaker: first listed item wins */
                $diff = $a->pos - $b->pos;
            }
            return $diff;
        });
        $accept_data = array();
        foreach ($accept as $a) {
            $accept_data[] = $a->type;
        }
        return $accept_data;
    }
}

?>
