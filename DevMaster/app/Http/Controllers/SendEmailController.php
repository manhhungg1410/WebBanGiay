<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Mail\SendGuest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send_contact(Request $request){
        $request->validate([
           'name' => 'required|min:5',
            'email' => 'required|email',
                'phone' => 'required',
            'msg' => 'required'
        ]);

        $datas = [
          'name' => $request->name,
          'phone' => $request->phone,
          'email' => $request->email,
          'content' => $request->msg,
        ];


        $contact = new Contact();
        $contact->name = $datas['name'];
        $contact->email = $datas['email'];
        $contact->phone = $datas['phone'];
        $contact->content = $datas['content'];
        $contact->status = 0;
        $contact->save();

        Mail::to($datas['email'])->send(new SendContact($datas));
        if (Mail::failures()) {
            return response('Error', 500);
        } else{
            return response('success',200);
        }

    }

    public function send_guest(Request $request){
        $request->validate([
            'msg' => 'required'
        ]);

        $id = $request->id;

        $findContact = Contact::find($id);

        $datas = [
            'name' => $findContact->name,
            'email' => $request->email,
            'msg' => $request->msg,
        ];


        Mail::to($datas['email'])->send(new SendGuest($datas));
        if (Mail::failures()) {
            return response('Error', 500);
        } else{
            if($findContact->status==0){
                $findContact->status=1;
                $findContact->save();
            }
            return response('success',200);
        }
    }
}
