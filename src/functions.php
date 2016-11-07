<?php
function once(callable $callable) {
    static $memory = [];

    if($callable instanceof \Closure || is_object($callable)) {
        $hash = spl_object_hash($callable);
    } else {
        $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
        if(isset($trace[1]['class'])) {
            $hash = $trace[1]['class'].$trace[1]['type'].$trace[1]['function'];
        } else {
            $hash = get_class($trace[0]['args'][0][0]).'@'.$trace[0]['args'][0][1];
        }
    }
    if(false === isset($memory[$hash])) {
        $memory[$hash] = $callable();
    }

    return $memory[$hash];
}
