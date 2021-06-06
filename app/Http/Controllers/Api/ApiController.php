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

            if (empty($reading->created) || empty($reading->deviceid)) {
                continue;
            }

            Reading::create([
                'userid' => $user->id,
                'key' => $reading->key,
                'value' => $reading->value,
                'deviceid' => $reading->deviceid,
                'client_created' => $reading->created,
            ]);

        }

        return response('Upload Successful', 200);
    }

    public function getMyCurrentHomeData()
    {
        date_default_timezone_set('Pacific/Auckland');

        $readingsTmp = Reading::where('userid', Auth::id())
            ->whereRaw("Date(client_created) = '" . date('Y-m-d') . "'")
            ->orderBy('client_created', 'DESC')
            ->get();

        $return = [];
        foreach ($readingsTmp as $reading) {
            $name = $this->getDeviceName($reading->deviceid);

            if (isset($return[$name])) {
                continue;
            }

            $return[$name] = [
                'name' => $name,
                'lastupdated' => date('D, h:i A', strtotime($reading->client_created)),
                'temp' => $reading->value
            ];
        }

        return $return;

    }
}
