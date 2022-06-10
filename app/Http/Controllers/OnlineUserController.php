<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineUser;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class OnlineUserController extends Controller
{
    public function userInfo()
    {
        $user = Auth()->user();
        $resutl = OnlineUser::where('user_id', $user->id)->get();
        return response()->json([ 'result' =>$resutl , 'connectionNumber' => $user->connection_number]);
    }


    public function disconnect(OnlineUser $onlineUser)
    {
        $user = Auth()->user();
        if ($onlineUser->user_id != $user->id) {
            return response()->json(['result' => 'fail']);
        }

        $command = "User-Name = ".$user->user_name. ", Acct-Session-Id = ". $onlineUser->acct_session_id. ", Framed-IP-Address = ". $onlineUser->framed_ip_address . " |/usr/bin/radclient -r 1 ".$onlineUser->nas_ip_address.'3799 disconnect 45SumS';
        $process = Process::fromShellCommandline('echo "$command"');

        // /bin/echo "User-Name = $User_Name, Acct-Session-Id = $Acct_Session_Id, Framed-IP-Address = $Framed_IP_Address" |/usr/bin/radclient -r 1 $NAS_IP_Address:3799 disconnect '45SumS'
        return response()->json(['result' => 'success']);
    }
}
