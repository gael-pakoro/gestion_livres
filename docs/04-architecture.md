VIII. Mission 8 : Choisir l’architecture technique
# Architecture technique

## Frontend
Technologie : Html + css (+ peut être du Javascript)
Pourquoi ce choix : HTML + CSS car  j'ai déjà les bases de son utilisation.

## Backend
Technologie : PHP 
Pourquoi ce choix : PHP car j'ai plus d'éssence à utiliser PHP pour créer mon site. 

## Base de données
Technologie : PostgreSQL
Pourquoi ce choix : C'est comme le PHP, postgreSQL est celui que j'utilise le plus et que j'ai plus de esence.

## Communication frontend/backend
Méthode : Mon application utilise une architecture en trois couches :
Frontend (HTML/CSS/JS) ; Backend (PHP) ; Base de données (PostgreSQL).
Le frontend affiche les pages et envoie les actions de l’utilisateur au backend.
Le backend traite les actions et communique avec la base de données pour lire ou modifier les informations.

1. Dessinez votre architectur

┌──────────────┐
│    Frontend  │
│              │
└──────┬───────┘
       |
       |  HTTP / CSS
       V
┌──────▼───────┐
│      PHP     │
│      API     │
└──────┬───────┘
       |
       |  SQL
       V
┌──────▼───────--┐
│ Base de données│
└──────────────--┘