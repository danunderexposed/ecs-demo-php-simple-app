<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Utilities\MailChimp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function index(Request $request, MailChimp $mailChimp)
    {
        if(!$user_email = $request->input('user_email')) {
            return response()->json([]);
        }

        $email = $request->input('user_email');
        $full_name = $request->input('user_name');
        if($full_name)
            $name_bits = explode(' ', $full_name, 2);

        $first_name = $name_bits[0];
        $last_name = '';
        if($name_bits[1]) {
            $last_name = $name_bits[1];
        }

        $list_id = '03c64c56c2';

        $result = $mailChimp->post("lists/$list_id/members", [
            'merge_fields' => ['FNAME' => $first_name, 'LNAME' => $last_name],
            'email_address' => $email,
            'status'        => 'subscribed',
        ]);

        if(!$newsletter = $request->input('newsletter')) {
            // Also send to the other list.
            $list_id = 'a989606bb2';

            $result = $mailChimp->post("lists/$list_id/members", [
                'merge_fields' => ['FNAME'=>$first_name, 'LNAME'=>$last_name],
                'email_address' => $email,
                'status' => 'subscribed',
            ]);
        }

    }
}
