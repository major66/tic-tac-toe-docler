#Structure

This project is based on this Skeleton find in the slim documentation :
* https://github.com/slimphp/Slim-Skeleton

For a better understanding :
* app/
The app folder contain all the logic of this project (Routes, Controller, Services, Model...)

* documentation/
The Documentation folder contain all the documentation regarding this project.

* logs/
The purpose of this folder is to store the logs files

* public/
This folder contain all the assets use in this project.(js, css, img ...)
You can also find the **index.php** file in this folder.

* test/
This folder contain the test.

##app/

* Exceptions/
This folder contains all the Excpetions type using in this project

* Http/
This folder contain all the **controller**.
it's can also contain Middlewares or other thing related to Http.

* Model/
This folder contain the models use by this project
Because this application didn't need to have a database, the only model thant you can find for now is a DTO.

* Ressources/
The purpose of this folder is to contain all the assets using by this application and then with the help of a grub file, we can do some actions on this assets like minimize, remove unused code, rename file ...

* Services/
In this folder you can find the main logic of your application.
Usually the Controllers calls the services in this folder.

The explanation about the other folder will come soon.

If you have any question please let me know

    yohann.payrot@malinshopper.com