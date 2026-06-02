# Plateforme de Donations - Laravel

Une plateforme complète de donations développée avec Laravel, offrant une interface moderne et responsive pour faciliter l'entraide communautaire.

## Fonctionnalités

- **Authentification complète** : Inscription, connexion et déconnexion sécurisées.
- **Gestion des Donations** : Publication de dons avec titre, description, image, catégorie, quantité et localisation.
- **Système de Recherche** : Recherche par titre ou par localisation.
- **Navigation par Catégories** : Filtrage des dons par type (Médicaments, Vêtements, Nourriture, Aide humanitaire).
- **Contact Direct** : Bouton de contact direct via WhatsApp pour chaque donation.
- **Interface Responsive** : Design moderne utilisant Bootstrap 5, adapté aux mobiles, tablettes et ordinateurs.

## Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite (ou autre driver de base de données supporté par Laravel)

## Installation

1. **Extraire les fichiers** du projet.
2. **Installer les dépendances PHP** :
   ```bash
   composer install
   ```
3. **Installer les dépendances Node.js** :
   ```bash
   npm install && npm run build
   ```
4. **Configurer l'environnement** :
   - Copier `.env.example` en `.env`.
   - Assurez-vous que `DB_CONNECTION` est réglé sur `sqlite`.
   - Créez le fichier de base de données : `touch database/database.sqlite`.
5. **Générer la clé d'application** :
   ```bash
   php artisan key:generate
   ```
6. **Lancer les migrations et les seeders** :
   ```bash
   php artisan migrate --seed
   ```
7. **Lancer le serveur de développement** :
   ```bash
   php artisan serve
   ```

## Structure du Projet

- **Models** : `User`, `Category`, `Donation`.
- **Controllers** : `DonationController`, `CategoryController`, `AuthController`.
- **Views** : Templates Blade utilisant Bootstrap 5.
- **Database** : SQLite pour une configuration simplifiée.

## Crédits

Développé en 2026 - Tous droits réservés.
