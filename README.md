Laravel Hajusrakendus
See on Laravelil baseeruv hajusrakendus, mis sisaldab mitmeid funktsionaalsusi nagu ilmateade, kaardirakendus, blogi koos kommentaaridega, e-pood ostukorviga ning kasutaja lemmikteemade haldus koos isetehtud API-ga.

Ülesehitus
Projektil on mitu iseseisvat moodulit:

Ilmateenus: OpenWeather API kaudu saab otsida ja kuvada eri linnade ilmaandmeid koos visuaalsete ikoonidega.

Kaardirakendus: Leafleti ja OpenStreetMapi abil saab kaardile lisada markereid, neid vaadata, muuta ja kustutada.

Blogi: Kasutajad saavad luua blogipostitusi ja kommenteerida. Admin saab kommentaare kustutada.

E-pood: Toodete kuvamine, ostukorv, koguse muutmine ja kassaprotsess.

Lemmikteema API: Kasutaja saab lisada oma lemmikteema, mida kuvatakse nii veebilehel kui ka JSON API kaudu koos limiidiga. Andmeid cache’itakse.

Kasutatud tehnoloogiad
Laravel 10

PHP 8+

Tailwind CSS (Laravel Breeze UI)

SQLite / MySQL (sõltuvalt seadistusest)

OpenWeather API

Leaflet.js + OpenStreetMap

Git + GitHub

Koodi käivitamise juhised
Projekti kloonimine:
bash
Copy
git clone git@github.com:KevinJasin/laravel-hajusrakendus.git
cd laravel-hajusrakendus
Sõltuvuste paigaldamine:
bash
Copy
composer install
npm install && npm run dev
Keskkonnamuutujad:
bash
Copy
cp .env.example .env
php artisan key:generate
Andmebaasi seadistamine:
Veendu, et .env failis on õige DB seadistus.

bash
Copy
php artisan migrate --seed
Serveri käivitamine:
bash
Copy
php artisan serve
Ligipääs rakendusele:
Ava brauseris: http://localhost:8000

Kasutajakontod (testimiseks)
Admin:

Email: admin@example.com

Parool: password

Kasutaja:

Email: test@example.com

Parool: password

Lisainfo
Markerite lisamine toimub kaardil klõpsates.

Ilmateate leht võimaldab otsida linna nime järgi.

Blogi postitustele saab lisada kommentaare.

E-poes on vähemalt 9 toodet.

Lemmikteemade API asub: /api/subjects?limit=3

Live Project Link
