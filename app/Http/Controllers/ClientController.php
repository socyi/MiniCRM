<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Index page for clients, paginated by 10
    public function index()
    {
        $clients = Client::paginate(10);

        return Inertia::render('Client/ClientsIndex', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Create page for clients
    public function create()
    {
        return Inertia::render('Client/ClientCreate'); // Adjust to your view
    }

    /**
     * Store a newly created resource in storage.
     */
    // Store the client
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();

        // Check if an avatar file is uploaded
        if ($request->hasFile('avatar')) {
            // Store the file and get the path
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        Client::create($data);
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }
    /**
     * Display the specified resource.
     */
    // Page that shows one client
    public function show(Client $client)
    {
        return Inertia::render('Client/ClientView', [
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Edit page for one client
    public function edit(Client $client)
    {
        return Inertia::render('Client/ClientEdit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // Update the client
    public function update(UpdateClientRequest $request, Client $client) // Make sure to create UpdateClientRequest
    {
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete the client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
