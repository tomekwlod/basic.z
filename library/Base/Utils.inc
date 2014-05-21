<?php
function debug($var, $label = null, $echo = true, $print_r = false) {
    Zend_Debug::dump($var, $label, $echo, $print_r);
}

function debugp($var, $label = null, $echo = true, $print_r = true) {
    debug($var, $label,$echo, $print_r);
}

function diee($var = '') {
        debug($var);
        $trace = debug_backtrace();
        $tmp = 'DIE CALL @ Line: ' . $trace[0]['line'] . ' :: File: ' . $trace[0]['file'];
        if ($_SERVER['HTTP_HOST']) {
            $tmp = '<div class="debug"><h4>'.$tmp.'</h4></div>';
        }
        $tmp .= "\n";
        die ($tmp);
}
