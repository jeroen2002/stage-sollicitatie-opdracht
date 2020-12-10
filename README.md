# Hoe je het project moet opzetten

1. Kopieer ````.env.example```` naar een nieuw bestand genaamd ```.env```
2. Maak een database aan en vul je gegevens in de ````.env````
3. Installeer de PHP en Javascript packages: ````npm i```` and ```composer i```
4. Genereer een nieuwe applicatiesleutel: ````php artisan key:generate````
5. Link de storage map: ````php artisan storage:link````
5. Draai de migraties: ````php artisan migrate```
6. Compileer de Javascript: ````npm run dev```` or if you want to watch changes in your files: ```npm run watch```
7. Draai de Laravel server: ````php artisan serve````

## Dit project is gemaakt met: Laravel, Vue en Vuex als state-manager