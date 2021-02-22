# Job-Portal-Web-Application

A Job Portal Web Application for fulfillment of requirements in subjects 'Web Development' and 'Database Administration'

## Project Details

**Authors and Designers**: 
* [Buenaventura, Vanessah](https://github.com/Bandroite "Bandroite")
* Honorio, Lance
* Jose, Marc Alexandrei
* Robillos, Elric
* [Torres, Jetsun Prince](https://github.com/PrensDev "PrensDev")

*BSIT 3-1, PUPQC*

**Date Started**: October 31, 2020

## Dependencies
* [bootstrap v4.5.3](https://getbootstrap.com/docs/4.5/getting-started/introduction/ "Bootstrap v4.5")
* [jQuery v3.5.1](https://jquery.com/ "jQuery v3.5.1")
* [jQuery-parallax.js v1.5.0](https://pixelcog.github.io/parallax.js/ "jQuery-parallax.js v1.5.0")
* [bootstrap-select v1.13.18](https://developer.snapappointments.com/bootstrap-select/ "bootstrap-select v1.13.18")
* [croppie v2.6.5](https://foliotek.github.io/Croppie/ "croppie v2.6.5")

## Back-end Framework
* [Codeigniter 3](https://codeigniter.com/userguide3/index.html "Codeigniter 3")

## Requirements
Please install the following to get started
* [NodeJS](nodejs.org "Click here to go to NodeJS download website.")
* [Microsoft SQL Server Management Studio 18](https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15 "Click here to go to Microsoft SQL Server Management Studio 18 download website")
* [XAMPP](https://www.apachefriends.org/download.html "Click here to go to XAMPP download website")
* PHP Driver for SQL Server

## Instructions
1. Download the zip file of this code or click [here](https://github.com/PrensDev/ABN-Job-Portal/archive/main.zip).
2. Extract the file to C:/xampp/htdocs/
3. Open a terminal and type the following
    1. > `cd C:/xampp/htdocs/ABN-Job-Portal`
    2. > `npm install`
4. Open the Microsoft SQL Server Management Studio and copy the server name
5. Open any editor you want. Locate this file in extracted folder
    > `ABN-Job-Portal/application/config/database.php`
6. In database.php, locate the `$db['default']` array and edit the `'dsn'` value to this format:
    > `'dsn' => 'sqlsrv:Server=[YOUR SERVER NAME];Database=ABN_Job_Portal;'`
7. In your Microsoft SQL Server Management Studio, open the file in `ABN-Job-Portal/queries/ABN_Job-Portal - Script.sql` and execute
8. Open your Xampp and start the Apache
9. Open any browser and type `localhost/ABN-Job-Portal` and you are now ready to use it.