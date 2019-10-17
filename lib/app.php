<?php
require_once __DIR__ . '/logging.php';
\logging\Logger::getInstance()->debug('starting app');

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/form.php';
require_once __DIR__ . '/session.php';
