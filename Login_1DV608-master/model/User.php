<?php

namespace model;
class User
{
	
	private $_userName;
	private $_password;

	public function __construct($userName, $password)
	{
		$this->_userName = $userName;
		$this->_password = $password;
	}


	public function setUserName($userName)
	{
		$this->_userName = $userName;
	}

	public function getUserName()
	{
		return $this->_userName;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}

	public function getPassword()
	{
		return $this->_password;
	}

	
}