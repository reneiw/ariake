<?php


namespace App\Http\Controllers;


use App\Models\Resource;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    use SoftDeletes;

    public function index(Request $request)
    {
        return Resource::query()->paginate();
    }

    public function show($id)
    {
        return Resource::query()->find($id);
    }

    public function store(Request $request)
    {
        Resource::query()->create($request->all());
        return response()->noContent(201);
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::query()->find($id);
        $resource->fill($request->all())->save();
        return response()->noContent(205);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $resource =Resource::query()->find($id);
        $resource->delete();
        return response()->noContent();
    }
}
