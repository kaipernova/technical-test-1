<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\NoteController;
use App\Http\Controllers\Api\v1\PropertyController;
use App\Http\Controllers\Api\v1\CertificateController;

// API Version 1
Route::prefix('v1')->group(function() {
    // Additional Technical Test Route
    Route::get('/mtfc', [PropertyController::class, 'moreThanFiveCertificates']);

    // Property Routes
    Route::prefix('property')->group(function() {
        // Property CRUD
        Route::get('/', [PropertyController::class, 'index']);
        Route::post('/', [PropertyController::class, 'store']);
        Route::get('/{id}', [PropertyController::class, 'show']);
        Route::patch('/{id}', [PropertyController::class, 'update']);
        Route::delete('/{id}', [PropertyController::class, 'destroy']);

        // Property Notes
        Route::get('/{id}/note', [NoteController::class, 'getPropertyNotes']);
        Route::post('/{id}/note', [NoteController::class, 'storePropertyNote']);

        // Property Certificates
        Route::get('/{id}/certificate', [CertificateController::class, 'getPropertyCertificates']);
    });

    // Certificate Routes
    Route::prefix('certificate')->group(function() {
        // Certificate CRUD
        Route::get('/', [CertificateController::class, 'index']);
        Route::post('/', [CertificateController::class, 'store']);
        Route::get('/{id}', [CertificateController::class, 'show']);

        // Certificate Notes
        Route::get('/{id}/note', [NoteController::class, 'getCertificateNotes']);
        Route::post('/{id}/note', [NoteController::class, 'storeCertificateNote']);
    });
});
