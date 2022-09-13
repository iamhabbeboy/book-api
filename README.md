## Book API 
Setup procedures

### Install docker and run
> make up_build

Then run migration with 
> make shell 

> php artisan migrate
 
> php artisan db:seed

Use Postman or any other client to access the endpoints
### External service endpoint
  ```
    GET http://localhost/api/external-books?name=A clash of kings
  ```

### CRUD endpoints
A seeder is included in the dockerfile for easy test.
  - Get all books 
    ```
      GET http://localhost/api/v1/books
    ```
  - Get a book
    ```
     GET http://localhost/api/v1/books/1
    ```
  - Update a book
    ``` 
    PUT http://localhost/api/v1/books/1
     { 
       "country": "Kenya"
     }
    ```
  - Delete a book
    ```
      DELETE http://localhost/api/v1/books/1
    ```
  - Create a book
      ```
        POST http://localhost/api/v1/books
        {
            "name": "The lord of the ring",
            "isbn": "1230-123123",
            "authors": [
                "George R. R. Martin",
            ],
            "publisher": "Acme book",
            "country": "United State",
            "release_date": "2022-02-23",
            "number_of_pages": 600
       }
     ```

### Running the test
Run the test within the docker container bash shell with 
> make test

Then run 

> php artisan test
