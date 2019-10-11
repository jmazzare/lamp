<?php
require_once __DIR__ . '/lib/app.php';
\session\require_login($user);
\form\handle_todo_done();
\form\handle_todo_add();

$page = max((int) @$_GET['page'], 1);
$last = \data\get_page_count();
$total = \data\get_todo_count();
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
      Page <?=$page?> of <?=$last?> (<?=$total?> todos)
      <?php if ($page > 1): ?><a href="?page=1">first</a><?php endif ?>
      <?php if ($page > 2): ?><a href="?page=<?=$page-1?>">prev</a><?php endif ?>
      <?php if ($page < $last - 1): ?><a href="?page=<?=$page+1?>">next</a><?php endif ?>
      <?php if ($page < $last): ?><a href="?page=<?=$last?>">last</a><?php endif ?>
      <table width='100%'>
        <thead>
          <tr>
            <th>Done</th>
            <th>Text</th>
            <th>Created On</th>
            <th>Updated On</th>
            <th>Done On</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach(\data\get_todos($page) as $todo): ?>
          <tr>
            <td><?=empty($todo->done_at) ? '&nbsp;' : '&times;' ?></td>
            <td><?=$todo->text ?></td>
            <td><?=$todo->created_at ?></td>
            <td><?=$todo->updated_at ?></td>
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
