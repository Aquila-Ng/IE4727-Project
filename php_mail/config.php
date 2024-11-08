<?php
// Check if constants are already defined before defining them

if (!defined('MAILHOST')) {
    define('MAILHOST', "smtp.gmail.com");
}

if (!defined('USERNAME')) {
    define('USERNAME', "sereneco.donotreply@gmail.com");
}

if (!defined('PASSWORD')) {
    define('PASSWORD', "zouforwizjaunuge");
}

if (!defined('SEND_FROM')) {
    define('SEND_FROM', "sereneco.donotreply@gmail.com");
}

if (!defined('SEND_FROM_NAME')) {
    define('SEND_FROM_NAME', "Serene&Co.donotreply");
}

if (!defined('REPLY_TO')) {
    define('REPLY_TO', "sereneco.donotreply@gmail.com");
}

if (!defined('REPLY_TO_NAME')) {
    define('REPLY_TO_NAME', "Serene&Co.donotreply");
}

?>