Welcome to ReadMe! :owlbert:

Simple PHP application for managing the subscribers of a MailerLite account via the MailerLite API.

# 📝 Notes

This application has all the functionalities asked on the test given: <br /> 
**Validating and saving an API key** <br /> 
**Showing the subscribers of an account**  <br /> 
**Creating subscribers** --> Modal Form (all within the same page , no refresh) <br /> 
**Deleting a subscriber** all within the same page , no refresh) <br /> 
**Editing a subscriber** --> Modal Form (all within the same page , no refresh) <br /> 
**Additional feature** --> the user can change his account (provide new API key)  <br /> 

I just wanna **highlight** one thing :  the where parameter in the MailerLite's API SDK is not working (does not filter data) -> so in this application, the filtering/searching feature in the dataTable is not working , however, I added the logic for it , so if the where parameter backs to work , then our application will also have the filtering feature working. <br /> 
** I already sent you an email about this concern  <br /> 


# 🚦 Instructions to Run the application 
Instructions on how to run a project on local environment running PHP 7.4, MySQL 5.x and the latest Chrome browser <br /> 
**Required PHP extensions :** php7.4-xml (for the php-dom extension) , php7.4-mbstring ,composer <br /> 
**1 :** Clone this repository or downoald it as ZIP <br /> 
**2** : Run composer install (to install all dependecies) <br /> 
**3** : Import the .sql file into you local mysql database and your database credentials on .env file <br /> 
**4** Run php -S localhost:8000 and visit http://localhost:8000  <br /> 
