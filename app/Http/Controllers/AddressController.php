<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function createLocation($name, $contact_name, $contact_phone, $address, $note, $postal_code, $latitude, $longitude)
    {
        $url = "https://api.biteship.com/v1/locations";
        $headers = [
            "Authorization" => env('BITESHIP_KEY'),
            "Content-Type" => "application/json"
        ];

        $data = [
            "name" => $name,
            "contact_name" => $contact_name,
            "contact_phone" => $contact_phone,
            "address" => $address,
            "note" => $note,
            "postal_code" => $postal_code,
            "latitude" => $latitude,
            "longitude" => $longitude
        ];

        $response = Http::withHeaders($headers)->post($url, $data);

        // Handle the response as needed
        if ($response->successful()) {
            // Request successful
            $responseData = $response->json();
            // Process the response data
            // ...
        } else {
            // Request failed
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // Handle the error
            // ...
        }
        return $response;
    }

    public function getLocation($id)
    {
        $url = "https://api.biteship.com/v1/locations/{$id}";
        $headers = [
            "Authorization" => env('BITESHIP_KEY')
        ];

        $response = Http::withHeaders($headers)->get($url);

        // Handle the response
        if ($response->successful()) {
            // Request successful
            $responseData = $response->json();

            // Extract the relevant fields from the response
            $name = $responseData["name"];
            $contactName = $responseData["contact_name"];
            $contactPhone = $responseData["contact_phone"];
            $address = $responseData["address"];

            // Further processing or response handling
            // ...
        } else {
            // Request failed
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // Handle the error
            // ...
        }

        return $response;
    }

    public function updateLocation($id, $name, $contact_name, $contact_phone, $address, $note, $postal_code, $latitude, $longitude)
    {
        $url = "https://api.biteship.com/v1/locations/{$id}";
        $headers = [
            "Authorization" => env('BITESHIP_KEY'),
            "Content-Type" => "application/json"
        ];

        $data = [
            "name" => $name,
            "contact_name" => $contact_name,
            "contact_phone" => $contact_phone,
            "address" => $address,
            "note" => $note,
            "postal_code" => $postal_code,
            "latitude" => $latitude,
            "longitude" => $longitude
        ];


        $response = Http::withHeaders($headers)->post($url, $data);

        // Handle the response
        if ($response->successful()) {
            // Request successful
            $responseData = $response->json();

            // Extract the relevant fields from the response
            $name = $responseData["name"];
            $contactName = $responseData["contact_name"];
            $contactPhone = $responseData["contact_phone"];
            $address = $responseData["address"];

            // Further processing or response handling
            // ...
        } else {
            // Request failed
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // Handle the error
            // ...
        }

        return $response;
    }

    public function deleteLocation($id)
    {
        $url = "https://api.biteship.com/v1/locations/{$id}";
        $headers = [
            "Authorization" => env('BITESHIP_KEY')
        ];

        $response = Http::withHeaders($headers)->delete($url);

        // Handle the response
        if ($response->successful()) {
            // Request successful
            $responseData = $response->json();
            // Further processing or response handling
            // ...
        } else {
            // Request failed
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // Handle the error
            // ...
        }


    }

    public function getCouriers()
    {
        $url = "https://api.biteship.com/v1/couriers";

        $response = Http::withHeaders([
            "Authorization" => env('BITESHIP_KEY'),
            "Content-Type" => "application/json"
        ])->get($url);

        // Handle the response
        if ($response->successful()) {
            $couriers = $response->json();
            // Process the couriers data
            // ...
            return response()->json($couriers);
        } else {
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // Handle the error
            // ...
            return response()->json([
                "error" => $errorMessage
            ], $errorCode);
        }
    }

    public function getProvinces()
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json";

        $response = Http::get($url);

        return $response->json();
    }

    public function getRegencies($provinceId)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinceId}.json";

        $response = Http::get($url);

        return $response->json();
    }

    public function getDistricts($regencyId)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$regencyId}.json";

        $response = Http::get($url);

        return $response->json();
    }

    public function getVillages($districtId)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$districtId}.json";

        $response = Http::get($url);

        return $response->json();
    }

    public function getCoordinates($search)
    {
        $apiKey = env('PLACES_API_KEY');

        $url = "https://api.goapi.id/v1/places?api_key={$apiKey}&search={$search}";

        $response = Http::get($url);

        $data = $response->json();

        $latlong = null;

        if ($data['status'] === 'success' && isset($data['data']['results']) && count($data['data']['results']) > 0) {
            $result = $data['data']['results'][0];

            $lng = $result['lng'];
            $lat = $result['lat'];

            $latlong = [
                'lng' => $lng,
                'lat' => $lat,
            ];
        }

        return $latlong;

    }

    public function index()
    {
        $addresses = Address::latest()->get();
        return view('address.index', compact('addresses'));
    }

    public function create()
    {
        return view('address.create');
    }

    public function edit($id)
    {
        $addresses = Address::latest()->get();
        return view('address.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'postal_code' => 'required',
            'regency' => 'required',
            'province' => 'required',
            'note' => 'required',
        ]);

        $lng = "";
        $lat = "";

        $latlong = $this->getCoordinates($request->search_place);

        if($latlong != null) {
            $lng = $latlong['lng'];
            $lat = $latlong['lat'];
        }

        Address::create([
            'name'           => $request->name,
            'contact_name'   => $request->contact_name,
            'contact_phone'  => $request->contact_phone,
            'note'           => $request->note,
            'postal_code'    => $request->postal_code,
            'address'       => $request->address,
            'customer_id'   => Auth::guard('customer')->id(),
            'latitude'  => $lat,
            'longitude' => $lng
        ]);


        return redirect()->route('customer.address');
    }


    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $this->deleteLocation($address->id);
        $address->delete();
        return redirect()->route('customer.address');
    }




}
