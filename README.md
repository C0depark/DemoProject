# Demo Project

For this project, I created a small web application that will pull data periodically from an external API (using a cron job) and store it into a local database. On the front-end, I used the Vue.js framework to display the data by using an ajax request to an internal API. 

## Setup:

Run the migrations

```shell
php artisan migrate
```

Run the queue job a few times to populate the database
```shell
php artisan activity:run
```
Alternatively, you can run the cron scheduler to automatically populate the data every 30 seconds
```shell
php artisan schedule:work
```

## Database Configuration

Use of this application requires a database connection.
Update the connection details in the `.env` for your own local environment.

**Default connection**:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=
```

## Running the front end service
Install the assests and launch the dev service
```shell
npm install && npm run dev  
```

In a separate console, launch the local server
```shell
php artisan serve
```

Open your web browser and navigate to http://127.0.0.1:8000/

