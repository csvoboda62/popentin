#!/bin/bash
# Script de vérification du statut Docker

echo "🔍 Vérification de l'installation Docker PHP 8.4"
echo "=================================================="
echo ""

# Vérifier si les conteneurs sont en cours d'exécution
echo "📦 Statut des conteneurs :"
docker compose ps
echo ""

# Vérifier la version de PHP
echo "🐘 Version de PHP :"
docker compose exec php php -v | head -1
echo ""

# Vérifier Composer
echo "📦 Version de Composer :"
docker compose exec php composer --version | head -1
echo ""

# Vérifier les extensions PHP
echo "🔧 Extensions PHP importantes :"
docker compose exec php php -m | grep -E "(pdo|pgsql|opcache|intl|zip|gd|mbstring)" | sort
echo ""

# Tester l'accès web
echo "🌐 Test de l'application web :"
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080)
if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ L'application répond correctement sur http://localhost:8080"
else
    echo "❌ L'application ne répond pas correctement (code: $HTTP_CODE)"
fi
echo ""

echo "=================================================="
echo "✅ Vérification terminée !"
echo ""
echo "Commandes utiles :"
echo "  make logs       - Voir les logs"
echo "  make bash       - Accéder au conteneur PHP"
echo "  make down       - Arrêter les conteneurs"
echo "  make help       - Voir toutes les commandes"

