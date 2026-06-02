# 📚 Guide Complet des APIs - Plateforme de Donation

## 🚀 Démarrage Rapide

### 1. **Démarrer le serveur Laravel**
```bash
cd c:\laragon\www\projetdonationv2
php artisan serve
```
Le serveur sera accessible à : `http://localhost:8000`

### 2. **Importer la collection Postman**
1. Ouvrez **Postman**
2. Cliquez sur **Import** (en haut à gauche)
3. Sélectionnez le fichier : `Donation_API_Postman_Collection.json`
4. La collection s'importera automatiquement

### 3. **Configurer l'environnement Postman**
- **base_url** : `http://localhost:8000` (déjà configuré)
- **token** : sera auto-généré lors du login
- **user_id** : sera auto-généré lors du login
- **donation_id** : sera auto-généré lors de la création de donation

---

## 📋 Liste des Endpoints API

### 🔐 **AUTHENTIFICATION**

#### Register (Créer un compte)
- **Méthode** : `POST`
- **URL** : `/register`
- **Headers** :
  ```
  Accept: application/json
  Content-Type: application/json
  ```
- **Body** :
  ```json
  {
    "name": "Younes Bachouche",
    "email": "younes@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```
- **Réponse** : Token d'authentification

#### Login (Se connecter)
- **Méthode** : `POST`
- **URL** : `/login`
- **Headers** :
  ```
  Accept: application/json
  Content-Type: application/json
  ```
- **Body** :
  ```json
  {
    "email": "younes@example.com",
    "password": "password123"
  }
  ```
- **Réponse** : Token Sanctum

#### Get Current User (Utilisateur connecté)
- **Méthode** : `GET`
- **URL** : `/api/user`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  ```
- **Réponse** : Informations de l'utilisateur

---

### 📦 **DONATIONS (CRUD)**

#### 1. Get All Donations (Toutes les donations)
- **Méthode** : `GET`
- **URL** : `/api/donations`
- **Headers** :
  ```
  Accept: application/json
  ```
- **Query Parameters** (optionnels) :
  - `search=medicine` - Rechercher par titre ou localisation
  - `category_id=1` - Filtrer par catégorie

**Exemple** :
```
GET http://localhost:8000/api/donations?search=medicine&category_id=1
```

**Réponse** :
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "Médicaments Antibiotic",
      "description": "Boîte de 20 comprimés",
      "category_id": 1,
      "quantity": "20 comprimés",
      "location": "Alger, Beaulieu",
      "whatsapp": "+213 555 123 456",
      "user_id": 1,
      "created_at": "2026-06-02T10:30:00Z",
      "updated_at": "2026-06-02T10:30:00Z",
      "category": { "id": 1, "name": "Médicaments" },
      "user": { "id": 1, "name": "Younes Bachouche" }
    }
  ],
  "count": 1
}
```

#### 2. Get Donation by ID (Détail d'une donation)
- **Méthode** : `GET`
- **URL** : `/api/donations/{id}`
- **Headers** :
  ```
  Accept: application/json
  ```

**Exemple** :
```
GET http://localhost:8000/api/donations/1
```

**Réponse** :
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "title": "Médicaments Antibiotic",
    "description": "Boîte de 20 comprimés...",
    ...
  }
}
```

#### 3. Create Donation (Créer une donation) ✅ AUTHENTIFIÉ
- **Méthode** : `POST`
- **URL** : `/api/donations`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  Content-Type: application/json
  ```
- **Body** :
  ```json
  {
    "title": "Vêtements de Secours",
    "description": "Lots de vêtements chauds pour l'hiver",
    "category_id": 2,
    "quantity": "50 pièces",
    "location": "Oran, Centre-Ville",
    "whatsapp": "+213 555 654 321"
  }
  ```

**Réponse** (201 Created) :
```json
{
  "status": "success",
  "message": "Donation créée avec succès",
  "data": {
    "id": 2,
    "title": "Vêtements de Secours",
    ...
  }
}
```

#### 4. Update Donation (Mettre à jour une donation) ✅ AUTHENTIFIÉ
- **Méthode** : `PUT`
- **URL** : `/api/donations/{id}`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  Content-Type: application/json
  ```
- **Body** :
  ```json
  {
    "title": "Vêtements - MISE À JOUR",
    "status": "pending",
    "quantity": "40 pièces restantes"
  }
  ```

**Réponse** :
```json
{
  "status": "success",
  "message": "Donation mise à jour avec succès",
  "data": { ... }
}
```

#### 5. Delete Donation (Supprimer une donation) ✅ AUTHENTIFIÉ
- **Méthode** : `DELETE`
- **URL** : `/api/donations/{id}`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  ```

**Réponse** (200 OK) :
```json
{
  "status": "success",
  "message": "Donation supprimée avec succès"
}
```

---

### 🏷️ **CATEGORIES**

#### Get All Categories (Toutes les catégories)
- **Méthode** : `GET`
- **URL** : `/api/categories`
- **Headers** :
  ```
  Accept: application/json
  ```

**Réponse** :
```json
[
  {
    "id": 1,
    "name": "Médicaments",
    "description": "Médicaments et produits de santé",
    "slug": "medicaments",
    "icon": "fa-pills",
    "created_at": "2026-06-02T10:00:00Z"
  },
  {
    "id": 2,
    "name": "Vêtements",
    "description": "Vêtements et accessoires",
    "slug": "vetements",
    "icon": "fa-shirt",
    "created_at": "2026-06-02T10:00:00Z"
  }
]
```

#### Get Category by ID (Détail d'une catégorie)
- **Méthode** : `GET`
- **URL** : `/api/categories/{id}`
- **Headers** :
  ```
  Accept: application/json
  ```

**Réponse** :
```json
{
  "id": 1,
  "name": "Médicaments",
  "donations": [
    { "id": 1, "title": "Antibiotic..." },
    { "id": 3, "title": "Vitamines..." }
  ]
}
```

---

### 👤 **PROFILE**

#### Get Profile (Mon profil) ✅ AUTHENTIFIÉ
- **Méthode** : `GET`
- **URL** : `/api/profile`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  ```

**Réponse** :
```json
{
  "id": 1,
  "name": "Younes Bachouche",
  "email": "younes@example.com",
  "phone": "+213 555 123 456",
  "address": "Alger, Beaulieu",
  "created_at": "2026-06-02T09:00:00Z"
}
```

#### Update Profile (Mettre à jour mon profil) ✅ AUTHENTIFIÉ
- **Méthode** : `PATCH`
- **URL** : `/api/profile`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  Content-Type: application/json
  ```
- **Body** :
  ```json
  {
    "name": "Younes Bachouche Updated",
    "phone": "+213 555 999 888",
    "address": "Oran, Nouvelle Adresse"
  }
  ```

**Réponse** :
```json
{
  "status": "success",
  "message": "Profil mis à jour avec succès",
  "data": { ... }
}
```

#### Delete Profile (Supprimer mon compte) ✅ AUTHENTIFIÉ
- **Méthode** : `DELETE`
- **URL** : `/api/profile`
- **Headers** :
  ```
  Accept: application/json
  Authorization: Bearer {token}
  ```

**Réponse** :
```json
{
  "status": "success",
  "message": "Compte supprimé avec succès"
}
```

---

## 🧪 Guide de Test avec Postman

### Étape 1 : S'authentifier
1. Accédez à **Authentification** → **Register**
2. Changez l'email et modifiez les données si nécessaire
3. Cliquez sur **Send**
4. Le token sera automatiquement sauvegardé dans les variables d'environnement

### Étape 2 : Créer une donation
1. Accédez à **Donations** → **Create Donation**
2. Vérifiez que le token est présent
3. Modifiez le contenu du body si nécessaire
4. Cliquez sur **Send**
5. L'ID de donation sera automatiquement sauvegardé

### Étape 3 : Récupérer les donations
1. Accédez à **Donations** → **Get All Donations**
2. Cliquez sur **Send**
3. Vous verrez toutes les donations au format JSON

### Étape 4 : Mettre à jour la donation
1. Accédez à **Donations** → **Update Donation**
2. Modifiez les champs souhaités
3. Cliquez sur **Send**

### Étape 5 : Supprimer la donation
1. Accédez à **Donations** → **Delete Donation**
2. Cliquez sur **Send**
3. La donation sera supprimée

---

## 🔐 Codes d'Erreur API

| Code | Signification | Exemple |
|------|--------------|---------|
| 200 | OK - Succès | GET, PUT, PATCH, DELETE réussis |
| 201 | Created - Création réussie | POST réussi |
| 400 | Bad Request - Requête invalide | Données manquantes ou invalides |
| 401 | Unauthorized - Non authentifié | Token absent ou invalide |
| 403 | Forbidden - Non autorisé | Tentative de modifier la donation d'un autre utilisateur |
| 404 | Not Found - Ressource introuvable | Donation ou catégorie inexistante |
| 422 | Unprocessable Entity - Validation échouée | Champs obligatoires manquants |
| 500 | Internal Server Error - Erreur serveur | Erreur côté serveur |

---

## ⚙️ Variables d'Environnement Postman

Ces variables sont définis automatiquement lors du login :

- **base_url** : `http://localhost:8000` (à adapter si différent)
- **token** : Token Bearer d'authentification Sanctum
- **user_id** : ID de l'utilisateur connecté
- **donation_id** : ID de la dernière donation créée

---

## 💡 Exemples de Requêtes cURL

### Récupérer toutes les donations
```bash
curl -H "Accept: application/json" \
  http://localhost:8000/api/donations
```

### Créer une donation avec token
```bash
curl -X POST http://localhost:8000/api/donations \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Médicaments",
    "description": "Boîte de comprimés",
    "category_id": 1,
    "quantity": "20",
    "location": "Alger",
    "whatsapp": "+213555123456"
  }'
```

### Mettre à jour une donation
```bash
curl -X PUT http://localhost:8000/api/donations/1 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Médicaments - Mis à jour",
    "status": "pending"
  }'
```

---

## 📝 Notes Importantes

✅ **Les APIs sont maintenant complètement implémentées !**
✅ **Authentification Sanctum intégrée**
✅ **Gestion des permissions (propriétaire ou admin)**
✅ **Validation stricte des données**
✅ **Réponses JSON standardisées**

---

## 🆘 Support

Pour des questions ou pour signaler des bugs :
1. Vérifiez que le serveur Laravel est bien démarré
2. Vérifiez que le token est valide
3. Vérifiez que les headers sont corrects
4. Consultez les logs Laravel : `php artisan tail`

---

**Plateforme de Donation v1.0 - 2025/2026**
Développé par Younes BACHOUCHE & Berrache HAITHEM
Encadré par Madame KRIM
