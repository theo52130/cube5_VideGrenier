#!/bin/bash

echo "🚀 Starting development environment..."

# Vérifier si Docker est en cours d'exécution
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker n'est pas en cours d'exécution. Veuillez démarrer Docker d'abord."
    exit 1
fi

# Démarrer les conteneurs
echo "📦 Démarrage des conteneurs..."
docker-compose up -d

# Attendre que les services soient prêts
echo "⏳ Attente du démarrage des services..."
sleep 5

echo "✅ Environnement de développement prêt!"
echo "📝 Accès aux services:"
echo "- Site web: http://localhost:8080"
echo "- phpMyAdmin: http://localhost:8081"
echo "- MySQL: localhost:3306"