<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{

    /**
     * Return list of books
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function get(?int $id = null): JsonResponse
    {
        if ($id) {
            $result = [Book::find($id)];
        } else {
            $result = Book::all();
        }
        return response()->json(['status' => 'ok', 'result' => $result]);
    }

    /**
     * Create new book
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'publication' => 'required|date',
            'words' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->messages()]);
        }
        $book = new Book();
        $book->fill($request->all());
        $book->save();
        return response()->json(['status' => 'ok', 'result' => $book]);
    }

    /**
     * Update book by ID
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'title' => 'sometimes|required',
            'publisher' => 'sometimes|required',
            'author' => 'sometimes|required',
            'genre' => 'sometimes|required',
            'publication' => 'sometimes|required|date',
            'words' => 'sometimes|required|numeric',
            'price' => 'sometimes|required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->messages()]);
        }
        $book = Book::find($request->post("id"));
        $book->fill($request->all());
        $book->save();
        return response()->json(['status' => 'ok', 'result' => $book]);
    }

    /**
     * Delete book
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->messages()]);
        }
        $status = Book::destroy($request->post("id"));
        if($status){
            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'error','message'=>'Book not found']);
        }


    }
}
