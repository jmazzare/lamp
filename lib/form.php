<?php namespace form;

function handle_login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = @$_POST['email'];
        $password = @$_POST['password'];
        if (\data\validate_login($email, $password)) {
            \session\login(\data\get_user($email));
            header('Location: /todos.php');
        } else {
            header('Location: /login.php');
        }
    }
}

function handle_todo_done() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (@$_POST['status'] == 'done') {
            if (@$_POST['id']) {
                $todo = \data\get_todo($_POST['id']);
                $todo->done_at = date("Y-m-d H:i:s");
                \data\save_todo($todo);
            }
            header('Location: /todos.php');
        }
    }
}

function handle_todo_add() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (@$_POST['status'] == 'new') {
            if (@$_POST['todo']) {
                $todo = new \data\Todo();
                $todo->text = $_POST['todo'];
                \data\create_todo($todo);
            }
            header('Location: /todos.php');
        }
    }
}
