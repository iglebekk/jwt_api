# JWT API
Don't want to mess about jwt tokens? Send your user data to the API and get a complete JWT in return.

# Autorization
You need an access token to be able to use the api. Register to get the access token.

# Register
Method: POST
Auth: None
URI: /api/register
PARAMS:
@secret This is the string the api will use to protect your tokens. Required.
@email Your email. Required.

Retur: Access token to be used as a bearer token later

!! If you loose your access token, all Json Web Tokens created with that access token will not be able to be decoded. !!

# Encode
Method: POST
Auth: Bearer token
URI: /api/encode
PARAMS:
... what ever you want to store in the token

Retur: A Json Web Token with the data stored.

# Decode
Method: POST
Auth: Bearer token
URI: /api/decode
PARAMS:
@token The Json Web Token you want to decode.

Return
status:failed - the token is not correct and it may be altered.
status:no access to this token - the token was created with a different user/bearer token
status:success & data[] - everything went fine and the encoded data is decoded.
