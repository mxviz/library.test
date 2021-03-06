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

#### Database seed

Tou can seed fields made by faker in database with this command

```
php artisan migrate --seed
```

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
| `title` | `string` | **Required**. Book title. Must be unique |
| `publisher_id` | `int` | **Required**. Publisher ID. Must be exists in table 'publishers' |
| `authors` | `array` | **Required**. Authors ID. Each element of array must exists in table 'authors' |

3. Update book

```http
PUT /api/books/{book_id}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `book_id` | `int` | **Required**. Book ID |
| `title` | `string` | Book title. Must be unique |
| `authors` | `array` | Authors ID. Each element of array must exists in table 'publishers'. All existed values will be replaced with new |

4. Delete book

```http
DELETE /api/books/{book_id}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `book_id` | `int` | **Required**. Book ID |
