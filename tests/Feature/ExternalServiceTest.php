<?php

beforeEach(function () {
    $this->response = [
        "data" => [
            [
                "name" => "A Clash of Kings",
                "isbn" => "978-0553108033",
                "authors" => [
                    "George R. R. Martin"
                ],
                "publisher" => "Bantam Books",
                "country" => "United States",
                "release_date" => "1999-02-02T00:00:00",
                "number_of_pages" => 768
            ]
        ],
        "status_code" => 200,
        "status" => "success"
    ];

    $this->errorResponse = [
        "status_code" => 404,
        "status" => "not found",
        "data" => []
    ];
});

test('it can get a status ok from external service', function () {

    $name = "A Clash of Kings";

    $client = guzzleHttpClient(200, $this->response);

    $response = $client->request("GET", "/api/external-books?name={$name}");

    expect($response->getStatusCode())->toBe(200);

});

test('it can get a book json response from external service', function () {

    $name = "A Clash of Kings";

    $client = guzzleHttpClient(200, $this->response);

    $response = $client->request("GET", "/api/external-books?name={$name}");

    $result = json_decode($response->getBody(), true);

    expect($result)->toMatchArray([
        "data" => [
            [
                "name" => "A Clash of Kings",
                "isbn" => "978-0553108033",
                "authors" => [
                    "George R. R. Martin",
                ],
                "publisher" => "Bantam Books",
                "country" => "United States",
                "release_date" => "1999-02-02T00:00:00",
                "number_of_pages" => 768
            ]
        ]
    ]);
});

test('it can\'t find a book from external service', function () {

    $name = "A Clash";

    $client = guzzleHttpClient(404, $this->errorResponse);
    $response = $client->request("GET", "/api/external-books?name={$name}", ['http_errors' => false]);

    $result = json_decode($response->getBody(), true);

    expect($result)->toMatchArray([ "data" => []]);
});

