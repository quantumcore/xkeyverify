# xkeyverify
Simple Key Verification system for client side applications.

**BUGS** : [View current bugs](https://github.com/quantumcored/xkeyverify/blob/master/BUGS.md)

## Setting up (Example)

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
![example-sql](https://github.com/quantumcored/xkeyverify/blob/master/images/sql.PNG)

Once that's done, You can go on to your server and login using default credentials ``admin:password``.

![login](https://github.com/quantumcored/xkeyverify/blob/master/images/login.PNG)

After you login, You should see this
![cp](https://github.com/quantumcored/xkeyverify/blob/master/images/cp.PNG)

So no keys are created by default, Lets say I have to create an application that I want to give to my friend and I want it to stop working whenever I want. So we can create a key for this.

Click the button **Create new Key** 
and enter your desired name and key and a date.
![newkey](https://github.com/quantumcored/xkeyverify/blob/master/images/keycreate.PNG)

In this case I am creating a key with the name of **mainkey**. Note, The name is important, you will see.

Once the key is created, It should look something like this.
![keydone](https://github.com/quantumcored/xkeyverify/blob/master/images/keydone.PNG)

As you can see, IT says **Activated : False**. The key is created but not activated. In order to use it, We activate it.
![keymanage](https://github.com/quantumcored/xkeyverify/blob/master/images/keymanage.PNG)

After it's activated it, The server side setup for your Verification system is done.
![done](https://github.com/quantumcored/xkeyverify/blob/master/images/keyactivate.PNG)

### Creating the Application

So after we've completed the steps above in the process of making an application stop whenever we want.
You can use [this](https://github.com/quantumcored/xkeyverify/blob/master/samples/main.c) sample code to understand what we need to do next.
```C
#include "xkeyverify.h"

#define ALL_OK "12345" // Use encryption if use in real application

int main() {
    char key[MAX_KEY]; memset(key, '\0', MAX_KEY);
    get("http://myserver.com/mainkey", key, MAX_KEY);
    if(strcmp(key, ALL_OK) == 0)
    {
        // printf("Key : %s\n", key);
	// Continue the application
    } else {
        MessageBoxA(NULL, "Your Trial has expired.", "Error", MB_ICONERROR);
    }
    return 0;
}
```
The code above gets the key from the server, If it's the expected KEY and DOES exit only then the program will run, Else, Stop.
