<?php

namespace App\Application\Utils;

trait KeywordTrait
{
    /**
     * From a sentence and query variable paths (like acteur.lbNom), return a query condition in which
     * the sentence words and expressions (between "" quotes) are searched in all query variable paths.
     * Also adds as parameter to the query the words and expressions of the sentence.
     *
     * @return array
     *               array[0]: string - The condition, on which we could do $query->andWhere($condition).
     *               array[1]: array - Query parameters of describing the query key and value of each word
     *               used for the condtion. $query->setParameters($parameters)
     */
    public function getKeywordsCondition(string $keywords, array $queryVariables): array
    {
        $keywordsArray = $this->getKeywordsArray($keywords);
        $keyWordsCondition = 'LOWER(';
        $queryParameters = [];
        for ($i = 0; $i < sizeof($keywordsArray); ++$i) {
            $keyWordsCondition .= implode(") LIKE :keyword_$i OR LOWER(", $queryVariables);
            $keyWordsCondition .= ") LIKE :keyword_$i OR LOWER(";
            $queryParameters["keyword_$i"] = $keywordsArray[$i];
        }
        $keyWordsCondition = rtrim($keyWordsCondition, ' OR LOWER(');
        if ($keyWordsCondition) {
            $keyWordsCondition =  $keyWordsCondition . ')';
        }

        return [$keyWordsCondition, $queryParameters];
    }

    /**
     * Split a sentence into an array of words.
     * if :
     * $keywords = 'I write "some key words" "AND" why not pLoP';
     * $stopWords = ['I', 'and', 'why', 'not', 'key']
     * result : [ "write", "some key words", "and", "plop" ].
     */
    private function getKeywordsArray(string $keywords)
    {
        $wordsSplittedByQuote = explode('"', mb_strtolower($keywords));
        $wordsArray = [];
        for ($i = 0; $i < sizeof($wordsSplittedByQuote); ++$i) {
            if (0 === $i % 2) {
                $words = explode(' ', $wordsSplittedByQuote[$i]);
            } else {
                $words = [$wordsSplittedByQuote[$i]];
            }
            if ($words) {
                $wordsArray = array_merge($wordsArray, $words);
            }
        }

        return array_unique(array_map(
            function ($word) {
                return '%' . $word . '%';
            },
            array_values(array_diff(
                $wordsArray,
                StringUtils::getFrenchStopWords(),
                ['']
            ))
        ));
    }
}
