# laravel version 5.2

## Data model
There were created 3 tables. Film with some basic attributes which has a relation of onetomany with the comment table. And it was created a genre table to holds the diferent genres of a film(pre-defined and limited set of records). It could be designed in a manyTomany relation with film but it was designed as an attribute of the film table that will store and array of film genres. The photo of the film are saved in the public folder images and in the database it is just stored its name with the extension.

## Security
The security is handle by laravel builtin security model.
The routes are protected by the auth middleware provided by the framework to protect the access to required resources.

### Validation 
Validation is made client and server side. Client side validation was achieved using html and basic javascript. Server side validation was handled by validating the request inputs basically just required attribute. More extensive validations can be done depending if they are needed.

## Views
The views were build using blade template engine, html and bootstrap3(it could be changed toversion 4)
