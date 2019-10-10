<?php namespace session;

session_start();

function login($user) {
    session_regenerate_id();
    $_SESSION["email"] = $user->email;
}

function logout() {
    session_regenerate_id();
    unset($_SESSION["email"]);
}

function is_logged_in() {
    return isset($_SESSION["email"]);
}

function require_login(&$user = false, $dest = "/login.php") {
    if (is_logged_in()) {
        if ($user !== false) {
            $email = $_SESSION["email"];
            $user = \data\get_user($email);
        }
    } else {
        header("Location: $dest");
        exit();
    }
}
