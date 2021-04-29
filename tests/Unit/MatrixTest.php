<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Talentql\Matrix;

class MatrixTest extends TestCase
{
    /** @test */
    public function check_matrix_same_column_size_is_true(): void
    {
        $array = [[2, 3], [5, 7]];
        $matrix_column = Matrix::checkMatrixColumn($array);
        $this->assertTrue($matrix_column);
    }

    /** @test */
    public function check_matrix_same_column_size_is_false(): void
    {
        $array = [[2, 3], [5, 6, 7]];
        $matrix_column = Matrix::checkMatrixColumn($array);
        $this->assertFalse($matrix_column);
    }

    /** @test */
    public function first_matrix_column_count_is_equal_to_second_matrix_row_count(): void
    {
        $array_one = [[2, 3], [4, 5], [6, 7]];
        $array_two = [[4, 5, 6], [7, 8, 9]];
        $matrix_column = Matrix::isColumnEqualRow($array_one, $array_two);
        $this->assertTrue($matrix_column);
    }

    /** @test */
    public function first_matrix_column_count_is_equal_not_to_second_matrix_row_count(): void
    {
        $array_one = [[2, 3], [4, 5], [6, 7], [8, 9]];
        $array_two = [[4, 5, 6], [7, 8, 9]];
        $matrix_column = Matrix::isColumnEqualRow($array_one, $array_two);
        $this->assertFalse($matrix_column);
    }

    /** @test */
    public function multiplying_array_one_with_array_two(): void
    {
        $array_one = [[2, 3], [4, 5], [6, 7]];
        $array_two = [[4, 5, 6], [7, 8, 9]];
        $expected_result = [[29, 34, 39], [51, 60, 69], [73, 86, 99]];
        $result = Matrix::matrixMultiplication($array_one, $array_two);
        $this->assertEquals($expected_result, $result);
    }

    /** @test */
    public function converting_integer_matrix_into_matrix_consisting_of_chars(): void
    {
        $array = [[1, 26], [27, 28]];
        $expected_result = [['A', 'Z'], ['AA', 'AB']];
        $result = Matrix::matrixToAlphabet($array);
        $this->assertEquals($expected_result, $result);
    }
}
