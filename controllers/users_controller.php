<?php
    class users_controller extends main_controller {
        
        protected $errors;
        protected user_model $user;
        public function __construct()
        {
            $this->user = user_model::getInstance();
            parent::__construct();
        }

        public function index() {
            if (isset($_SESSION['auth'])){                
                $this->display();
            } else {
                header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
            }
        }
        
        public function login() {
            $option['act'] = 'login';
            if(isset($_POST['log-user'])) {
                $userData = $_POST['data'][$this->controller];
                $userCur = $this->user->loginData($userData);
                if (!$userCur){
                    $this->errors = 'Email or password invalid';
                    return $this->display();
                }
                else {
                    $_SESSION['auth'] = $userCur;
                    header( "Location: ".html_helpers::url(array('ctl'=>'home')));
                }
            }
            $this->display();
        }

        public function signup() {
            $option['act'] = 'signup';
            if(isset($_POST['reg-user'])) {
                $userData = $_POST['data'][$this->controller];
                if(!empty($userData['username']))  {
                    if ($this->user->addRecord($userData)){
                        header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
                    }
                }
            }
            $this->display();
        }

        public function change_pass() {
            $option['act'] = 'change_pass';
            if(isset($_POST['change-pass'])) {
                $users = $_POST['data']['users'];
                $password = md5($users['old']);
                if($this->user->checkOldPassword($password) == '1' ) {
                    if($users['new'] !== $users['confirm']) {
                        $this->errors = 'Confirmation password incorrect';
                        return $this->display();
                    } else {
                        $newpass = md5($users['new']);
                        if($this->user->editRecord($_SESSION['auth']['id'], array('password' => $newpass))) {
                            header( "Location: ".html_helpers::url(array('ctl'=>'users')));                            
                        }
                    }
                } else {
                    $this->errors = 'Password invalid';
                    return $this->display() ;
                }
            }
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
                if(!empty($userData['name']))  {
                    if(isset($_FILES) and $_FILES["image"]["name"]) {
                        if(file_exists(UploadREL .$this->controller.'/'.$records['image'])) {
                            if ($records['image'] != 'avatar_default.png'){
                                unlink(UploadREL .$this->controller.'/'.$records['image']);
                            }
                        }
                        $userData['image'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                    }
                    if ($this->user->editRecord($id, $userData)){
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

        // public function signupSubmit() {
        //     if(isset($_POST['reg-user'])) {
        //         $userData = $_POST['data'][$this->controller];
        //         if(!empty($userData['username']))  {
        //             if ($this->user->addRecord($userData)){
        //                 header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
        //             }
        //         }
        //     }
        // }
    }
?>