# How to setup the project

1. Copy ````.env.example```` to a ```.env```
2. Create a database and fill in the credentials in your ````.env````
3. Install PHP & Javascript dependencies: ````npm i```` and ```composer i```
4. generate an application key: ````php artisan key:generate````
5. Link the storage with the public: ```php artisan storage:link```
5. Compile Javascript dependencies: ````npm run dev```` or if you want to watch changes in your files: ```npm run watch```
6. Run the PHP server: ````php artisan serve````

## This is a work in progress project, so if you find any bugs. Let me know!
