Reddin Task Project
========================

The purpose of this project is to show case the Symfony technical stack.

Specifically the application has the following capabilities:

1.	User Login
- User should log in using their email
- Once logged in a user should land on a page with the URL /home/welcome
- The page should host provided logo image and a link to edit profile page
- Logins are to be stored in a database
2.	A page where user can edit their profile (link to from step 1)
- Change First and Last names
- Change password
- Link back to /home/welcome
3.	Command to import user CSV file into the database
- This command should create user accounts
- Passwords can be set to user’s first name (for ease of evaluation)
- If the command is re-run it should update duplicate user accounts with new information, but passwords should remain untouched


Installation
--------------


Database Setup
--------------


Runnning Server
--------------
```
php bin/console server:run
```

Running Tests
--------------