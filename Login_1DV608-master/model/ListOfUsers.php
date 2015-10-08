<?php

namespace model;

class ListOfUsers {
   
	private $path = "data/UserList.txt";
	private $users = array();

	public function getUserList(){
		unset($this->users);
		$recoveredData = file_get_contents($this->path);
		$recoveredArray = unserialize($recoveredData);

		$this->users = $recoveredArray;
		//print_r($recoveredArray);

		return $this->users;
	}

	public function saveUser($userName, $password)
	{
		$this->getUserList();
		$this->users[$userName] = $password;
		$serializedData = serialize($this->users); 
		file_put_contents($this->path, $serializedData);

	}
}
