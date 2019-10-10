<?php namespace data;


class User {
    public $name;
    public $email;
}

class Todo {
    public $id;
    public $text;
    public $created_at;
    public $done_at;
}

function dao() {
    static $dao;
    if (!$dao) {
        try {
            //$dao = new \PDO("mysql:dbname=app;host=localhost;", "root", "");
            $dao = new \PDO("sqlite:" . __DIR__ . "/../my-db.sqlite3");
            $dao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    return $dao;
}

function get_todos() {
    $todos = array();
    $sql = "SELECT * FROM todo";
    $stmt = dao()->prepare($sql);
    if ($stmt->execute(array())) {
        while($row = $stmt->fetch()) {
            $todo = new Todo();
            $todo->id = $row['id'];
            $todo->text = $row['text'];
            $todo->created_at = $row['created_at'];
            $todo->done_at = $row['done_at'];
            $todos[] = $todo;
        }
    }
    $stmt = null;
    return $todos;
}

function create_todo($todo) {
    $sql = "INSERT INTO todo (text, created_at) VALUES (?, ?)";
    $stmt = dao()->prepare($sql);
    $stmt->execute(array($todo->text, $todo->created_at));
    $stmt = null;
    return null;
}

function save_todo($todo) {
    $sql = "UPDATE todo SET done_at = ? WHERE id = ?";
    $stmt = dao()->prepare($sql);
    $stmt->execute(array($todo->done_at, $todo->id));
    $stmt = null;
    return null;
}

function get_todo($id) {
    $sql = "SELECT * FROM todo WHERE id = ?";
    $stmt = dao()->prepare($sql);
    if ($stmt->execute(array($id))) {
        while($row = $stmt->fetch()) {
            $todo = new Todo();
            $todo->id = $row['id'];
            $todo->text = $row['text'];
            $todo->created_at = $row['created_at'];
            $todo->done_at = $row['done_at'];
            $stmt = null;
            return $todo;
        }
    }
    $stmt = null;
    return null;
}

function validate_login($email, $password) {
    $sql = "SELECT count(*) as FOUND FROM user WHERE email = ? AND password = ?";
    $stmt = dao()->prepare($sql);
    if ($stmt->execute(array($email, sha1($password)))) {
        list($found) = $stmt->fetch();
        $stmt = null;
        return $found;
    }
    $stmt = null;
    return false;
}

function get_user($email) {
    $sql = "SELECT email, name FROM user WHERE email = ?";
    $stmt = dao()->prepare($sql);
    if ($stmt->execute(array($email))) {
        list($email, $name) = $stmt->fetch();
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $stmt = null;
        return $user;
    }
    $stmt = null;
    return false;
}
