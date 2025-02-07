# Projet de Gestion d'Articles 🚀

Application web simple permettant de gérer une liste d'articles avec une interface CRUD complète.

## Technologies utilisées 🛠

- PHP 8
- MySQL 8.0
- Nginx
- Docker & Docker Compose
- phpMyAdmin

## Fonctionnalités ✨

- Liste des articles
- Ajout d'articles
- Modification d'articles
- Suppression d'articles
- Interface responsive
- API REST complète

## Installation 📦

1. Clonez le dépôt
2. Assurez-vous que Docker est installé et en cours d'exécution
3. Pour le premier lancement uniquement, décommentez la ligne suivante dans `docker-compose.yml`:
```yaml
# - ./init.sql:/docker-entrypoint-initdb.d/init.sql
```
4. Exécutez le script de démarrage :
```bash
./start-dev.sh
```
5. Une fois l'application fonctionnelle, recommentez ou supprimez la ligne mentionnée à l'étape 3 pour éviter de réinitialiser la base de données aux prochains lancements.

## Accès aux services 🔗

- Application web : http://localhost:8080
- phpMyAdmin : http://localhost:8081
- Base de données MySQL : localhost:3306
  - Base : mydatabase
  - Utilisateur : myuser
  - Mot de passe : mypassword

## Arrêt de l'environnement ⏹

Pour arrêter tous les services :
```bash
./stop-dev.sh
