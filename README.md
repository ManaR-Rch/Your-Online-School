# School API - Plateforme de gestion de cours en ligne

Ce projet est une API Laravel complète pour une plateforme de gestion de cours en ligne avec gestion des utilisateurs (étudiants/administrateurs), achats de cours, progression, notes, favoris, upload de fichiers, statistiques, etc.

## Fonctionnalités principales
- Authentification JWT (étudiant/administrateur)
- Gestion des cours (CRUD, upload de vidéos/documents)
- Achat de cours et accès protégé aux contenus
- Prise de notes et suivi de progression par étudiant
- Gestion des favoris
- Statistiques administrateur
- Endpoints publics et protégés

## Prérequis
- PHP >= 8.1
- Composer
- MySQL ou MariaDB
- Node.js & npm (pour le front ou les assets, optionnel)
- Git

## Installation et démarrage

1. **Cloner le projet**
   ```bash
   git clone <url-du-repo>
   cd School
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Copier le fichier d'environnement**
   ```bash
   cp .env.example .env
   ```

4. **Configurer la base de données**
   - Ouvre `.env` et renseigne les variables DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.

5. **Générer la clé d'application et la clé JWT**
   ```bash
   php artisan key:generate
   php artisan jwt:secret
   ```

6. **Lancer les migrations**
   ```bash
   php artisan migrate
   ```

7. **Créer le lien de stockage public (pour les fichiers uploadés)**
   ```bash
   php artisan storage:link
   ```

8. **Démarrer le serveur de développement**
   ```bash
   php artisan serve
   ```

## Tester l'API
- Utilise la collection Postman fournie (`SchoolAPI.postman_collection.json`) pour tester tous les endpoints.
- Pense à renseigner la variable d'environnement `base_url` (ex: http://localhost:8000) et à utiliser les tokens JWT retournés par l'API.

## Pour les développeurs frontend
- Toutes les routes sont documentées dans la collection Postman.
- Les endpoints nécessitant une authentification attendent un header `Authorization: Bearer <token>`.
- Les fichiers uploadés sont accessibles via `/storage/uploads/...`.
- Les réponses sont toutes au format JSON.

## Structure des rôles
- **Administrateur** : gestion complète des cours, statistiques, upload, etc.
- **Étudiant** : achat de cours, accès aux contenus achetés, notes, progression, favoris.

## Contribution
Toute contribution est la bienvenue !

---

**Contact** : manarmarchou6@gmail.com