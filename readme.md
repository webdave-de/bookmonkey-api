# bookmonkey-api

The bookmonkey-api is a demo api to list, get, create, update and delete books.
It's very handy for [workshops](https://workshops.de). It comes with its own documentation.

## Installation & Usage

- create table and insert Data (more infos `book.sql`)
- create `env.php` with valid values
- publish everything on your webspace;

## Supported actions

    GET     /books          // Get all books
    GET     /books/:isbn    // Get a specific book by ISBN
    POST    /books          // Create a new book
    PUT     /books/:isbn    // Update a book by ISBN
    DELETE  /books/:isbn    // Delete a book by ISBN

## Credits

This project exists, thanks to all the people who contribute.

Additionally we would like to give credits to https://github.com/Farxa for creating the bookmonkey logo.
