# Notice
    Use Cupcake as backend, and front2 as Frontend.
    The two other folders are deprecated.

# Run Backend
    composer install
    composer update
    symfony server:start

# Run Frontend
    npm install
    npm update
    ng update
    ng serve

# Database backup file
    https://www.mediafire.com/file/5jvlob9squvrfw7/cupcake_migrated_backup.sql/file

# Authentication
    1- /login on the frontend sends a request to /login_check on the backend
    2- token is storek in 'jwt' in the LocalStorage
    3- Use the token on each request (To Be Updated using an httpinterceptor)