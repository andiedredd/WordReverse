<?php

namespace App;

class WordReverser
{
    private static function isUpper(string $char): bool
    {
        return mb_strtoupper($char, 'UTF-8') === $char &&
            mb_strtolower($char, 'UTF-8') !== $char;
    }

    private static function reverseWordPreserveCase(string $word): string
    {
        $chars   = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
        $letters = array_values(array_filter($chars, fn($c) => preg_match('/\p{L}/u', $c)));
        $letters = array_reverse($letters);

        $result = [];
        $i = 0;

        foreach ($chars as $c) {
            if (preg_match('/\p{L}/u', $c)) {
                $rev = mb_strtolower($letters[$i], 'UTF-8');
                $result[] = self::isUpper($c) ? mb_strtoupper($rev, 'UTF-8') : $rev;
                $i++;
            } else {
                $result[] = $c;
            }
        }
        return implode('', $result);
    }

    public static function reverseStringWords(string $text): string
    {

        preg_match_all("/\p{L}+|[^\p{L}]+/u", $text, $matches);

        return implode('', array_map(
            fn($token) => preg_match('/\p{L}/u', $token)
                ? self::reverseWordPreserveCase($token)
                : $token,
            $matches[0]
        ));
    }
}
