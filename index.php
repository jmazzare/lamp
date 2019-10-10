<?php

require_once __DIR__ . '/lib/app.php';
\session\require_login();
header('Location: /todos.php');
