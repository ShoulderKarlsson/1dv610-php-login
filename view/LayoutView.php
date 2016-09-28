<?php

namespace view;

class LayoutView {

  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) {
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
              ' . $v->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedIn($isLoggedIn) {
      $destination = $_SERVER['REQUEST_URI'] === '/?register' ? '<a href="/">Back to login</a>' : '<a href="?register">Register a new user</a>';

      if ($isLoggedIn) {
          return '
          <h2>Logged in</h2>
          ';
      } else {
          return '
          '. $destination .'
          <h2>Not logged in</h2>
          ';
        }
    }
}
