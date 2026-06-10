#!/bin/bash

# Script d'installation rapide pour Popentin avec Docker

set -e

echo "🚀 Installation de Popentin avec Docker et PHP 8.4"
echo ""

# Vérifier si Docker est installé
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé. Veuillez l'installer d'abord : https://docs.docker.com/get-docker/"
    exit 1
fi

# Vérifier si le fichier .env existe déjà
if [ -f .env ]; then
    echo "⚠️  Le fichier .env existe déjà."
    read -p "Voulez-vous le remplacer par .env.docker ? (y/N) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        cp .env.docker .env
        echo "✓ Fichier .env mis à jour"
    else
        echo "✓ Conservation du fichier .env existant"
    fi
else
    cp .env.docker .env
    echo "✓ Fichier .env créé"
fi

# Arrêter et supprimer les anciens conteneurs s'ils existent
echo ""
echo "🧹 Nettoyage des anciens conteneurs..."
docker compose down -v 2>/dev/null || true

# Construire les images Docker
echo ""
echo "🔨 Construction des images Docker..."
docker compose build

# Démarrer les conteneurs
echo ""
echo "🚢 Démarrage des conteneurs..."
docker compose up -d

# Attendre que les services soient prêts
echo ""
echo "⏳ Attente du démarrage des services..."
sleep 5

# Installer les dépendances Composer
echo ""
echo "📦 Installation des dépendances Composer..."
docker compose exec php composer install --no-interaction

# Créer la base de données
echo ""
echo "🗄️  Création de la base de données..."
docker compose exec php php bin/console doctrine:database:create --if-not-exists --no-interaction

# Exécuter les migrations
echo ""
echo "📊 Exécution des migrations..."
docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

# Charger les fixtures
echo ""
read -p "Voulez-vous charger les fixtures (données de test) ? (y/N) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "📝 Chargement des fixtures..."
    docker compose exec php php bin/console doctrine:fixtures:load --no-interaction
    echo "✓ Fixtures chargées"
fi

# Vider le cache
echo ""
echo "🧹 Vidage du cache..."
docker compose exec php php bin/console cache:clear --no-interaction

# Afficher les informations finales
echo ""
echo "✅ Installation terminée !"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📱 Application disponible sur : http://localhost:8080"
echo "🗄️  Base de données PostgreSQL : localhost:5432"
echo "   - Nom : popentin"
echo "   - Utilisateur : popentin"
echo "   - Mot de passe : popentin123"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Commandes utiles :"
echo "  make logs       - Voir les logs"
echo "  make bash       - Accéder au conteneur PHP"
echo "  make down       - Arrêter les conteneurs"
echo "  make help       - Voir toutes les commandes"
echo ""

