<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use \GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use const Grpc\STATUS_OK;

class ExternalBookController extends Controller
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __invoke(Request $request): JsonResponse | BookResource
    {
        abort_if(!$request->has('name') || empty($request->get('name')), 401);

        $api = config('book.api');
        $name = $request->get('name');

        $client = new Client();
        $response = $client->request('GET', sprintf("%s?name=%s", $api, $name));
        $result = $response->getBody()->getContents();

        $json = json_decode($result, true);

        if(!$json) {
            return response()->json([
                "status_code" => 404,
                "status" => "not found",
                "data" => [],
            ])->setStatusCode(404);
        }

        return (new BookResource($json))
            ->response()
            ->setStatusCode(200);

    }
}
