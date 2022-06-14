


<!-- PROJECT LOGO -->
<br />
<div align="center">

<h3 align="center">Employees-Manager </h3>

  <p align="center">
    Fully functioning PHP web app that Supports CRUD operations on employees.
    <br />
    <br />
    <br />
    <a href="https://my-employees-manager.000webhostapp.com/index.php">View Demo</a>
    ·
    <a href="https://github.com/youssef-imlyhen/Employees-Manager/issues">Report Bug</a>
    ·
    <a href="https://github.com/youssef-imlyhen/Employees-Manager/">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
    </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

[![Product Name Screen Shot][product-screenshot]](https://my-employees-manager.000webhostapp.com/index.php)


 Fully functioning web app that Supports:
 - Registration.
- Authentication.
 - CRUD operations on employees.
 - Search for an employee.
- Password reset.
- Validation and sanitization of all inputs before inserting to the database...

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With
- MySQL
- PHP 7 
- Bootsrap 5
<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

1. First of all make sure your have PHP 7+, MySQL  installed and running
2. clone the repo using `git clone https://github.com/youssef-imlyhen/Employees-Manager.git`
3. Run these SQL commands or you can create the database and the tables manually using PhpMyAdmin.
```sql
/* create the database */
CREATE DATABASE cruddb;
/* create users tables */
CREATE TABLE `users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `created_at` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/* create employeesList table */
CREATE TABLE `employeesList` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `phone` VARCHAR(15) NOT NULL , `job` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
4. Open [config.php](https://github.com/youssef-imlyhen/Employees-Manager/blob/main/config.php) and change `DB_SERVER` , `DB_USERNAME`,  `DB_PASSWORD`, `DB_NAME` with the details of your database.
5. Have fun.

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

* This project started after I learned PHP basics, and I wanted to do something more advanced to challenge myself. I took a static front-end app that I built as part of a great bootstrap 5 Udemy course. And started building on that by implementing new features like searching, input validation, CRUD operations using AJAX on the front end, and all of the back-end functionalities.

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact


Project Link: [https://github.com/youssef-imlyhen/Employees-Manager ](https://github.com/youssef-imlyhen/Employees-Manager )
Linkedin: [https://linkedin.com/in/youssef-imlyhen](https://linkedin.com/in/youssef-imlyhen) 


<p align="right">(<a href="#top">back to top</a>)</p>



[product-screenshot]: employee-manager.png


