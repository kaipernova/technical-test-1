<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Property;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\v1\ApiController;

class NoteController extends ApiController
{
    public function getPropertyNotes($propertyId, Request $request)
    {
        $property = Property::findOrFail($propertyId);

        $validation = Validator::make($request->all(), [
            'limit' => 'sometimes|integer|min:1|max:100',
            'page' => 'sometimes|integer|min:1',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $page = $validation->validated()['page'] ?? 1;
        $limit = max(1, min(100, $validation->validated()['limit'] ?? 100));

        $paginator = $property->notes()->paginate($limit, ['*'], 'page', $page);
        $notes = NoteResource::collection($paginator);

        return $this->success([
            'notes' => $notes,
            'pagination' => $this->formatPagination($paginator)
        ]);
    }

    public function storePropertyNote($propertyId, Request $request)
    {
        $property = Property::findOrFail($propertyId);

        $note = $property->addNote($request->note);

        return $this->success(NoteResource::make($note));
    }

    public function getCertificateNotes($certificateId, Request $request)
    {
        $certificate = Certificate::findOrFail($certificateId);

        $validation = Validator::make($request->all(), [
            'limit' => 'sometimes|integer|min:1|max:100',
            'page' => 'sometimes|integer|min:1',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $page = $validation->validated()['page'] ?? 1;
        $limit = max(1, min(100, $validation->validated()['limit'] ?? 100));

        $paginator = $certificate->notes()->paginate($limit, ['*'], 'page', $page);
        $notes = NoteResource::collection($paginator);

        return $this->success([
            'notes' => $notes,
            'pagination' => $this->formatPagination($paginator)
        ]);
    }

    public function storeCertificateNote($certificateId, Request $request)
    {
        $certificate = Certificate::findOrFail($certificateId);

        $note = $certificate->addNote($request->note);

        return $this->success(NoteResource::make($note));
    }
}
