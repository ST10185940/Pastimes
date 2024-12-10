# PastTimes - Second-Hand Clothing Store

## Overview

Past Times is a second-hand clothing store developed as a project for a web development course (WEDE6021). The project is built using Bootstrap (HTML+CSS), PHP, and MySQL.

```version: 1.0.0``` , by ST10185940_WEDE6021_Group10

## Requirements

- [WampServer](https://www.wampserver.com/en/) (with MySQL and phpMyAdmin  and other dependencies included)


## Issues & Functionalities not perfected:

- cart items not displaying even though html , php and sql syntax is correct with sql query returning valid data in PHPMyAdmin
- add to cart not adding items in tables correctly, while data is parsed correctly , evident in logging to the console.

## Building The WebStore

1. **Install WampServer:**
   - Download and install WampServer from the [official website](https://www.wampserver.com/en/).
   - During installation, make sure to include the latest version of MySQL.
   - Select phpMyAdmin as one of the components to be installed.

2. **Move Project to www Directory:**
   - After downloading the project zip file, unzip it.
   - Move the project folder to the `www` directory in the WampServer installation directory (e.g., `C:\wamp64\www\pastTimes`).

3. **Start WampServer:**
   - Launch WampServer and ensure it is running. Check the status from the system tray icon.

4. **Access phpMyAdmin:**
   - Left-click the WampServer icon in the system tray.
   - Navigate to the "phpMyAdmin" option and click to access the phpMyAdmin login page. [credentials are "root" , leave password blank select MySQL as DB]

5. **Database Setup:**
   - Log in to phpMyAdmin with the default credentials (usually, username: `root` and no password).
   - To Create a new database called `clothingStore`Click on the SQL tab and execute the SQL commands from the file `myClothingStore.sql` that will create the database schema and load sample data into each table.

6. **Import More Sample Data via txt files(Optional):**
   - In phpMyAdmin, click on the `clothingstore` database.
   - Click on the table you want to import data into.
   - Go to the Import tab.
   - Upload the corresponding /txt file from the  project file's `_sampleData` directory.
   - Ensure "Columns escaped with" is blank.
   - Set "Columns separated with" to a comma `,`.
   - Fill in the respective names of the columns under "Column names."

7. **Run the Project:**
   - Open your web browser and navigate to `http://localhost/pastTimes/`.
   - Alternatively, left-click on the WampServer icon in the system tray.
   - Select the "localhost" option to be taken to the WampServer homepage.
   - Under "Your Projects," find and select your project.

## Troubleshooting

- Check WampServer logs and error messages for any issues.
- Make sure the project folder is located in the `www` directory.
- Ensure the correct database connection details in the project's configuration file (DBConn.php).

## Admin User Name & Admin Password:
!NOTE:!
   Index page provide option to skip to admin dashboard from nav bar to test admin functions.
   while register and login system can be tested using Buyer/Seller credentials specified below

### Admin Portal Navigation

The admin portal can only be accessed through the index page's nav bar containing a "dashboard" link.
alternativley the admin portal can be accessed via the login page using the Admin form entering ```admin1@example.com``` or any existing admin username from the Database

Here are the main sections:

#### Manage Users
 - search bar to search for users using user id shown in user tabel below it 
 - View registered users and pending users 
 - edit users' details using provided form for changes and user id 
 - verify user account via user id in dedicated form 


#### Item Management
- View pendinga and listed products
- Update individual or batrch product availability status by listing it using its product id
- Delete products by enteringtheir id and selecting the delete button. 

``` Buyer/Seller User Name: test ```
``` Buyer/Seller Password: test ```

