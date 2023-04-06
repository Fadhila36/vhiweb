
# sharing foto 

This is a simple API for sharing photos built with Laravel. Users can register, login, upload photos, like and unlike photos, and view a list of all photos and details of individual photos.


## Installation

Clone the repository

```bash
  https://github.com/Fadhila36/vhiweb.git
```

Install dependencies

```bash
  composer install
```
Create a copy of the .env.example file and rename it to .env

```bash
  cp .env.example .env
```
Generate an application key

```bash
  php artisan key:generate
``` 
Set up your database credentials in the .env file

```bash
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
``` 
Run database migrations

```bash
php artisan migrate
```
Start the server

```bash
php artisan serve
``` 
## API Endpoints

### Authentication
#### Register a new user
```http
  POST /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name of user |
| `email` | `string` | **Required**. Email of user |
| `password` | `string` | **Required**. Password of user |

#### Login

```http
  POST /api/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. Email of user|
| `password`      | `string` | **Required**. Password of user|

### Photos
#### List all photos
```http
  GET /api/photos
```
#### Get a specific photo
```http
  GET /api/photos/:id
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required**. ID of photo |


#### Upload a photo

```http
  POST /api/photos
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `caption`      | `string` | **Required**. Caption of photo|
| `tags`      | `string` | **Required**. Tags of photo|
| `image`      | `string` | **Required**. Image file|

#### Update a photo

```http
  PUT /api/photos/:id
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. ID of photo|
| `caption`      | `string` | **Required**. Caption of photo|
| `tags`      | `string` | **Required**. Tags of photo|

#### Delete a photo

```http
  DELETE /api/photos/:id
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. ID of photo|

### Likes
#### Like a photo
```http
  POST /api/photos/:id/like
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. ID of photo|

#### Unlike a photo
```http
  POST /api/photos/:id/unlike
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. ID of photo|


## Postman

[Link Postman public](https://elements.getpostman.com/redirect?entityId=6679946-9708248e-516c-418d-bb91-f24d74f27a6c&entityType=collection)

[Data Postman](https://github.com/Fadhila36/vhiweb/blob/master/data%20postman/Photo.postman_collection.json)

