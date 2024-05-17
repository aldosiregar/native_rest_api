this is my fun project on how to make an rest api with native php

it's my project on make a CRUD api and connect it to database (modify the connection in config.php)

the table name is users with 4 column : user_id which is Auto-Increment, username for username with varchar data, user_email for email with varchar data, and check status with int data 

how to use : 

read all user = http://localhost/web/rest_api/index.php/user/read

create a user = http://localhost/web/rest_api/index.php/user/create?username=(insert name)&email=(insert email)&status(insert status, default=0)

delete a user = http://localhost/web/rest_api/index.php/user/delete?id=(insert id)

modify a user = http://localhost/web/rest_api/index.php/user/update?id=(insert id)&username=(insert name)&email=(insert email)&status(insert status, default=0)
