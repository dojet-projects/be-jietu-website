<?php
include dirname(__FILE__).'/script_init.php';

define('S_IN', 'in');
define('S_NODE', 'node');

$trie = array('type' => S_IN, 'next' => array());

$fp = fopen('words.txt', 'r');
while ($word = trim(fgets($fp))) {
    $count = 0;
    $node = &$trie;
    foreach (preg_split('/(?<!^)(?!$)/u', $word) as $c) {
        if (mb_strlen($word, 'UTF-8') - 1 === $count++) {
            $type = S_NODE;
        } else {
            $type = S_IN;
        }

        if (!array_key_exists($c, $node['next'])) {
            $node['next'][$c] = array('type' => $type, 'next' => array());
        }
        $node = &$node['next'][$c];
    }
    unset($node);
}

print_r($trie);

$str = '我是法轮功中共';
var_dump(checksentence($trie, $str));

/////////////////////////////////////

function checksentence($trie, $sentence) {
    for ($i = 0; $i < mb_strlen($sentence, 'UTF-8'); $i++) {
        $sub = mb_substr($sentence, $i, null, 'UTF-8');
        var_dump($sub);
        if (check($trie, $sub)) {
            return true;
        }
    }
    return false;
}

function check($trie, $sentence) {
    $c = mb_substr($sentence, 0, 1, 'UTF-8');
    if (!array_key_exists($c, $trie['next'])) {
        return false;
    }

    if ($trie['next'][$c]['type'] === S_NODE) {
        return true;
    }

    return check($trie['next'][$c], mb_substr($sentence, 1, null, 'UTF-8'));
}
