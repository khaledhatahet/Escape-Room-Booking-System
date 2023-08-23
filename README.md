
# Escape Room Booking System

This project is a RESTful API for an escape room booking system.

## Authentication

This applications uses Laravel Passport package to handle authentication.(https://laravel.com/docs/10.x/passport)

## Installation

Clone the repository

```bash
  git clone https://github.com/khaledhatahet/Rook_Booking_System_API.git
```

Switch to the repo folder

```bash
  cd Rook_Booking_System_API
```

Install all the dependencies using composer

```bash
  composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
cp .env.example .env
```

Generate a new application key

```bash
php artisan key:generate
```

create "personal access" and "password grant" clients which will be used to generate access tokens

```bash
php artisan passport:install
```

Run the database migrations (Set the database connection in .env before migrating)

```bash
php artisan migrate
```

Start the local development server

```bash
php artisan serve
```

You can now access the server at http://localhost:8000

## API ENDPOINTS

#### List all escape rooms

```http
  GET /api/escape-rooms
```


#### Retrieve a specific escape room by its ID.

```http
  GET /api/escape-rooms/{id}
```


#### List available time slots for a specific escape room

```http
  GET /api/escape-rooms/{id}/time-slots
```


#### Create a new booking

```http
  POST /api/bookings
```
Body
| parameter | type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `number_of_participants`      | `smallInteger` | **Required** |
| `booking_date`      | `date` | **Required** |
| `user_id`      | `unsignedBigInteger` | **Required.** (Must be exists in users table)|
| `room_id`      | `unsignedBigInteger` | **Required.** (Must be exists in rooms table)|
| `time_slot_id`      | `unsignedBigInteger` | **Required.** (Must be exists in time_slots table) |
| `discount_percentage`      | `integer` | **Nullable** (The Maximum value accepted is 100) |

Before Creating the booking it is check if there is any booking in same time and checking the number of participants and if the booking is made on the user's birthday, it is apply extra a 10% discount automatically.

#### List all bookings for the authenticated user
```http
  GET /api/bookings
```
Header


| Key | Value     | Required                       |
| :-------- | :------- | :-------------------------------- |
| `Authorization`      | `Bearer accessToken(When user logged in)` | **YES** |

The user must be authenticated.
we can get the accessToken when login or register.

#### Cancel a specific booking by its ID.

```http
  DELETE /api/bookings/{id}
```

#### Register User

```http
  POST /api/registerUser
```
Body
| parameter | type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required** |
| `email`      | `string` | **Required** |
| `password`      | `string` | **Required** |
| `repassword`      | `string` | **Required**  |
| `date_of_birth`      | `date` | **Required** |

#### Login User

```http
  POST /api/loginUser
```
Body
| parameter | type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required** |
| `password`      | `string` | **Required** |



## Tests

Run the following command to run the tests

```bash
  php artisan test
```

  
