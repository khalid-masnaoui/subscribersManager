Welcome to ReadMe! :owlbert:

Simple PHP application for managing the subscribers of a MailerLite account via the MailerLite API.
📝 Notes

This application has all the functionalities asked on the test given:
Validating and saving an API key
Showing the subscribers of an account
Creating subscribers --> Modal Form (all within the same page , no refresh)
Deleting a subscriber all within the same page , no refresh)
Editing a subscriber --> Modal Form (all within the same page , no refresh)
Additional feature --> the user can change his account (provide new API key)

I just wanna highlight one thing : the where parameter in the MailerLite's API SDK is not working (does not filter data) -> so in this application, the filtering/searching feature in the dataTable is not working , however, I added the logic for it , so if the where parameter backs to work , then our application will also have the filtering feature working.
** I already sent you an email about this concern
🚦 Instructions to Run the application

Instructions on how to run a project on local environment running PHP 7.4, MySQL 5.x and the latest Chrome browser
Required PHP extensions : php7.4-xml (for the php-dom extension) , php7.4-mbstring , pdo-mysql (php7.4-mysql ) ,composer
1 : Clone this repository or downoald it as ZIP
2 : Run composer install (to install all dependecies)
3 : Import the .sql file into you local mysql database and your database credentials on .env file
4 Run php -S localhost:8000 and visit http://localhost:8000 