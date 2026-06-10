.PHONY: help build up down restart logs ps bash cache-clear db-create db-migrate db-reset fixtures install

help: ## Afficher cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Construire les conteneurs Docker
	docker compose build

up: ## Démarrer les conteneurs
	docker compose up -d

down: ## Arrêter les conteneurs
	docker compose down

restart: ## Redémarrer les conteneurs
	docker compose restart

logs: ## Voir les logs
	docker compose logs -f

ps: ## Lister les conteneurs
	docker compose ps

bash: ## Accéder au conteneur PHP
	docker compose exec php bash

cache-clear: ## Vider le cache Symfony
	@echo "🧹 Vidage du cache Symfony..."
	@docker compose exec php php bin/console cache:clear 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true

db-create: ## Créer la base de données
	@echo "📦 Création de la base de données..."
	@docker compose exec php php bin/console doctrine:database:create --if-not-exists 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true

db-migrate: ## Exécuter les migrations
	@echo "🔄 Exécution des migrations..."
	@docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true

db-reset: ## Réinitialiser la base de données
	@echo "🔄 Réinitialisation de la base de données..."
	@docker compose exec php php bin/console doctrine:database:drop --force --if-exists 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true
	@docker compose exec php php bin/console doctrine:database:create 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true
	@docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true

fixtures: ## Charger les fixtures
	@echo "📝 Chargement des fixtures..."
	@docker compose exec php php bin/console doctrine:fixtures:load --no-interaction 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true

install: ## Installation complète du projet
	@echo "🚀 Installation complète de Popentin..."
	cp .env.docker .env
	docker compose up -d --build
	@echo "📦 Installation des dépendances..."
	@docker compose exec php composer install --no-interaction 2>&1 | grep -v "Deprecated:" | grep -v "Implicitly marking" | sed '/^$$/d' || true
	@$(MAKE) db-create
	@$(MAKE) db-migrate
	@$(MAKE) fixtures
	@echo "\n\033[32m✓ Installation terminée ! L'application est accessible sur http://localhost:8080\033[0m\n"

start: up ## Alias pour 'up'

stop: down ## Alias pour 'down'






