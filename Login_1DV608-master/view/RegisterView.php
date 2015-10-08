<?php



class RegisterView
{
  	private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordrepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private static $register = 'RegisterView::Register';
    public $userNameExist = false;
    public $invalidCharacters = false;

	public function response()
	{
		$message = "";
		$name = "";

		$userName = $this->getUserName();
		$userPassword = $this->getPassword();
		$repetedPassword = $this->getRepeatedPassword();

		if ($this->userWantsToRegister()) {
			$name = $this->getUserName();
			if (strlen($userName) < 3 && strlen($userPassword) < 6) {
				$message = "UserName has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.";
			}

			else if (strlen($userName) < 3 ) {
				$message = "UserName has too few characters, at least 3 characters.";
			}
			else if (strlen($userPassword) < 6) {
				$message = "Password has too few characters, at least 6 characters.";
			}
			else if ($userPassword != $repetedPassword){
				$message = "The passwords do not match";
			}
			else if ($this->userNameExist){
				$message = "Username exist, pick another username.";
			}
			else if ($this->invalidCharacters){
				$name = trim(strip_tags($name));
				$message = "Username contains invalid characters.";
			}
		}

	return $this->formForRegisterNewMember($message, $name);
	}

	public function userWantsToRegister()
	{
		return isset($_POST[self::$register]);
	}

	public function getUserName()
	{
		if (isset($_POST[self::$name]))
			return trim($_POST[self::$name]);
		
		return "";
	}

	public function getPassword()
	{
		if (isset($_POST[self::$password]))
			return trim($_POST[self::$password]);
		
		return "";
	}

	public function getRepeatedPassword()
	{
		if (isset($_POST[self::$passwordrepeat]))
			return trim($_POST[self::$passwordrepeat]);
		
		return "";
	}

	public function formForRegisterNewMember($message, $name)
	{
		return'
		<a href="?">Back to login</a>
		<h2>Register new user</h2> 
			<form  method="post">
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" size="25" id="' . self::$name . '" name="' . self::$name . '" value="'. $name . '"/>
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="25" id="' . self::$password . '" name="' . self::$password . '" value=""/>
					<br>
					<label for="' . self::$passwordrepeat . '">Repeat Password :</label>
					<input type="password" size="25" id="' . self::$passwordrepeat . '" name="' . self::$passwordrepeat . '" value=""/>
					<br>
					<input type="submit" name="' . self::$register . '" value="Register"/>
				</fieldset>
			</form>
		';
	}
	
}