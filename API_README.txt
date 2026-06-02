📦 PLATEFORME DE DONATION - APIs IMPLÉMENTÉES
═══════════════════════════════════════════════════════════

✅ OUI ! Le projet CONTIENT des APIs complètes !

═══════════════════════════════════════════════════════════
📊 STATISTICS DES APIs
═══════════════════════════════════════════════════════════

Total Endpoints:        14 ✅
Authentifiés:           7 (Sanctum)
Publics:                7
Type d'Authentification: Bearer Token (Sanctum)

═══════════════════════════════════════════════════════════
📋 LIST COMPLÈTE DES ENDPOINTS
═══════════════════════════════════════════════════════════

🔐 AUTHENTIFICATION (3 endpoints)
   ├─ POST   /register              → Créer un compte
   ├─ POST   /login                 → Se connecter
   └─ GET    /api/user              → Utilisateur actuel ✅

📦 DONATIONS (6 endpoints)
   ├─ GET    /api/donations         → Lister toutes
   ├─ GET    /api/donations/{id}    → Détail
   ├─ POST   /api/donations         → Créer ✅
   ├─ PUT    /api/donations/{id}    → Modifier ✅
   ├─ DELETE /api/donations/{id}    → Supprimer ✅
   └─ Filter → ?search=... ?category_id=...

🏷️ CATÉGORIES (2 endpoints)
   ├─ GET    /api/categories        → Lister toutes
   └─ GET    /api/categories/{id}   → Détail + donations

👤 PROFIL (3 endpoints)
   ├─ GET    /api/profile           → Mon profil ✅
   ├─ PATCH  /api/profile           → Mettre à jour ✅
   └─ DELETE /api/profile           → Supprimer compte ✅

✅ = Authentification requise

═══════════════════════════════════════════════════════════
🚀 DÉMARRAGE RAPIDE
═══════════════════════════════════════════════════════════

OPTION 1 - Avec le script batch (Facile)
   Double-cliquez: START_API_SERVER.bat
   → Le serveur démarre automatiquement

OPTION 2 - Manuellement
   1. Ouvrez PowerShell
   2. cd C:\laragon\www\projetdonationv2
   3. php artisan serve
   4. Le serveur démarre sur http://localhost:8000

═══════════════════════════════════════════════════════════
🧪 TESTER AVEC POSTMAN
═══════════════════════════════════════════════════════════

ÉTAPE 1 - Importer la collection
   └─ Postman → Import → Donation_API_Postman_Collection.json
      ✓ 14 endpoints prêts à tester

ÉTAPE 2 - Se connecter
   └─ Allez dans: Authentification → Login
      ✓ Entrez vos identifiants
      ✓ Cliquez Send
      ✓ Le token s'auto-sauvegarde

ÉTAPE 3 - Tester les endpoints
   └─ Parcourez les dossiers Postman
      ✓ Donations
      ✓ Catégories
      ✓ Profil
      ✓ Cliquez Send sur chaque endpoint

ÉTAPE 4 - Les variables s'auto-remplissent
   ├─ token         (Auto-généré au login)
   ├─ user_id       (Auto-généré au login)
   ├─ donation_id   (Auto-généré à la création)
   └─ base_url      (http://localhost:8000)

═══════════════════════════════════════════════════════════
📊 EXEMPLE D'UTILISATION
═══════════════════════════════════════════════════════════

1. REGISTER / LOGIN
   ┌─ POST /register
   │  └─ Body: { name, email, password, password_confirmation }
   │     ✓ Retourne: token, user
   │
   └─ POST /login
      └─ Body: { email, password }
         ✓ Retourne: token, user

2. GET DONATIONS
   ├─ GET /api/donations
   │  └─ Retourne: Toutes les donations avec user et category
   │
   ├─ GET /api/donations?search=medicine
   │  └─ Retourne: Donations contenant "medicine"
   │
   ├─ GET /api/donations?category_id=1
   │  └─ Retourne: Donations de la catégorie 1
   │
   └─ GET /api/donations/1
      └─ Retourne: Donation avec ID 1

3. CREATE DONATION ✅ (Authentifié)
   POST /api/donations
   Headers: Authorization: Bearer {token}
   Body: {
     "title": "Médicaments",
     "description": "...",
     "category_id": 1,
     "quantity": "20",
     "location": "Alger",
     "whatsapp": "+213..."
   }
   ✓ Retourne: Status 201 + donation créée

4. UPDATE DONATION ✅ (Authentifié)
   PUT /api/donations/1
   Headers: Authorization: Bearer {token}
   Body: {
     "title": "Nouveau titre",
     "status": "pending"
   }
   ✓ Retourne: Donation mise à jour

5. DELETE DONATION ✅ (Authentifié)
   DELETE /api/donations/1
   Headers: Authorization: Bearer {token}
   ✓ Retourne: Status 200 + message de succès

═══════════════════════════════════════════════════════════
📁 FICHIERS DOCUMENTATION
═══════════════════════════════════════════════════════════

✅ Donation_API_Postman_Collection.json
   └─ Collection Postman prête à importer
      (14 endpoints pré-configurés)

✅ API_GUIDE_POSTMAN.md
   └─ Guide complet de tous les endpoints
      - Détails de chaque endpoint
      - Exemples de requêtes/réponses
      - Codes d'erreur
      - Tests pas à pas

✅ API_SUMMARY.md
   └─ Résumé des APIs implémentées
      - Vue d'ensemble
      - Étapes de test

✅ START_API_SERVER.bat
   └─ Script pour démarrer le serveur facilement
      (Double-cliquez pour lancer)

═══════════════════════════════════════════════════════════
🔒 AUTHENTIFICATION SANCTUM
═══════════════════════════════════════════════════════════

Type:     Bearer Token
Format:   Authorization: Bearer {token}
Source:   Auto-généré au login

Endpoints protégés:
   ├─ POST   /api/donations
   ├─ PUT    /api/donations/{id}
   ├─ DELETE /api/donations/{id}
   ├─ GET    /api/profile
   ├─ PATCH  /api/profile
   └─ DELETE /api/profile

═══════════════════════════════════════════════════════════
✨ CARACTÉRISTIQUES AVANCÉES
═══════════════════════════════════════════════════════════

✅ Gestion d'erreurs HTTP complète (400, 401, 403, 404, 422, 500)
✅ Validation stricte des données
✅ Réponses JSON standardisées
✅ Filtrage et recherche avancée
✅ Vérification des permissions (propriétaire/admin)
✅ Hash de mots de passe sécurisé
✅ Relations Eloquent préchargées
✅ Format de pagination
✅ Variables d'environnement Postman

═══════════════════════════════════════════════════════════
🆘 DÉPANNAGE
═══════════════════════════════════════════════════════════

Problème: Le serveur ne démarre pas
   Solution: Vérifiez que Laragon est bien démarré
            Vérifiez que le port 8000 n'est pas utilisé

Problème: Token invalide
   Solution: Connectez-vous à nouveau pour générer un nouveau token
            Vérifiez le format: Authorization: Bearer {token}

Problème: 403 Unauthorized
   Solution: Vérifiez que vous êtes connecté
            Vérifiez le token dans les headers

Problème: 404 Not Found
   Solution: Vérifiez l'URL de l'endpoint
            Vérifiez que la ressource existe (ID valide)

Problème: 422 Validation Failed
   Solution: Vérifiez que tous les champs requis sont présents
            Consultez API_GUIDE_POSTMAN.md pour les formats

═══════════════════════════════════════════════════════════
📞 SUPPORT
═══════════════════════════════════════════════════════════

Consultez:
   1. API_GUIDE_POSTMAN.md (Guide détaillé)
   2. API_SUMMARY.md (Vue d'ensemble)
   3. Logs Laravel: php artisan tail
   4. Network Postman (Request/Response)

═══════════════════════════════════════════════════════════

Plateforme de Donation v1.0
Développé par: Younes BACHOUCHE & Berrache HAITHEM
Encadré par: Madame KRIM
Année: 2025/2026
Spécialité: Développement Web et Mobile - Semestre 4

═══════════════════════════════════════════════════════════
