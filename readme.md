# ABN Job Portal

<div align="center">
   <img style="min-width: 50%" src="public\img\brand\brand-01.png" />
   <div style="text-align: center">ABN Job Portal is a Job Portal Web Application for fulfillment of requirements in subjects 'Web Development' and 'Database Administration'</div>
</div>

<br>

## Project Details

**Authors and Designers**:

- [Buenaventura, Vanessah](https://github.com/Bandroite "Bandroite") (Web Designer. Research)
- Honorio, Lance (Reseach)
- [Robillos, Elric](https://github.com/ElricRobillos "ElricRobillos") (Logo Design, Research)
- [Torres, Jetsun Prince](https://github.com/PrensDev "PrensDev") (Developer, Project Leader)

_BSIT 3-1, PUPQC_

**Date Started**: October 31, 2020

<br>

## Dependencies

- [bootstrap v4.5.3](https://getbootstrap.com/docs/4.5/getting-started/introduction/ "Bootstrap v4.5")
- [jQuery v3.5.1](https://jquery.com/ "jQuery v3.5.1")
- [jQuery-parallax.js v1.5.0](https://pixelcog.github.io/parallax.js/ "jQuery-parallax.js v1.5.0")
- [bootstrap-select v1.13.18](https://developer.snapappointments.com/bootstrap-select/ "bootstrap-select v1.13.18")
- [croppie v2.6.5](https://foliotek.github.io/Croppie/ "croppie v2.6.5")

<br>

## Web Framework

- [Codeigniter 3](https://codeigniter.com/userguide3/index.html "Codeigniter 3")

<br>

## Requirements

Please install the following to get started

- [NodeJS](nodejs.org "Click here to go to NodeJS download website.")
- [Microsoft SQL Server Management Studio 18 (SSMS 18)](https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15 "Click here to go to Microsoft SQL Server Management Studio 18 download website")
- [XAMPP](https://www.apachefriends.org/download.html "Click here to go to XAMPP download website")
- PHP Driver for SQL Server

To guide you in installing PHP Driver, you may watch this video on YouTube by clicking this [link](https://www.youtube.com/watch?v=4qXXD4C2KSo "connect xampp to sql server 2020 | how to connect xampp to sql server").

<br>

## Instructions

1. Download the zip file of this code or click [here](https://github.com/PrensDev/ABN-Job-Portal/archive/main.zip).
2. Extract the file to `C:/xampp/htdocs/` and make sure that the folder name would be renamed as `ABN-Job-Portal`.
3. Open a terminal and enter the following:

   1. `cd C:/xampp/htdocs/ABN-Job-Portal`
   2. `npm install`

   Make sure you have NodeJS installed on your computer before to do this. This project is dependent to some node packages. To check, enter to the terminal `node -v` or `node --version`. If node version is not display, then you need to install NodeJS.

   Old version of `npm` is used here. So you can run `npm audit fix` to fix some high severity vulnerabilities

4. Open the Microsoft SQL Server Management Studio and copy the server name
5. Open any editor you want. Locate this file in extracted folder
   > `ABN-Job-Portal/application/config/database.php`
6. In database.php, locate the `$db['default']` array and edit the `'dsn'` value to this format:
   > `'dsn' => 'sqlsrv:Server=[YOUR SERVER NAME];Database=ABN_Job_Portal;'`
7. In your Microsoft SQL Server Management Studio, open the file in `ABN-Job-Portal/queries/ABN_Job-Portal - Schema.sql` and execute. Optional: Execute also the file in `ABN-Job-Portal/queries/ABN_Job-Portal - Sample Data.sql` so database have sample data.
8. Open your XAMPP and start the Apache
9. Open any browser and type `localhost/ABN-Job-Portal` and you are now ready to use it.

<br>

## Screenshots

Note: Some images are not owned by us.

<table>
   <tr>
      <td>
         <img src="screenshots/Home Page - Hero.png">
         <div style="text-align: center">Home Page - Hero</div>
      </td>
      <td>
         <img src="screenshots/Home Page - Create Account.png">
         <div style="text-align: center">Home Page - Create Account</div>
      </td>
   <tr>
   <tr>
      <td>
         <img src="screenshots/Home Page - Create Account.png">
         <div style="text-align: center">Home Page - Create Account</div>
      </td>
      <td>   
         <img src="screenshots/Home Page - Recent Available Jobs.png">
         <div style="text-align: center">Home Page - Recent Available Jobs</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Home Page - Hero and Footer.png">
         <div style="text-align: center">Home Page - Hero and Footer</div>
      </td>
      <td>   
         <img src="screenshots/Login Page.png">
         <div style="text-align: center">Login Page</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Register - Job Seeker.png">
         <div style="text-align: center">Register Page - Job Seeker (With Form Validation)</div>
      </td>
      <td> 
         <img src="screenshots/Register - Employer.png">
         <div style="text-align: center">Register Page - Employer</div>
      </td>
   </tr>
   <tr>
      <td> 
         <img src="screenshots/Jobseeker Page - Profile.png">
         <div style="text-align: center">Jobseeker Page - Profile (including dropdown options)</div>
      </td>
      <td> 
         <img src="screenshots/Jobseeker Page - Edit Profile Picture.png">
         <div style="text-align: center">Jobseeker Page - Edit Profile Picture</div>
      </td>
   </tr>
   <tr>
      <td> 
         <img src="screenshots/Jobseeker Page - Applications.png">
         <div style="text-align: center">Jobseeker Page - Applications</div>
      </td>
      <td> 
         <img src="screenshots/Jobseeker Page - Bookmarks.png">
         <div style="text-align: center">Jobseeker Page - Bookmarks</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Jobseeker Page - Notifications.png">
         <div>Jobseeker Page - Notifications</div>
      </td>
      <td> 
         <img src="screenshots/Job Details.png">
         <div style="text-align: center">Job Details</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Job Application.png">
         <div>Job Application</div>
      </td>
      <td> 
         <img src="screenshots/Search Page.png">
         <div style="text-align: center">Search Page</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Company Page - Details.png">
         <div>Company Page - Details</div>
      </td>
      <td> 
         <img src="screenshots/Employer Page - Profile.png">
         <div style="text-align: center">Employer Page - Profile</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Employer Page - Post New Job.png">
         <div>Employer Page - Post New Job</div>
      </td>
      <td> 
         <img src="screenshots/Employer Page - Job Post.png">
         <div style="text-align: center">Employer Page - Job Post</div>
      </td>
   </tr>
   <tr>
      <td>
         <img src="screenshots/Employer Page - Applicants.png">
         <div>Employer Page - Applicants</div>
      </td>
      <td> 
         <img src="screenshots/Employer Page - Edit Info.png">
         <div style="text-align: center">Employer Page - Edit Information</div>
      </td>
   </tr>
</table>
