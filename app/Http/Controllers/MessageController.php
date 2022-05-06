<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Models\Message;

class MessageController extends Controller
{
    public function sendToUser(Request $request)
    {
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'user_id' => 'integer|required',
            'content' => 'string|required',
            'title' => 'string|required',
            'sms' => 'boolean|required',
            'email' => 'boolean|required',
            'message' => 'boolean|required',
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'status' => 400];
            return response()->json($response);
        } else {
            $senderID = Auth()->id();
            if($request->message) {
                Message::create([
                    'user_id' => $request->user_id,
                    'sender_id' => $senderID,
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
            }

            if($request->email){
                // send email
            }

            if($request->sms){
                // send sms
            }

            return 'success';
        }
    }

    public function list()
    {
        return Auth()->user()->messages()->with('sender:id,first_name,last_name')->latest()->get();
    }
}
