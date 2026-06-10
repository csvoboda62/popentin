# Docker Setup - Popentin

## Configuration Docker avec PHP 8.4

Ce projet est maintenant configuré avec Docker et PHP 8.4.

### Services inclus

- **PHP 8.4-FPM** : Serveur PHP avec toutes les extensions nécessaires pour Symfony
- **Nginx** : Serveur web
- **MySQL 8.0** : Base de données

### Démarrage rapide

1. **Copier le fichier d'environnement Docker** :
```bash
cp .env.docker .env
```

2. **Construire et démarrer les conteneurs** :
```bash
docker compose up -d --build
```

3. **Installer les dépendances Composer** (si nécessaire) :
```bash
docker compose exec php composer install
```

4. **Créer la base de données** :
```bash
docker compose exec php php bin/console doctrine:database:create
docker compose exec php php bin/console doctrine:migrations:migrate
```

5. **Charger les fixtures** (optionnel) :
```bash
docker compose exec php php bin/console doctrine:fixtures:load
```

### Utilisation avec Makefile (recommandé)

Pour simplifier les commandes, utilisez le Makefile :

```bash
# Installation complète en une commande
make install

# Voir toutes les commandes disponibles
make help
```

### Accès à l'application

- **Application Web** : http://localhost:8080
- **MySQL** : localhost:3306
  - Base de données : popentin
  - Utilisateur : popentin
  - Mot de passe : popentin123

### Commandes utiles

**Voir les logs** :
```bash
docker compose logs -f
# ou
make logs
```

**Arrêter les conteneurs** :
```bash
docker compose down
# ou
make down
```

**Redémarrer les conteneurs** :
```bash
docker compose restart
# ou
make restart
```

**Accéder au conteneur PHP** :
```bash
docker compose exec php bash
# ou
make bash
```

**Exécuter des commandes Symfony** :
```bash
docker compose exec php php bin/console [commande]
```

**Vider le cache** :
```bash
docker compose exec php php bin/console cache:clear
# ou
make cache-clear
```

### Installation des assets (si nécessaire)

Si vous utilisez Webpack Encore, installez les dépendances npm sur votre machine locale :
```bash
npm install
npm run dev
```

Ou pour la production :
```bash
npm run build
```

### Notes

- Les fichiers du projet sont montés en volume, donc toute modification est immédiatement visible
- Le serveur Nginx écoute sur le port 8080
- La base de données PostgreSQL écoute sur le port 5432
- Les données de la base sont persistées dans un volume Docker

### Problèmes courants

**Erreur de permissions** :
```bash
docker compose exec php chown -R www-data:www-data var/
```

**Reconstruire les images** :
```bash
docker compose down
docker compose up -d --build
# ou
make down
make build
make up
```

**Réinitialiser complètement** :
```bash
docker compose down -v
docker compose up -d --build
```




