<?php

//Initialize session
session_set_cookie_params(0);
session_start();
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('model/Login.php');
require_once('model/ListOfUsers.php');
require_once('model/RegisterUser.php');
require_once('model/User.php');

require_once('controller/LoginController.php');
require_once('controller/RegisterUserController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_set_cookie_params(0);

$listOfUsers = new model\ListOfUsers();

$login = new \model\Login($listOfUsers);
$register = new \model\RegisterUser();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($login);
$dtv = new DateTimeView();
$lv = new LayoutView();
$regView = new RegisterView();


$regController = new RegisterUserController($regView, $register, $v);
$lc = new LoginController($v, $login);

$regController->startRegisterNewUser();


$lc->tryToLogin();

$lv->chooseLayout($login->isLoggedIn(), $v, $dtv, $regView);

