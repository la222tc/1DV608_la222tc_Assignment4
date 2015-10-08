<?php


class LayoutView {

  public function render($isLoggedIn, $view, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $view->response() . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
  public function checkUrlIfUserPressedNewUser()
  {
    if(strpos("$_SERVER[REQUEST_URI]", "?register")){
      return true;
    }
    else {
      return false;
    }
  }

  public function chooseLayout($isLoggedIn, LoginView $loginView, DateTimeView $dtv, RegisterView $regView)
  {
    if ($loginView->newUserCreated){
        $this->render($isLoggedIn, $loginView, $dtv); 
    }
    else{

      if ($this->checkUrlIfUserPressedNewUser()) {

      $this->render($isLoggedIn, $regView, $dtv);
      }
      else{
      $this->render($isLoggedIn, $loginView, $dtv); 
      }
    }
  }
}
