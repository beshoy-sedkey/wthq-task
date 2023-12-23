# User & Product Management

This repository contains the code for a microservice built with Laravel that manages users and products. It supports user registration and login, creating, retrieving, updating, and deleting users and products. Additionally, it shows different product prices to users based on their type (normal, gold, and silver).


## Features

- User Registration and Login
- User CRUD operations
- Product CRUD operations
- Dynamic product pricing based on user type

## Requirements
- PHP >= 8.1
- Composer
- MySQL or any other database supported by Laravel
- Laravel >= 8.x

## Installation
Clone the repository and install dependencies:
```bash
git clone https://github.com/beshoy-sedkey/wthq-task
cp .env.example .env
```
```
- Database Configuration
```
DB_CONNECTION=mysql
DB_HOST=wathq-db
DB_PORT=3306
DB_DATABASE=wathq
DB_USERNAME=root
DB_PASSWORD=123456789
```
## RUN Docker
```bash
docker-compose build --up -d 
```
## Migrate Tables In Database
```bash
RUN docker ps (select the CONTAINER ID for auth service)
RUN docker exec -ti --user root (container_id) /bin/bash
RUN php artisan migrate
```
 
## API Reference

#### Register

```http
  Post /api/register
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Required**| 
| `email` | `string` | **Required**|
| `password` | `string` | **Required**|
| `type` | `string` | **Required** **[silver , normal , gold]**|

#### Login

```http
  Post /api/Login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email` | `string` | **Required**| 
| `password` | `string` | **Required**|

#### Create User

```http
  Post /api/user
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Required**| 
| `email` | `string` | **Required**|
| `password` | `string` | **Required**|
| `type` | `string` | **Required** **[silver , normal , gold]**|

#### Update User

```http
  Post /api/user/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Sometimes**| 
| `email` | `string` | **Sometimes**|

#### Show User

```http
  GET /api/user/{id}
```
#### Delete User

```http
  DELETE /api/user/{id}
```
#### List User

```http
  GET /api/user
```




#### Create Product

```http
  Post /api/product
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Required**| 
| `price` | `string` | **Required**|
| `is_active` | `string` | **Required**  **1 or 2**|

#### Update Product

```http
  Post /api/product/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Sometimes**| 
| `price` | `string` | **Sometimes**|

#### Update Product

```http
  Post /api/product/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Sometimes**| 
| `price` | `string` | **Sometimes**|

#### Create a price modifiers for product 
```http
  Post /create/different/prices
```
## Request  Sample
```json
{
  "price_modifiers": [
    {
      "user_type": "gold",
      "value": 5,
      "is_percentage": false
    },
    {
      "user_type": "silver",
      "value": 10,
      "is_percentage": false
    },
    {
      "user_type": "normal",
      "value": 10,
      "is_percentage": false
    }
  ]
}
```
### Show Product For Logged In User
```http
  GET /show/prices/{product_id}
```

#### Show Product

```http
  GET /api/product/{id}
```
#### Delete Product

```http
  DELETE /api/product/{id}
```
#### List Product

```http
  GET /api/product
```

