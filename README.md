# Streamable
A web application that aggregates and tracks user's movies and tv shows in their subscribed streaming services

## Setup
   - **Windows**
     - Download and install XAMPP (We recommend in the C: drive)
     - Navigate to `C:\xampp\apache\conf\extra` or wherever your XAMPP files are located
     - Open `httpd-vhosts.conf` with a text editor
     - Uncomment `NameVirtualHosts *:80`
     - Add this code to the end of the code:
       ```
       <VirtualHost *:80>
               DocumentRoot "streamable repository file path"
               ServerName streamable.local
               <Directory "file path to streamable repository">
                       AllowOverride All
                       Require all granted
               </Directory>
       </VirtualHost>
       ```
     - Open `C:\Windows\System32\drivers\etc\hosts` with a text editor
     - Paste this to the end of the code (you may have to save as administrator):
       ```
       127.0.0.1   	localhost
       ::1         	localhost
       127.0.0.1   	streamable.local
       ```
     - Open `C:\xampp\xampp-control.exe`
     - Press start on Apache and MySQL
     - In a web browser, enter `localhost/phpmyadmin`
     - On the menu bar on the left, click "New"
     - Name database "streamable" and click "Create"
     - Click on "streamable" on the left and click on the "Import" tab
     - Click "Browse..." and add `data-dump.sql` and click on "Go"
     - Edit `dbinfo.php` as necessary so the application can connect to your database
     - Enter `streamable.local` in the web browser to access the Streamable application
   - **Mac**
     - Download and install MAMP
     - Download and install MySQL Workbench Community 8.0.21
     - Download and install MySQL Shell 8.0.23
     - Open your Mac's Preferences app and go to the MySQL section
     - Click "Start MySQL Server" and enter your password if it is requested
     - Open MySQL Workbench
     - Open MAMP
     - MAMP
       - Click "Preferences" and change your MySQL port to the one that's listed in your Mac's settings and then click "OK"
       - Click "Preferences" and change the document root to the project's directory (the folder with the extracted ZIP contents) and click "OK"
       - Hit "Start"
     - MySQL Workbench
       - Import the SQL database file from the extracted ZIP folder into MySQL Workbench by clicking "Server" in the menu bar and then selecting "Data import"
       - Choose "import from a self-contained file" and select the SQL file from the extracted ZIP folder (`data-dump.sql`)
     - Edit the `dbinfo.php` file in the extracted ZIP folder if necessary to update the database information to the correct database that you just set up/imported in MySQL Workbench and save the file after making changes. Depending on your setup, you may need to change things like the servername (i.e. change "localhost" to "127.0.0.1"), username (i.e. change "user" to "root"), password (to the password of your database), and dbname (to the name of your database).
       - The `dbinfo.php` will look something like this, which is the information that the submitted version of the project is set to:
         ```
         <?php
             $servername = "localhost";
             $username = "user";
             $password = "Streamable2021!";
             $dbname = "streamable";
             $conn = mysqli_connect($servername, $username, $password, $dbname);
         ?>
         ```
     - Open the project files in a browser (we recommend Chrome) by going to the `localhost:port` URL (where port is your respective Apache/Nginx port you have set in MAMP), and you can now access the Streamable application!

## How to Run Tests

1. Ensure your `dbinfo.php` file is set up correctly according to the steps above
2. Open up the `acceptance.suite.yml` file in the `tests` folder
   - Change the PhpBrowser url (local host) as necessary to whatever your local host is
     - This may look like `http://localhost:8888` or `http://streamable.local`
3. Open your terminal and change directories to the Streamable repository/project folder
4. Run the following command: `php vendor/bin/codecept run acceptance`
5. Tests should run automatically and display whether they PASS or FAIL in the terminal
   - Note that some of the tests change database values and don't revert them back to their original state, meaning that it may be necessary for you to refresh your database using the `data-dump.sql` file between executions of the command in step 4
6. Run code coverage with the following command: `php vendor/bin/codecept run acceptance --coverage --coverage-html`
   - See codeception code coverage documentation: https://codeception.com/docs/11-Codecoverage
     - Note that you must have the drivers listed in the documentation installed in order for it to run correctly
     - You must also add `<?php require_once __DIR__.'/c3.php';?>` to the top of each file with the correct path to the `c3.php` file (which is in the project's root directory) in order to get it to work