# ARC-website
A dynamic website and blog for the automation and robotics club at bits pilani hyderabad campus.

![Automation & Robotics Club @ BPHC](http://www.automationandroboticsclub.com/gallery_gen/140f562717e57af5d4fe0e2685b8cfc5_148x139.png "Automation & Robotics Club @ BPHC")



## Database
### Users

`ID`|Name|Email ID|Phone call|Phone whatsapp|Room no.|Salt|Hashed Password|Fingerprint ID|Is Admin
---|---|---|---|---|---|---|---|---|---
+ This table consists of all the registered users and their relevent information.
+ The Is Admin field determines whether  a particular user has access to the admin functions.
+ Here ID is a primary key.

### Transactions
`ID`|Name|Item ID|Quantity|Issue Datetime|Withdraw Datetime|Return Datetime
---|---|---|---|---|---|---
+ This table is used to manaage all the withdran items from the inventory.
+ A particular entry will be moved to the History table after the item is returned.
+ Here ID is a foreign key.

