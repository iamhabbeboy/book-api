<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repository\Book\BookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(public BookRepository $bookRepository)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return BookCollection
     */
    public function index(): BookCollection
    {
        $response = $this->bookRepository->all();

        return (new BookCollection($response))
            ->additional([
                "status_code" => 200,
                "status" => "success"
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return JsonResponse|BookResource
     */
    public function store(BookRequest $request): JsonResponse|BookResource
    {
        $request->validated();

        $response = $this->bookRepository->save($request->all());

        return (new BookResource($response))
            ->additional([
                "status_code" => 201,
                "status" => "success"
            ]);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param int $id
     * @return BookResource|JsonResponse
     * @throws \Exception
     */
    public function show(int $id): BookResource|JsonResponse
    {
        $response = $this->bookRepository->get($id);

        return new BookResource($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return BookResource|JsonResponse
     */
    public function update(Request $request, int $id): BookResource|JsonResponse
    {
        $response = $this->bookRepository->update($id, $request->all());

        return new BookResource($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        $response = $this->bookRepository->delete($id);

        $message = "Book not found";
        if (isset($response->name)) {
            $message = "The book ‘{$response->name}’ was deleted successfully";
        }

        return response()->json([
            "status_code" => 204,
            "status" => "success",
            "message" => $message,
            "data" => []
        ]);
    }
}
