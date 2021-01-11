<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <title>{{ env('APP_NAME') }}</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-21655367-5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'UA-21655367-5');
    </script>
</head>
<body>
    <div class="container-md p-5">
        <section>
            <h1>JWT API</h1>
            <p>A free API for encoding, decoding and verifying JSON Web Tokens created by Anders Iglebekk. If you want to support this api, please to that at <a href="https://www.paypal.com/pools/c/8vY5J3RnjS?_ga=2.257101515.1925594631.1610399068-1447759950.1610399068" target="_blank">PayPal</a></p>
        </section>
        <section>
            <div class="card m-5">
                <div class="card-header">
                    JSON Web Token
                </div>
                <div class="card-body">
                    <p class="card-text">
                        
                        JSON Web Token (JWT, sometimes pronounced /dʒɒt/, the same as the English word "jot”) is an Internet standard for creating data with optional signature and/or optional encryption whose payload holds JSON that asserts some number of claims. The tokens are signed either using a private secret or a public/private key. For example, a server could generate a token that has the claim "logged in as admin" and provide that to a client. The client could then use that token to prove that it is logged in as admin. The tokens can be signed by one party's private key (usually the server's) so that party can subsequently verify the token is legitimate. If the other party, by some suitable and trustworthy means, is in possession of the corresponding public key, they too are able to verify the token's legitimacy. The tokens are designed to be compact, URL-safe, and usable especially in a web-browser single-sign-on (SSO) context. JWT claims can typically be used to pass identity of authenticated users between an identity provider and a service provider, or any other type of claims as required by business processes.
                    </p>
                    <p class="card-text">
                        JWT relies on other JSON-based standards: JSON Web Signature and JSON Web Encryption.
                    </p>
                    <p class="card-subtitle">
                        <a class="card-link" href="https://en.wikipedia.org/wiki/JSON_Web_Token" target="_blank">From Wikipedia, the free encyclopedia</a>
                    </p>
                </p>
            </div>
        </div>
    </section>
    <section>
        <h2>Documentation</h2>
        <p>
            <strong>Base URI:</strong> https://jwt.tolvtemann.no/api
        </p>
        <h3>
            Autorization
        </h3>
        <p>
            Bearer Token
        </p>
        <h3>Registration</h3>
        <p>
            <span class="badge bg-secondary">Path</span> /register<br />
            <span class="badge bg-secondary">Auth</span> None<br />
                <span class="badge bg-secondary">Method</span> POST
            <h5>
                Parameter(s)
            </h5>
            <p>
                <span class="badge bg-primary">secret</span> The secret every JSON Web Token will be encoded with. Min 32char. Required<br />
                    <span class="badge bg-primary">email</span> Your email. Required<br />
            </p>
            <h5>
                Return
            </h5>
            <p>
                <span class="badge bg-success">200</span> status=success, token=your-bearer-token. The token you need to do other requests.
            </p>
        </p>
        <h3>Encode</h3>
        <p>
            <span class="badge bg-secondary">Path</span> /encode<br />
            <span class="badge bg-secondary">Auth</span> Bearer Token<br />
            <span class="badge bg-secondary">Method</span> POST
        </p>
        <h5>
            Parameter(s)
        </h5>
        <p>
            Make one parameter per data you want to store in the token.<br />
            Eks: user_id=123, user_name=JohnDoe
        </p>
        <h5>
            Return
        </h5>
        <p>
            <span class="badge bg-success">200</span> status=success, token=your-token. JSON Web Token with the data you sent.
        </p>
        <h3>Decode</h3>
        <p>
            <span class="badge bg-secondary">Path</span> /decode<br />
            <span class="badge bg-secondary">Auth</span> Bearer Token<br />
            <span class="badge bg-secondary">Method</span> POST
        </p>
        <h5>
            Parameter(s)
        </h5>
        <p>
            <span class="badge bg-primary">token</span> The JSON Web Token you want to validate and decode<br />
        </p>bg-success
        <h5>
            Return
        </h5>
        <p>
            <span class="badge bg-danger">409</span> status=failed. The token failed the validation.<br />
            <span class="badge bg-danger">422</span> status=no access to this token. The Bearer Token is not valid.<br />
            <span class="badge bg-success">200</span> status=success, data=your-data. The token is valid and the data is returned to you.

        </p>
    </section>
    
    
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>