# Technical Test

**1. Using Laravel, MySQL and the enclosed data create an API that serves data to the following endpoints:**
```
GET    /api/v1/property                       - Returns properties
GET    /api/v1/property/{id}                  - Returns a property
POST   /api/v1/property                       - Creates a new property
PATCH  /api/v1/property/{id}                  - Updates a property
DELETE /api/v1/property/{id}                  - Deletes a property
GET    /api/v1/property/{id}/certificate      - Returns the certificates of a property
GET    /api/v1/property/{id}/note             - Returns the notes of a property
POST   /api/v1/property/{id}/note             - Creates a note for a property

GET    /api/v1/certificate                    - Returns certificates
GET    /api/v1/certificate/{id}               - Returns a certificate
POST   /api/v1/certificate     			      - Creates a certificate
GET    /api/v1/certificate/{id}/note          - Returns the notes of a certificate
POST   /api/v1/certificate/{id}/note          - Creates a note for a certificate

GET    /api/v1/mtfc [+]                       - Used for the 2nd part of the technical test
```

**2. Write a MySQL raw query & eloquent query to get properties which has more than 5 certificates**

# Notes
**Important Note:** Since I added API Versioning, the routes required in the test above have been updated to reflect that. For an example, the test only specified /property, due to versioning it became /api/v1/property)

I spent a total of 3 hours and 20 minutes on this test across 2 sessions. I was able to complete all the tasks and added some additional features to the API. The kind of features that I would expect to see in a production environment, such as API versioning, pagination and feature testing. If I was to put more time into it, I would have also added caching and rate limiting.

I also modified the SQL Dump slightly, changing "model_type" and "model_id" to "notable_type" and "notable_id" respectively, on the Notes table. This was basically entirely by preference and I could have (and maybe should have) consulted with the interviewer to see if model_type and model_id were required. There also wasn't a schema provided for the tables themselves, only the inserts, so obviously I had to make assumptions based on the data provided.

The test required me to write a raw MySQL query and an Eloquent query to get properties and so I've created a new endpoint called /mtfc (More Than Five Certificates) to demonstrate both queries. They are written in the PropertyController.php file as the moreThanFiveCertificates method.

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
