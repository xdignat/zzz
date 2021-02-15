<?php

function callStack() {
  $stacktrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
  print str_repeat("=", 50) ."\n";
  $i = 1;
  foreach($stacktrace as $node) {
    print "$i. ".basename(@$node['file']) .":" .@$node['function'] ."(" .@$node['line'].")\n";
    $i++;
  }
  exit();
}

function debug_backtrace_string() {
    $stack = '';
    $i = 1;
    $trace = debug_backtrace();
    unset($trace[0]); //Remove call to this function from stack trace
    foreach($trace as $node) {
        $stack .= "#$i ".$node['file'] ."(" .$node['line']."): ";
        if(isset($node['class'])) {
            $stack .= $node['class'] . "->";
        }
        $stack .= $node['function'] . "()" . PHP_EOL;
        $i++;
    }
    return $stack;
}
