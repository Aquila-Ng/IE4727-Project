<?php
// Check if constants are already defined before defining them

if (!defined('MAILHOST')) {
    define('MAILHOST', "smtp.gmail.com");
}

if (!defined('USERNAME')) {
    define('USERNAME', "serenenco.donotreply@gmail.com");
}

if (!defined('PASSWORD')) {
    define('PASSWORD', "gjmxonxpcfesizkj");
}

if (!defined('SEND_FROM')) {
    define('SEND_FROM', "serenenco.donotreply@gmail.com");
}

if (!defined('SEND_FROM_NAME')) {
    define('SEND_FROM_NAME', "Serene&Co.donotreply");
}

if (!defined('REPLY_TO')) {
    define('REPLY_TO', "serenenco.donotreply@gmail.com");
}

if (!defined('REPLY_TO_NAME')) {
    define('REPLY_TO_NAME', "Serene&Co.donotreply");
}

?>