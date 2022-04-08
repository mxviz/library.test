## Library API

### Getting Started

---

This project was built on Laravel 9, PHP 8.1, Bootstrap 5

#### Installation

```
composer require laravel/ui
php artisan ui bootstrap
npm install && npm run dev
```

##### Models:

- Publisher
- Author
- Book

##### Tables:

- publishers
    
    - id
    - title (string, 255)
    - timestamps
    
- authors

    - id
    - name (string, 255)
    - timestamps
    
- books

    - id
    - title (string, 255)
    - timestamps
    
##### Relations:

- Many-To-Many 'books' with 'publishers' (table 'book_publisher')
- Many-To-Many 'authors' with 'books' (table 'author_book')

### API methods

---

1. Get list of books with authors and publishers

```http
GET /api/books
```

##### Response

```
{
  "id"          : int,
  "title"       : string,
  "created_at"  : timestamp,
  "updated_at"  : timestamp,
  "publishers"  : [
    {
      "id"          : int,
      "title"       : string,
      "created_at"  : timestamp,
      "updated_at"  : timestamp,
      "pivot": {
          "book_id"       : int,
          "publisher_id"  : int
      }
    },
    ...
  ],
  "authors": [
    {
        "id"          : int,
        "name"        : string,
        "created_at"  : timestamp,
        "updated_at"  : timestamp,
        "pivot": {
            "book_id"   : int,
            "author_id" : int
        }
    },
    ...
  ]
 }
```

2. Create new book

```http
POST /api/books
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `title` | `string` | **Required**. Book title |
| `publishers` | `array` | **Required**. Publishers ID |
| `authors` | `array` | **Required**. Authors ID |

3. Update book

```http
PUT /api/books/{book_id}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `book_id` | `int` | **Required**. Book ID |
| `title` | `string` | Book title |
| `authors` | `array` | Authors ID |

4. Delete book

```http
DELETE /api/books/{book_id}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `book_id` | `int` | **Required**. Book ID |
