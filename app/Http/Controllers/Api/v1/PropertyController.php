<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\Validator;

class PropertyController extends ApiController
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

        $properties = PropertyResource::collection(Property::paginate($limit, ['*'], 'page', $page));

        return $this->success([
            'properties' => $properties,
            'pagination' => $this->formatPagination($properties)
        ]);
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);

        return $this->success(new PropertyResource($property));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'organisation' => 'required|string|max:255',
            'property_type' => 'required|string|max:50',
            'parent_property_id' => 'nullable|exists:properties,id',
            'uprn' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:10',
            'live' => 'required|boolean',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $property = Property::create($validation->validated());

        return $this->success(new PropertyResource($property));
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'organisation' => 'sometimes|string|max:255',
            'property_type' => 'sometimes|string|max:50',
            'parent_property_id' => 'sometimes|nullable|exists:properties,id',
            'uprn' => 'sometimes|nullable|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'town' => 'sometimes|nullable|string|max:100',
            'postcode' => 'sometimes|nullable|string|max:10',
            'live' => 'sometimes|boolean',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        $property = Property::findOrFail($id);

        $property->update($validation->validated());

        return $this->success(new PropertyResource($property));
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->delete();

        return $this->success();
    }

    public function moreThanFiveCertificates()
    {
        $eloquentProperties = Property::withCount('certificates')->having('certificates_count', '>', 5)->get();
        $rawProperties = DB::select("SELECT * FROM properties WHERE id IN (SELECT property_id FROM certificates GROUP BY property_id having count(*) > 5)");

        return $this->success([
            'eloquentProperties' => PropertyResource::collection($eloquentProperties),
            'rawProperties' => PropertyResource::collection($rawProperties)
        ]);
    }
}
