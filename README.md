# REST API

This is Laravel REST API for managing blog posts using laravel sanctum authentication.

# Api endpoints

-   GET /api/posts - Fetch all blog posts
-   GET /api/posts/{id} - Fetch a blog post by id
-   PUT|PATCH /api/posts/{id} - Update a blog post
-   POST /api/posts - Create a new blog post
-   DELETE /api/posts/{id} - Delete a blog post

Authentication endpoints

-   POST /api/login
-   POST /api/register

# Setup

1. Download / clone project. Navigate to project folder.</br>
2. Install composer dependencies using following command:</br>
 <pre>composer install</pre>
3. Create .env file (copy from .env.example).</br>
4. Run php artisan key:generate.</br>
5. Create empty DB and set up .env file with database information.</br>
6. Run migrations</br>
 <pre>php artisan migrate</pre>
7. Seed database to insert 5 users and 3 blog post for each user (for testing if needed)</br>
 <pre>php artisan db:seed</pre>

To test API endpoints you can use Postman.

# Usage

To register make POST request to /api/register route</br>
with provided name, email, password. All keys are required.</br>

To login, make POST request to /api/login route</br>
with valid email and password. Response will return</br>
authorization token for other requests.</Br>

# Authorization

When testing API that requires a user to be authenticated, you need to specify two headers.</br> You must specify access token as a Bearer token in the Authorization header.</br>
You must specify Content-type header as application/json.

# Making requests

To create a blog posts we need to make POST request to route</br>
`/api/posts`</br>
with title and body. Minimum length of a title is 5 characters and for body 3 characters.</br>

For fetching all blog posts we need to make GET request to route</br>
`/api/posts`</br>

For fetching single blog post we need to make GET request to route</br>
`/api/posts/{id}` </br>with valid post ID (/api/posts/6).</br>

For updating a blog post we need to make PUT|PATCH request to route</br>
`/api/posts/{id}` </br>with title and body.</br>

For deletind a blog posts we need to make DELETE request to route</br>
`/api/posts/{id}` </br>with valid post ID (/api/posts/1).</br>
