<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{

    public function index()
    {
        //abort_if(Gate::denies('view_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::paginate(10);
        trail('View Location', 'Location listing');
        return view('location.index', compact('locations'));
    }

    public function create()
    {
        abort_if(Gate::denies('view_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Create view', 'Create new location form');
        return view('location.create');
    }

    public function store(StoreLocationRequest $request)
    {
        trail('Create location', 'creation of new location');
        $locations = Location::create($request->all());

        flash('location successfully created')->important();
        return redirect()->route('location.index');
    }

    public function show(Location $location)
    {
        //
    }

    public function edit(Location $location)
    {
        //
    }

    public function update(Request $request, Location $location)
    {
        //
    }

    public function destroy(Location $location)
    {
        //
    }
}
