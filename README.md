# Vide Grenier - Gestion d'Articles 🚀

Application web permettant de gérer une liste d'articles pour un vide grenier virtuel.

## Technologies utilisées 🛠

- PHP 8
- MySQL 8.0
- Nginx
- Docker & Docker Compose
- phpMyAdmin

## Prérequis 📋

- Docker
- Docker Compose
- Git

## Installation 📦

1. Clonez le dépôt :
```bash
git clone <url-du-repo>
cd VideGrenier
```

2. Premier lancement :
   - Décommentez la ligne suivante dans `docker-compose.yml` :
```yaml
# - ./init.sql:/docker-entrypoint-initdb.d/init.sql
```
   - Lancez l'environnement :
```bash
chmod +x start-dev.sh stop-dev.sh
./start-dev.sh
```
   - Une fois l'application démarrée, recommentez la ligne dans `docker-compose.yml`

## Utilisation 🔧

### Démarrage
```bash
./start-dev.sh
```

### Arrêt
```bash
./stop-dev.sh
```

## Accès aux services 🔗

- Application : http://localhost:8080
- phpMyAdmin : http://localhost:8081
  - Serveur : mysql_db
  - Utilisateur : myuser
  - Mot de passe : mypassword
- MySQL :
  - Host : localhost:3306
  - Base : mydatabase
  - Utilisateur : myuser
  - Mot de passe : mypassword

## Structure du projet 📁

```
VideGrenier/
├── docker-compose.yml    # Configuration Docker
├── Dockerfile.php       # Configuration PHP
├── init.sql            # Initialisation BDD
├── nginx.conf          # Configuration Nginx
├── start-dev.sh       # Script de démarrage
├── stop-dev.sh        # Script d'arrêt
└── html/              # Sources de l'application
```

## Développement 💻

Les fichiers sources de l'application se trouvent dans le dossier `html/`. Les modifications sont prises en compte automatiquement grâce aux volumes Docker.
