Crash Test Ratings
==================

This is an implementation of an API in PHP that calls a "backend API"
to get information about crash test ratings for vehicles.

The underlying API that is to be used here is the [NHTSA NCAP 5 Star Safety Ratings API](https://one.nhtsa.gov/webapi/Default.aspx?SafetyRatings/API/5).  This requires no sign up or authentication.

This project has been built using TDD and DDD. It also follows the PSR-2 coding standard.

Installation:

Option A (easiest), with Docker:

1) cd into the project
2) Build the image running: docker build -t crash-test-ratings .
3) Run the container in your favorite port (8080 by default) docker run -d -p 8080:80 crash-test-ratings
4) Start using the API!, example: http://localhost:8080/web/app.php/vehicles/2015/Toyota/Yaris

Option B, without Docker:
1) Copy the project folder into your local server
2) cd into the project
3) Run composer install
4) Give permissions to var/cache, var/logs, var/sessions
5) Make sure you are running PHP7.2 or higher
6) Make sure you have Curl installed

Note: To run unit and functional tests:
1) cd into code folder
2) ./vendor/bin/simple-phpunit
