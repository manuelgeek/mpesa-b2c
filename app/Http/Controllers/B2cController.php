<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Validator;
use Log;

class B2cController extends Controller
{
    public function testPay()
    {

        //test purposes only

        //still under development
    	$Amount ='300';
    	$CommandID = 'BusinessPayment';
    	$PartyB = '254724540039';
    	$Remarks = 'Payed well';

    	$response = app('App\Http\Controllers\B2C')->sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks);

    	if ($response) {
    		return $response;
    	}

    	return response()->json(['success' => FALSE, 'message' => 'Error']);
    }


    public function testResponse()
    {
    	$postData =  file_get_contents('php://input');

        file_put_contents('mpesa_log'.rand(10000,999999).'.txt', $postData);

        $request = json_decode($postData,true);

        if ($request['Result']['ResultCode'] == 0) {
        	
       
        	DB::table('transactions')
            ->insert([
                'ResultType' => $request['Result']['ResultType'],
                'ResultCode' => $request['Result']['ResultCode'],
                "ResultDesc" => $request['Result']['ResultDesc'],
                "OriginatorConversationID" => $request['Result']['OriginatorConversationID'],
                "ConversationID" => $request['Result']['ConversationID'],
                "TransactionID" => $request['Result']['TransactionID'],
                "TransactionReceipt" => $request['Result']['ResultParameters']['ResultParameter'][0]['Value'] ,
                "TransactionAmount" => $request['Result']['ResultParameters']['ResultParameter'][1]['Value'] ,
                "B2CWorkingAccountAvailableFunds" => $request['Result']['ResultParameters']['ResultParameter'][2]['Value'] ,
                "B2CUtilityAccountAvailableFunds" => $request['Result']['ResultParameters']['ResultParameter'][3]['Value'] ,
                "TransactionCompletedDateTime" => $request['Result']['ResultParameters']['ResultParameter'][4]['Value'] ,
                "ReceiverPartyPublicName" => $request['Result']['ResultParameters']['ResultParameter'][5]['Value'] ,
                "B2CChargesPaidAccountAvailableFunds" => $request['Result']['ResultParameters']['ResultParameter'][6]['Value'] ,
                "B2CRecipientIsRegisteredCustomer" => $request['Result']['ResultParameters']['ResultParameter'][7]['Value'] ,
                "QueueTimeoutURL" => $request['Result']['ReferenceData']['ReferenceItem']['Value'] ,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]);
        }
        
       
        return "success";

        // return response()->json($request);
    }
}
