<?php
require_once __DIR__ . '/lib/app.php';
\session\require_login($user);
$todo = \data\get_todo(@$_GET['id']);
if (!$todo) {
  http_response_code(404);
  echo "<h1>Not Found</h1>";
  echo "<a href='/todos.php'>back to all todos</a>";
  die();
}

\form\handle_todo_edit();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit a Todo</title>
  </head>
  <body>
    <header>
      Welcome, <?=$user->name?>.<br />
      <a href="/logout.php">Log out</a>
    </header>
    <main>
      <h1>Todo Editor</h1>
      <form method="POST">
        <input type="hidden" name="id" value="<?=$todo->id?>"/>
        <input autofocus type="text" name="todo" value="<?=htmlentities($todo->text)?>" style="width:100%;"/>
        <input type="submit" value="Edit Todo" />
      </form>
  
      <a href='/todos.php'>back to all todos</a>
    </main>
  </body>
</html>

