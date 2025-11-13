# Technical Test

**1. Using Laravel, MySQL and the enclosed data create an API that serves data to the following endpoints:**
```
GET /property                       - Returns properties
GET /property/{id}                  - Returns a property
POST /property                      - Creates a new property
PATCH /property/{id}                - Updates a property
DELETE /property/{id}               - Deletes a property
GET /property/{id}/certificate      - Returns the certificates of a property
GET /property/{id}/note             - Returns the notes of a property
POST /property/{id}/note            - Creates a note for a property

GET /certificate                    - Returns certificates
GET /certificate/{id}               - Returns a certificate
POST /certificate     			    - Creates a certificate
GET /certificate/{id}/note          - Returns the notes of a certificate
POST /certificate/{id}/note         - Creates a note for a certificate

[+] GET /mtfc                       - Used for the 2nd part of the technical test
```

**2. Write a MySQL raw query & eloquent query to get properties which has more than 5 certificates**

# Installation

**1. Clone the repository**

**2. Install dependencies**
```
composer install
```

**3. Copy .env.example to .env and .env.testing.example to .env.testing, fill in the database credentials**

**4. Generate application key**
```
php artisan key:generate
```

**6. Run migrations**
```
php artisan migrate
```

**7. Run tests**
```
php artisan test
```
