<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Property;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CertificateResource;
use App\Http\Controllers\Api\v1\ApiController;

class CertificateController extends ApiController
{
    public function index(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'limit' => 'sometimes|integer|min:1|max:100',
            'page' => 'sometimes|integer|min:1',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $page = $validation->validated()['page'] ?? 1;
        $limit = max(1, min(100, $validation->validated()['limit'] ?? 100));

        $certificates = CertificateResource::collection(Certificate::paginate($limit, ['*'], 'page', $page));

        return $this->success([
            'certificates' => $certificates,
            'pagination' => $this->formatPagination($certificates)
        ]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'stream_name' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
            'issue_date' => 'required|date',
            'next_due_date' => 'required|date',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $certificate = Certificate::create($validation->validated());

        return $this->success(new CertificateResource($certificate));
    }

    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);

        return $this->success(new CertificateResource($certificate));
    }

    public function getPropertyCertificates($propertyId, Request $request)
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

        $paginator = $property->certificates()->paginate($limit, ['*'], 'page', $page);
        $certificates = CertificateResource::collection($paginator);

        return $this->success([
            'certificates' => $certificates,
            'pagination' => $this->formatPagination($paginator)
        ]);
    }
}
