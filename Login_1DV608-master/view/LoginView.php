<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $l;
	private $message = "";
	private $rememberUserName = "";

	private $loginSuccess = false;
	private $loginFailed = false;
	private $userDidLogout = false;
	private $newUserName = "";
	public $newUserCreated = false;
	
	public function __construct(model\Login $login) {
		$this->l = $login;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		
		if ($this->l->isLoggedIn()) {
			$response = $this->logoutForm();
		}
		else{
		$response = $this->loginForm();
		}
		return $response;
	}

	public function setNewUserCreated() {
		$this->newUserCreated = true;
	}

	public function setNewUserName($userName) {
		$this->newUserName = $userName;
	}

	public function setLoginFailed() {
		$this->loginFailed = true;
	}

	public function setLoginSucceeded() {
		$this->loginSuccess = true;	
	}

	public function setUserLogout() {
		$this->userDidLogout = true;	
	}

	public function logoutForm()
	{
		$message = "";

		if ($this->loginSuccess === true) {
			$message = "Welcome";

		} 
			
		return $this->generateLogoutButtonHTML($message);
	}

	public function loginForm()
	{
		$message = "";
		$name = "";
		//var_dump($this->newUserCreated);
		if ($this->newUserCreated) {

		//	echo"funkar";
			$message = "Registered new user.";
			$name = $this->newUserName;
			//$this->newUserCreated = false;
		}
		if ($this->userWantsToLogout() && $this->userDidLogout) {
			$message = "Bye bye!";
		} else if ($this->userWantsToLogin() && $this->getUsername() == "") {
			$message =  "Username is missing";
		} else if ($this->userWantsToLogin() && $this->getPassword() == "") {
			$message =  "Password is missing";
		} else if ($this->loginFailed === true) {
			$message =  "Wrong name or password";
		} 
		
		return $this->generateLoginFormHTML($message, $name);
	}


	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message, $name) {
		return '

		<a href="?register">Register a new user</a>
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $name . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	

	public function userWantsToLogin(){
		//Find out if user clicked the login-button
		if (isset($_POST[self::$login])){
			$this->rememberUserName = $_POST[self::$name];
			return true;
		}
		//If login button is not clicked return false.
		return false;
	}


	public function userWantsToLogout(){
		
		if (isset($_POST[self::$logout])){
			return true;
		}
		
		return false;
	}

	/**
	* @return String
	*/
	public function getUsername() {
		return $_POST[self::$name];
	}
	/**
	* @return String
	*/
	public function getPassword() {
		return $_POST[self::$password];
	}
	
}