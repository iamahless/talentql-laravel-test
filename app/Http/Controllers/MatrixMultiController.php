<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\{Request, JsonResponse};
use App\Talentql\Matrix;

class MatrixMultiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "data" => "required|array",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        list($matrix_one, $matrix_two) = $request["data"];

        if (!(Matrix::checkMatrixColumn($matrix_one)) || !(Matrix::checkMatrixColumn($matrix_two))) {
            return response()->json([
                "status" => "error",
                "message" => "Bad Request: A matrix does not the same column size"
            ], 400);
        }

        if (!Matrix::columnEqualRow($matrix_one, $matrix_two)) {
            return response()->json([
                "status" => "error",
                "message" => "Bad Request: the column count in the first matrix is not equal to the row count of the second matrix"
            ], 400);
        }

        $matrix_three = Matrix::matrixMultiplication($matrix_one, $matrix_two);
        $result = Matrix::matrixToAlphabet($matrix_three);

        return response()->json([
            "status" => "success",
            "result" => $result
        ], 200);
    }
}
