<?php

namespace App\Application\Utils;

use voku\helper\StopWords;

class StringUtils
{
    public static function fromCamelCaseToSnakeCase($input, $snake = '_')
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = mb_strtoupper($match) ? mb_strtolower($match) : StringUtils::mb_lcfirst($match);
        }

        return implode($snake, $ret);
    }

    public static function fromSnakeCaseToCamelCase($snakeString): string
    {
        return preg_replace_callback('/_+[^_]?/u', function ($match) {
            return empty($match[0][1]) ? '' : mb_strtoupper(mb_substr($match[0], 1, 1));
        }, $snakeString);
    }

    /**
     * get name of CSV file for load fixture.
     *
     * @return string
     */
    public static function getNameFileCsvForLoad($name)
    {
        return StringUtils::fromCamelCaseToSnakeCase(str_replace('Fix', '', $name) . 's', 's_') . '.csv';
    }

    /**
     * Split keywords to list.
     *
     * @return string[]
     */
    public static function listOfKeywords($strKeyword)
    {
        return explode(' ', preg_replace('!\s+!', ' ', mb_strtolower($strKeyword)));
    }

    /**
     * Split keywords and expressions to list.
     *
     * @return string[]
     */
    public static function listOfKeywordsAndExpressions($strKeyword)
    {
        preg_match_all(
            "/\"[^\"]+\"|([A-Za-zÀ-ÿ0-9]+[\-\/'][A-Za-zÀ-ÿ0-9]+)|[A-Za-zÀ-ÿ0-9]+/",
            mb_strtolower($strKeyword),
            $matches
        );

        return $matches[0];
    }

    public static function getFrenchStopWords()
    {
        $stopWords = new StopWords();

        return $stopWords->getStopWordsFromLanguage('fr');
    }

    public static function truncate($string, $length)
    {
        if (mb_strlen($string) > $length) {
            $string = mb_substr($string, 0, $length) . '...';
        }

        return $string;
    }

    public static function mb_lcfirst($string)
    {
        return mb_strtolower(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }
}
