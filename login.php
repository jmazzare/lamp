<?php

require_once __DIR__ . '/lib/app.php';

\form\handle_login();

if (\session\is_logged_in()) {
    header('Location: /todos.php');
    exit();
}

$_SESSION['now'] = microtime();

?>
    <form method="POST">
      <label style="display: block;">
        Email<br />
        <input type="text" name="email" value="admin@example.com" />
      </label>
      <label style="display: block;">
        Password<br />
        <input type="password" name="password" value="password" />
      </label>
      <input type="submit" value="Login" />
    </form>