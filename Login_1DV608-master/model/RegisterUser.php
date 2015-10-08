<?php

namespace model;



class RegisterUser
{

	
public function validateNewUser($userName, $userPassword, $repetedPassword)
{
	
	

	if (strlen($userName) < 3 && strlen($userPassword) < 6) {
		return false;
	}

	else if (strlen($userName) < 3 ) {
		return false;
	}
	else if (strlen($userPassword) < 6) {
		return false;
	}
	else if ($userPassword != $repetedPassword){
		return false;
	}

	else{
		return true;
	}


}
public function checkForInvalidCharacters($userName)
{
	return preg_match('/[^A-Za-z0-9.#\\-$]/', $userName);
}

public function checkIfSameUserName($userName)
{
	$listOfUsers = new ListOfUsers();
	$list = $listOfUsers->getUserList();
	
	foreach ($list as $name => $pass) {

		if ($userName == $name) {
			return true;
		}
	}
	return false;
}
}