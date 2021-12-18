<?php

namespace App\Http\Controllers;

use App\Mail\MailConfirm;
use App\Mail\SendContact;
use App\Mail\SendGuest;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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

    public function send_confirmOrder(Request $request){
        $listCart = Cart::content();

        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $datas = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'note' => $request->note,
            'address' => $request->address
        ];

        $total = 0;
        foreach($listCart as $items){
            $total += ($items->qty * $items->price);
        }



        $order = new Order();
        $order->fullname = $datas['name'];
        $order->email = $datas['email'];
        $order->address = $datas['address'];
        $order->phone = $datas['phone'];
        $order->note = $datas['note'];
        $order->total = $total;
        $order->order_status_id = 0;
        $order->save();

        $getId = Order::orderBy('id','desc')->first();

        foreach($listCart as $items){
            $pro = Product::find($items->id);
            $details = new OrderDetail();
            $details->name = $pro->name;
            $details->order_id = $getId->id;
            $details->product_id = $items->id;
            $details->qty = $items->qty;
            $details->price = ($items->qty * $items->price);
            $details->save();
        }


        Mail::to($datas['email'])->send(new MailConfirm($datas));
        if (Mail::failures()) {
            return response('Error', 500);
        } else{
            Cart::destroy();
            return response()->json([
                'status'=>200
            ]);
        }


    }
}
