![Automation & Robotics Club @ BPHC](http://www.automationandroboticsclub.com/gallery_gen/140f562717e57af5d4fe0e2685b8cfc5_148x139.png "Automation & Robotics Club @ BPHC")

# ARC-website
A dynamic website and blog for the automation and robotics club at bits pilani hyderabad campus.

## Database
### users

`id`|name|email|password|isadmin|picture|github|bio
---|---|---|---|---|---|---|---
+ This table consists of all the registered users and their relevent information.
+ The Is Admin field determines whether  a particular user has access to the admin functions.
+ Here ID is a primary key and auto-increamented.

### posts
`id`|title|author|images|video|content|uploadtime|status
---|---|---|---|---|---|---|---
+ This table is used to manaage all the posts.
+ The status will be 0 by default and 1 when the admin publishes it.
+ Here ID is a primary key and auto-incremented.

### unverified_users
`id`|name|email|password|activationCode|isadmin
---|---|---|---|---|---
+ This table consists of all the unverified users and their relevent information.
+ The Is Admin field determines whether  a particular user has access to the admin functions.
+ The user entries will be moved to the users table once the users verify their email id by clicking on the link mailed to them.
+ Here ID is a primary key and auto-increamented.
