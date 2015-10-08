<?php

class RegisterUserController {

private $regUser;
private $regView;
private $loginView;

public function __construct(RegisterView $regView, model\RegisterUser $regUser, LoginView $loginView)
{
	$this->regView = $regView;
	$this->regUser = $regUser;
	$this->loginView = $loginView;
}

public function startRegisterNewUser()
{
	if ($this->regView->userWantsToRegister()) {
	
		$userName = $this->regView->getUserName();
		$password = $this->regView->getPassword();
		$repetedPassword = $this->regView->getRepeatedPassword();

	
		$validateNewUser = $this->regUser->validateNewUser($userName, $password, $repetedPassword);
		if ($validateNewUser) {
			
			if ($this->regUser->checkIfSameUserName($userName)) {
				$this->regView->userNameExist = true;
			}
			else if ($this->regUser->checkForInvalidCharacters($userName)){
				$this->regView->invalidCharacters = true;
			}
			else{

				$listOfUsers = new model\ListOfUsers();
				$listOfUsers->saveUser($userName, $password);
				$this->loginView->setNewUserCreated();
				$this->loginView->setNewUserName($userName);

				//$link = "http://". $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
            	//header("Location: $link");
            	//exit;


			}
		}

		

	}
}


}

