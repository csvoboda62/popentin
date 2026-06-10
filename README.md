# Popentin

Application Symfony pour la gestion de collections Funko Pop.

## 🚀 Démarrage rapide avec Docker

### Prérequis
- Docker
- Docker Compose (ou Docker avec plugin compose)

### Installation automatique

Lancez simplement le script d'installation :

```bash
./docker-install.sh
```

### Installation manuelle

Ou suivez ces étapes :

```bash
# 1. Copier le fichier d'environnement
cp .env.docker .env

# 2. Construire et démarrer les conteneurs
docker compose up -d --build

# 3. Installer les dépendances
docker compose exec php composer install

# 4. Créer la base de données
docker compose exec php php bin/console doctrine:database:create
docker compose exec php php bin/console doctrine:migrations:migrate

# 5. Charger les fixtures (optionnel)
docker compose exec php php bin/console doctrine:fixtures:load
```

### Avec Makefile (encore plus simple !)

```bash
# Installation complète en une commande
make install

# Voir toutes les commandes disponibles
make help
```

## 📱 Accès

- **Application** : http://localhost:8080
- **Base de données** : localhost:3306
  - Nom : popentin
  - Utilisateur : popentin
  - Mot de passe : popentin123

## 🛠️ Technologies

- **PHP 8.4** avec PHP-FPM
- **Symfony 7.4 LTS**
- **Doctrine ORM 3.6**
- **MySQL 8.0**
- **Nginx**
- **Docker** & **Docker Compose**
- **EasyAdmin 4** pour l'administration
- **Webpack Encore** pour les assets

## 📚 Documentation

Pour plus de détails sur la configuration Docker, consultez [README.docker.md](README.docker.md)

## ⚙️ Commandes utiles

```bash
# Voir les logs
make logs

# Accéder au conteneur PHP
make bash

# Vider le cache
make cache-clear

# Réinitialiser la base de données
make db-reset

# Arrêter les conteneurs
make down
```

## 📝 License

Propriétaire




