#!/bin/bash

echo "🛑 Arrêt de l'environnement de développement..."

# Arrêter les conteneurs
docker-compose down

echo "✅ Environnement de développement arrêté avec succès!"