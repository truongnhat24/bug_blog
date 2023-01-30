<?php
    class users_controller extends main_controller {
        
        protected $errors;

        public function index() {
            $this->display();
        }
        
        public function login() {
            $option['act'] = 'login';
            $this->display();
        }

        public function signup() {
            $option['act'] = 'signup';
            $this->display();
        }

        public function user_profile() {
            $records = $this->getData($_SESSION['auth']['id'], 'user_profile');
            $this->setProperty('records',$records);
            $this->display();
        }

        public function edit_profile() {
            $records = $this->getData($_SESSION['auth']['id'], 'edit_profile');
            $this->setProperty('records',$records);

            if(isset($_POST['edit-btn'])) {
                $id = $_SESSION['auth']['id'];
                $userData = $_POST['data'][$this->controller];
                //var_dump($_FILES); exit();
                if(!empty($userData['name']))  {
                    if(isset($_FILES) and $_FILES["image"]["name"]) {
                        $user = user_model::getInstance();
                        if(file_exists(UploadREL .$this->controller.'/'.$records['image']))
                            unlink(UploadREL .$this->controller.'/'.$records['image']);
                        $userData['image'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                    }
                    if ($user->editRecord($id, $userData)){
                        header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'user_profile')));
                    }
                }
            }

            $this->display();
        }

        public function logout() {
            session_unset(); 
            session_destroy(); 
            header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
        }
        
        public function loginSubmit() {
            if(isset($_POST['log-user'])) {
                $userData = $_POST['data'][$this->controller];
                $user = new user_model();  //khoi tao class de dung getInstance
                $userCur = $user->loginData($userData);
                if (!$userCur){
                    $this->errors = 'Email or password invalid';
                    return $this->display();
                }
                else {
                    $_SESSION['auth'] = $userCur;
                    $user = user_model::getInstance();                
                    header( "Location: ".html_helpers::url(array('ctl'=>'home')));
                }
            }
        }

        public function signupSubmit() {
            if(isset($_POST['reg-user'])) {
                $userData = $_POST['data'][$this->controller];
                if(!empty($userData['username']))  {
                    $user = user_model::getInstance();
                    if ($user->addRecord($userData)){
                        header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
                    }
                }
            }
        }
    }
?>