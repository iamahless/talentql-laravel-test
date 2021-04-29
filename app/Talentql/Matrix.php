<?php


namespace App\Talentql;

use \Illuminate\Http\JsonResponse;

class Matrix
{
    /**
     * The function checkMatrixColumn is checking if a matrix has the same column sizes & checks
     *
     * @param array $matrix / 2 dimensional array
     * @return boolean / returns true false
     */
    public static function checkMatrixColumn(array $matrix): bool
    {
        $first_column_length = null;
        foreach ($matrix as $key => $value) {
            $first_column_length = ($first_column_length ?? sizeOf($value));
            if ($first_column_length !== sizeOf($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * This function checks if the column count in the first matrix is equal to the row count of the second matrix
     * @param array $matrix_one stands for the first matrix
     * @param array $matrix_two stands for the second matrix
     * @return boolean / returns true false
     */
    public static function isColumnEqualRow(array $matrix_one, array $matrix_two): bool
    {
        return sizeOf($matrix_one) === sizeOf($matrix_two[0]);
    }

    /**
     * The function matrixMultiplication is multiplying matrix_one with matrix_two
     * @param array $matrix_one stands for the first matrix
     * @param array $matrix_two stands for the second matrix
     * @return array $matrix_three stands for the resulting matrix
     */
    public static function matrixMultiplication(array $matrix_one, array $matrix_two): array
    {
        $matrix_three = [];
        for ($i = 0; $i < sizeOf($matrix_one); $i++) {
            for ($n = 0; $n < sizeOf($matrix_two[0]); $n++) {
                $matrix_three[$i][$n] = 0;
                for ($k = 0; $k < sizeOf($matrix_two); $k++) {
                    $matrix_three[$i][$n] += $matrix_one[$i][$k] * $matrix_two[$k][$n];
                }
            }
        }
        return $matrix_three;
    }

    /**
     * The function matrixToAlphabet is converting an integer matrix into a matrix consisting of chars
     * @param array $matrix is a matrix consisting of numbers/ integers
     * @return array $result is a matrix consisting of chars
     */
    public static function matrixToAlphabet(array $matrix): array
    {
        $result = [];
        foreach ($matrix as $key_row => $value_row) {
            foreach ($value_row as $key_column => $value_column) {
                $result[$key_row][$key_column] = self::integerToChar($value_column);
            }
        }
        return $result;
    }

    /**
     * The function integerToChar is converting an integer to a character. for example: 1 => A, 26 => Z, 27 => AA, 28 => AB.
     * @param int $param stands for an integer
     * @return string $text stands for a string consisting of one or more characters
     */
    public static function integerToChar(int $param): string
    {
        $text = "";
        while ($param > 0) {
            $currentLetterNumber = ($param - 1) % 26;
            $currentLetter = chr($currentLetterNumber + 65);
            $text = $currentLetter . $text;
            $param = ($param - ($currentLetterNumber + 1)) / 26;
        }
        return $text;
    }
}
