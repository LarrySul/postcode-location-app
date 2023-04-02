## Postcode-location-app 😎😎


This CLI program is built on the LARAVEL FRAMEWORK. The program process a zip file from a <a href="https://parlvid.mysociety.org/os/ONSPD/2022-11.zip"> (http://parlvid.mysociety.org/os/)</a>, and unzip the file and pull the contents/ folder into the `Storage > app > public > postcode` directory. The Postcode directory contains 3 sub folders, and the application will seek to read the data in the `Data > ONSPD_NOV_2022_UK.csv`. The data is about 1.44GB in size with about 2.6 million rows.

![Screenshot of database records](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/database.png)


## Repo Overview 🥳🥳

The repository contains source code on how to process the  ONSPD_NOV_2022_UK.csv using Queues, ensure alot of server resources isn't used up while creating the records in the database. It also contains 2 endpoints to List and filter Postcode, and Get Nearby Postcodes.

Specifications in the clone include

<li> The program unzip file from a remote location and create in storage directory. </li> </br>

<li> Single CLI command to automate the read and write process and create record in the database </li>

<li> Contains 2 (Two) endpoints that list and filter postcodes and returns the nearest postcode using the longitude and latitude </li>

![Endpoint to list all postcodes](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/list.png)

![Endpoint to return nearby postcodes](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/nearby.png)

<li> Writing of errors to logfile </li>

<li> <a href="https://documenter.getpostman.com/view/24345482/2s93RWMqEM"> Published Postman Collection </a> with sample body and example responses </li>

![Published Postman collection](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/published.png)

## Requirements 🔧🔧

<li> Download <a href="https://www.php.net/downloads.php"> PHP V7 </a> and above. </li>

<li> Install <a href="https://getcomposer.org/download/"> Composer </a> </li>

## Steps to run locally 🧑‍💻👩‍💻

<li> Clone this repository: </li>

<pre> git clone https://github.com/LarrySul/postcode-location-app/ </pre>

<li> Install dependencies: </li>

<pre> composer install and setup your path by following .env.example provided </pre>

<li> Open the CLI in preferred editor and run the command: </li>

<pre> php artisan import-and-create:postcodes </pre>

Once the command is done you'll get a success message in the CLI 😜 </br>

![Screenshot of read write operation via the CLI](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/terminal.png)



## Coding Style 🚀🚀


<li> How is your code structured: The code is well structure to use a creational design pattern, inheritance, DRY Principle, typehint of parameter and return type to functional declarations and lot more. </li>

<li> Are tests available and how have they been set up : Yes, the project has a total of 4 test cases (2 Unit and 2 Feature). </li> </br>

![Screenshot of test cases](https://github.com/LarrySul/postcode-location-app/blob/develop/public/screenshots/test.png)


