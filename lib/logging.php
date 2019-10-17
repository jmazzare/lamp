<?php namespace logging;

class Logger {

    const DEBUG = 'DEBUG';
    const INFO = 'INFO';
    const WARN = 'WARN';
    const ERROR = 'ERROR';
    const FATAL = 'FATAL';

    private $levels = array(
        self::DEBUG => 0,
        self::INFO => 1,
        self::WARN=> 3,
        self::ERROR => 4,
        self::FATAL => 5,
    );

    function __construct($file_name = __DIR__ . '/../logs/app.log') {
        $this->file_name = $file_name;
    }

    function debug($message) {
        return $this->log(self::DEBUG, $message);
    }

    function info($message) {
        return $this->log(self::INFO, $message);
    }

    function warn($message) {
        return $this->log(self::WARN, $message);
    }

    function error($message) {
        return $this->log(self::ERROR, $message);
    }

    function fatal($message) {
        return $this->log(self::FATAL, $message);
    }

    private $log_file;

    function log($level, $message) {
        $min_level = isset($_ENV['MIN_LOG_LEVEL']) ? $_ENV['MIN_LOG_LEVEl'] : 'INFO';
        if ($this->levels[strtoupper($level)] < $this->levels[$min_level]) {
            return;
        }
        $formatted = self::format_message($level, $message);
        if (!$this->open_file()) {
            echo 'Could not open log file';
        } else {
            if (!flock($this->log_file, \LOCK_EX)) {
                echo 'Could not acquire lock';
            } else {
                fwrite($this->log_file, $formatted . "\n");
                fflush($this->log_file);
                flock($this->log_file, \LOCK_UN);
            }
        }
    }

    static function format_message($level, $message) {
        $now = date('c');
        return "$now: $level: $message";
    }

    private function open_file () {
        static $fp;
        if (!$fp) {
            $fp = @fopen($this->file_name, 'a');
            $this->log_file = $fp;
        }
        return is_resource($this->log_file);
    }

    static function getInstance () {
        static $logger;
        if (!$logger) {
            $logger = new Logger();
        }
        return $logger;
    }
}
