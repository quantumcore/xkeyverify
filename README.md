# xkeyverify
Simple Key Verification system for client side applications.


## Setting up

Firsly move everything under ``panel/`` to your web server, And go to phpmyadmin.
Create a database named xkeyverify (utf8_general_ci), and execute the following sql.
```sql
CREATE TABLE IF NOT EXISTS `account` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `account` (`id`, `username`, `password`) VALUES (1, 'admin', '$2y$10$uhL2hyDAKH3/u3lST0Pr/uuClRA/k8DSU6T5.b/FGx.upp0MoDZ5u');
```

Once that's done, You can go on to your server and login using default credentials ``admin:password``.

