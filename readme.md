# Manthabill

**Note:**
- Development is ongoing for Manthabill version 2 using Laravel 11: [Link](https://github.com/alexistdev/manthabill/tree/development)
- Development is ongoing for GeoBill version 1 using Angular and Spring Boot: [Link](https://github.com/alexistdev/geobill)

Manthabill is a free billing/invoice management software for hosting owners or those running a hosting business. Please do not remove the copyright link.
## DEMO
https://manthabill.my.id/

## Technologies Used
- **Framework:** CodeIgniter 3
- **Template:** [AdminLTE](https://adminlte.io/)
- **PHP Version:** PHP 5.6 ([Download here](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.3/))

## Installation on Hosting

1. Clone the repository:
   ```bash
   git clone https://github.com/alexistdev/manthabill.git
   ```
2. Upload the files and ensure the PHP version is set to 5.6.
3. Create a database and import the `manthabill.sql` file.
4. Edit the `config/database.php` file to configure your database username, database name, and password.
5. Configure SMTP settings for sending emails in `config/email.php`.
6. Set up a cron job in your cPanel similar to:
   ```bash
   wget -qO- http://manthabill.com/Cronjob > /dev/null 2>&1
   ```
7. Create file a .htaccess and place it in the public_html directory :
   ```bash
   RewriteEngine on
	RewriteCond $1 !^(index\.php|resources|robots\.txt)
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*)$ index.php/$1 [L,QSA]
   ```

## Installation on Localhost

1. Ensure your system has PHP 5.6 installed:
   ```bash
   php -v
   ```
2. Create the `manthabill` database and import `manthabill.sql`.
3. Configure database settings in `config/database.php` with your database details.
4. Edit `config/config.php` to update the URL:
   ```php
   $config['base_url'] = 'http://localhost/manthabill/';
   ```
5. Login Credentials:

   **Administrator**
   - URL: `http://localhost/manthabill/staff`
   - Username: `admin`
   - Password: `admin`

   **User**
   - URL: `http://localhost/manthabill/`
   - Register to create an account.

## Note
Ongoing development for Laravel 11 version is in progress. For assistance, contact me via email at [alexistdev@gmail.com](mailto:alexistdev@gmail.com) or open an issue on GitHub.

## Screenshots

#### Administrator Page:
![Administrator Page](https://github.com/alexistdev/manthabill/blob/master/Photo/gambar1.png?raw=true)

#### Client Page:
![Client Page](https://github.com/alexistdev/manthabill/blob/master/Photo/gambar2.png?raw=true)

#### Service Page:
![Service Page](https://github.com/alexistdev/manthabill/blob/master/Photo/gambar3.png?raw=true)

#### User Detail Page:
![User Detail Page](https://github.com/alexistdev/manthabill/blob/master/Photo/gambar4.png?raw=true)

#### Invoice Detail Page:
![Invoice Detail Page](https://github.com/alexistdev/manthabill/blob/master/Photo/gambar5.png?raw=true)
