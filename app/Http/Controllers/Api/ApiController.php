<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    public function handle(Request $request)
    {
        $user = Auth::user();

        if (empty($request->data) || !is_array($request->data)) {
            return abort(401, 'No data to process');
        }

        foreach ($request->data as $reading) {
            $reading = (object) $reading;

            $clientDatabaseCreated = ($reading->created ?? null);
            $clientDeviceId = ($reading->deviceid ?? null);

            if (empty($clientDatabaseCreated) || empty($clientDeviceId)) {
                continue;
            }

            // Remove the 2 fields used for ID/timestamp - rest are readings
            unset($reading->created, $reading->deviceid);

            // Loop over the remaining fields as these are key value readings
            foreach ((array) $reading as $key => $value) {

                Reading::create([
                    'userid' => $user->id,
                    'key' => $key,
                    'value' => $value,
                    'deviceid' => $clientDeviceId,
                    'client_created' => $clientDatabaseCreated,
                ]);
            }
        }

        return response('Upload Successful', 200);
    }
}
