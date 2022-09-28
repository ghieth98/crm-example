<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreClientRequest;
use App\Http\Requests\V1\UpdateClientRequest;
use App\Http\Resources\V1\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection(Client::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return ClientResource
     */
    public function store(StoreClientRequest $request): ClientResource
    {
        $client = Client::create($request->validated());

        return  new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return ClientResource
     */
    public function update(UpdateClientRequest $request, Client $client): ClientResource
    {
        $client->update($request->all());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     */
    public function destroy(Client $client): Response
    {
        $client->delete();

        return response('Deleted Successfully', '204');
    }
}
