<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function addService(Request $req)
    {
        $service = new Service();
        $service->name=$req->input('name');
        $service->price=$req->input('price');
        $service->description=$req->input('description');
        $service->file_path=$req->file('file')->store('services');
        $service->save();
        
        return $service;
    }

    public function list()
    {
        return Service::all();
    }

    public function delete($id)
    {
        $result = Service::where('id',$id)->delete();
        if($result)
        {
            return ['result' => 'Service has been deleted'];
        }else{
            return ['result' => 'Service already deleted'];
        }
    }

    public function userServiceList()
    {
        return Service::all();
    }

    public function singleService($id)
    {
        return Service::find($id); 
    }

    // Update a service's description
    public function updateServiceList(Request $req, $id)
    {
        $req->validate([
            'description' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|string',
        ]);

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->description = $req->input('description');
        $service->name = $req->input('name');
        $service->price = $req->input('price');
        $service->save();

        return response()->json(['message' => 'updated successfully']);
    }

    //Search services
    public function searchService($key)
    {
        return Service::where('name','Like',"%$key%")->get();
    }
}
