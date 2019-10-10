<?php
require_once __DIR__ . '/lib/app.php';
\session\require_login($user);
\form\handle_todo_done();
\form\handle_todo_add();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Todos:</title>
  </head>
  <body>
    <header>
      Welcome, <?=$user->name?>.<br />
      <a href="/logout.php">Log out</a>
    </header>
    <main>
      <h1>Todo Manager</h1>
      <h2>New Todo</h2>
      <form method="POST">
        <input type="text" name="todo" />
        <input type="hidden" name="status" value="new" />
        <input type="submit" value="Add Todo" />
      </form>
      <h2>Existing Todos</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Done</th>
            <th>Text</th>
            <th>Created On</th>
            <th>Done On</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach(\data\get_todos() as $todo): ?>
          <tr>
            <td><?=$todo->id ?></td>
            <td><?=empty($todo->done_at) ? '&nbsp;' : '&times;' ?></td>
            <td><?=$todo->text ?></td>
            <td><?=$todo->created_at ?></td>
            <td><?=$todo->done_at ?></td>
            <td>
              <form method="POST">
                <input type="hidden" name="status" value="done" />
                <input type="hidden" name="id" value="<?=$todo->id?>" />
                <input type="submit" value="Mark Done" />
              </form>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
