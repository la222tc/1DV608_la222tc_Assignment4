<?php




class LoginController {
   

    	private $loginView;
        private $loginModel;


  		public function __construct(LoginView $loginView, model\Login $loginModel){
            $this->loginView = $loginView;
            $this->loginModel = $loginModel;
        }



        public function tryToLogin(){

            if ($this->loginView->userWantsToLogin() && !$this->loginModel->isLoggedIn()) {
                $userNameInput = $this->loginView->getUsername();
                $passwordNameInput = $this->loginView->getPassword();

                if ($this->loginModel->validateLogin($userNameInput, $passwordNameInput)) {
                    $this->loginView->setLoginSucceeded();
                }
                else{
                    $this->loginView->setLoginFailed();
                }
                

            }
            else if($this->loginView->userWantsToLogout() && $this->loginModel->isLoggedIn()){
                $this->loginModel->logout();
                $this->loginView->setUserLogout();

            }



	}

}