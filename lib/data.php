<?php namespace data;

class User {
    public $name;
    public $email;
}

class Todo {
    public $id;
    public $text;
    public $created_at;
    public $updated_at;
    public $done_at;
    function __construct($todo = '') {
        $this->text = $todo;
    }
    static function from_sql_row($row) {
        $todo = new Todo();
        $todo->id = $row['id'];
        $todo->text = $row['text'];
        $todo->created_at = $row['created_at'];
        $todo->updated_at = $row['updated_at'];
        $todo->done_at = $row['done_at'];
        return $todo;
    }
}

function conn() {
    $logger = new \logging\Logger();
    $logger->debug('requesting the data access object');
    static $conn;
    if (!$conn) {
        $logger->info('creating connection');
        try {
            $conn = new \PDO("mysql:dbname=app;host=localhost;", "root", "");
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $logger->warn('the conn connection failed');
            $logger->error($e);
        }
    }
    return $conn;
}

function get_todos($page) {
    $page = max(0, $page - 1) * 10;
    $todos = array();
    $sql = "SELECT * FROM todo LIMIT :start , 10";
    $stmt = conn()->prepare($sql);
    $stmt->bindValue(':start', (int) $page, \PDO::PARAM_INT);
    if ($stmt->execute()) {
        while($row = $stmt->fetch()) {
            $todos[] = Todo::from_sql_row($row);
        }
    }
    $stmt = null;
    return $todos;
}

function get_todo_count() {
    $sql = "SELECT count(*) AS total FROM todo";
    $stmt = conn()->prepare($sql);
    if ($stmt->execute()) {
        list($total) = $stmt->fetch();
        $stmt = null;
        return $total;
    }
    $stmt = null;
    return 0;
}
        
function get_page_count() {
    $total = get_todo_count();
    return (ceil($total / 10));
}

function create_todo($todo) {
    $sql = "INSERT INTO todo (text, created_at) VALUES (?, ?)";
    $stmt = conn()->prepare($sql);
    $stmt->execute(array($todo->text, $todo->created_at));
    $stmt = null;
    return null;
}

function save_todo($todo, $fields) {
    $setters = "";
    $values = array();
    foreach ($fields as $field) {
        $setters .= " $field = ? ";
        $values[] = $todo->$field;
    }
    $sql = "UPDATE todo SET $setters WHERE id = ?";
    $values[] = $todo->id;
    $stmt = conn()->prepare($sql);
    $stmt->execute($values);
    $stmt = null;
    return null;
}

function get_todo($id) {
    $sql = "SELECT * FROM todo WHERE id = ?";
    $stmt = conn()->prepare($sql);
    if ($stmt->execute(array($id))) {
        while($row = $stmt->fetch()) {
            $todo = Todo::from_sql_row($row);
            $stmt = null;
            return $todo;
        }
    }
    $stmt = null;
    return null;
}

function validate_login($email, $password) {
    $sql = "SELECT count(*) as FOUND FROM user WHERE email = ? AND password = ?";
    $stmt = conn()->prepare($sql);
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
    $stmt = conn()->prepare($sql);
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
