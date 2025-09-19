<?php

if (!function_exists('sentence_case')) {
    function sentence_case(string $text): string
    {
        $sentences = preg_split('/([.?!]\s*)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        $result = '';
        for ($i = 0; $i < count($sentences); $i += 2) {
            $sentence = ucfirst(strtolower(trim($sentences[$i])));
            $punctuation = $sentences[$i + 1] ?? '';
            $result .= $sentence . $punctuation . ' ';
        }
        return trim($result);
    }
}
