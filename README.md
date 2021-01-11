# JWT API
Don't want to mess about jwt tokens? Send your user data to the API and get a complete JWT in return.

This is my first project using Lumen and the point of it is to learn the framework.

## Installation
1. Download and upload to web server
3. Create a .env file og copy .env.example and set up the enviroment. You don't need a database.
4. !! Set APP_KEY in the .env-file
5. Run "composer install" in the terminal

## How to use
First you need a Bearer Token, you get that when you register

### REGISTER
Path: /register

Method: POST

Param: "secret" - the secret every JWT will be encoded with, "email" - your email. It's really not in use right now, but for the future we can pull the email and drop it in database if we want

Retur: 200; status=success, token=your-bearer-token

To encode data and create a JSON Web Token you'll run encode

### ENCODE
Path: /encode

Method: POST

Param: every datafield you want to store in the token, you send as a parameter.

Eks: user_id=123, user_name=JohnDoe

Retur: 200; status=success, token=your-JSON-Web-Token

Decoding? You get the point...

### DECODE
Path: /decode

Method: POST

Param: token=the-JSON-Web-Token

Retur:
409; status=failed, The JSON Web Token is not valid.

422; status=no access on this token. The Bearer Token is not the same used to create the JWT

200; status=success,data=your-data. The token is valid and you'll get your data in retur.


