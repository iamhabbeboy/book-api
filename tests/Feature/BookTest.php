<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, post, delete, put};

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->seed(\Database\Seeders\BookSeeder::class);
});

it('has a list of books', function () {
    get('/api/v1/books')->assertStatus(200);
});

it('has a response preferable payload format', function () {
    $data = [
        'name' => 'The power of discipline',
        'isbn' => '978-0553108033',
        'country' => 'United State',
        'release_date' => '2022-10-13',
        'authors' => [
            'George R. R. Martin'
        ],
        "number_of_pages" => 768,
        "publisher" => "Bantam Books",
    ];
    $response = post('/api/v1/books', $data);
    $response->assertJson([
        "data" => [
            "book" => [
                "name" => "The power of discipline",
                "isbn" => "978-0553108033",
                "authors" => [
                    "George R. R. Martin",
                ],
                "publisher" => "Bantam Books",
                "country" => "United State",
                "release_date" => "2022-10-13",
                "number_of_pages" => 768
            ]
        ],
        "status_code" => 201,
        "status" => "success"
    ]);
});

it('can create a book', function () {
    $data = [
        'name' => 'A Clash of Kings',
        'isbn' => '978-0553108033',
        'country' => 'Nigeria',
        'release_date' => '2022-10-13',
        'authors' => [
            'George R. R. Martin'
        ],
        "number_of_pages" => 768,
        "publisher" => "Bantam Books",
    ];

    $response = post('/api/v1/books', $data);
    $response->assertStatus(201);
});

it('can validate the request params', function () {
    $data = [
        'name' => 'The Lord of the Ring',
        'isbn' => '102323-123',
    ];

    $response = post('/api/v1/books', $data);
    $response->assertStatus(400);
});

it('can validate the request params with validation error', function () {
    $data = [
        'name' => 'The Lord of the Ring',
        'isbn' => '102323-123',
    ];

    $response = post('/api/v1/books', $data);
    $response->assertJsonFragment(["message" => "Validation errors"]);
});


it('has a book', function () {
    get('/api/v1/books/1')->assertStatus(200);
});

it('can delete book', function () {
    delete('/api/v1/books/1')->assertJsonFragment(["status_code" => 204]);
});

it('can update book with response', function () {
    put('/api/v1/books/2', ["country" => "Benin"])->assertJsonFragment(["country" => "Benin"]);
});
