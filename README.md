# Laravel Hajusrakendus

**See on Laravelil baseeruv hajusrakendus, mis sisaldab mitmeid funktsionaalsusi nagu ilmateade, kaardirakendus, blogi koos kommentaaridega, e-pood ostukorviga ning kasutaja lemmikteemade haldus koos isetehtud API-ga.**

## Ülesehitus
Projektil on mitu iseseisvat moodulit:

- **Ilmateenus**: OpenWeather API kaudu saab otsida ja kuvada eri linnade ilmaandmeid koos visuaalsete ikoonidega.
- **Kaardirakendus**: Leafleti ja OpenStreetMapi abil saab kaardile lisada markereid, neid vaadata, muuta ja kustutada.
- **Blogi**: Kasutajad saavad luua blogipostitusi ja kommenteerida. Admin saab kommentaare kustutada.
- **E-pood**: Toodete kuvamine, ostukorv, koguse muutmine ja kassaprotsess.
- **Lemmikteema API**: Kasutaja saab lisada oma lemmikteema, mida kuvatakse nii veebilehel kui ka JSON API kaudu koos limiidiga. Andmeid cache’itakse.

## Kasutatud tehnoloogiad
- **Laravel 10**
- **PHP 8+**
- **Tailwind CSS** (Laravel Breeze UI)
- **SQLite / MySQL** (sõltuvalt seadistusest)
- **OpenWeather API**
- **Leaflet.js + OpenStreetMap**
- **Git + GitHub**

## Koodi käivitamise juhised

### Projekti kloonimine:
```bash
git clone git@github.com:KevinJasin/laravel-hajusrakendus.git
cd laravel-hajusrakendus
Sõltuvuste paigaldamine:
composer install
npm install && npm run dev
