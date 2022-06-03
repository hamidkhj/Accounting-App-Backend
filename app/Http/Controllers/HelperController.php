<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class HelperController extends Controller
{
    public function getKarmandInfo(Request $request)
    {
        $url = 'https://roshd.sums.ac.ir/Application/WebServices/Services.asmx?wsdl';
        $params = array(
            'username' => 'internet_dept',
            'password' => 'ZbPmCQ99uRA8',
            'shomareShenasaeiYaCodeMeli' => $request->code
		);

        $context = stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);


        try {
			$soap = new SoapClient($url);

            $response = $soap->KarmandProfile($params);
            // return response()->json($response);
            return $response;

		} catch (\SoapFault $e) {
			// $this->transactionFailed();
			// $this->newLog('SoapFault', $e->getMessage());
			return $e->getMessage();
		}
    }
}
