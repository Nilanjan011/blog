<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
class contactSave extends Controller
{
    public function store(Request $request){
        $request->validate([  
            'email'=>['required','email'],
            'name'=>['required', 'min:3' ,'max:25' ,'string'],
            'mobile'=>'required | numeric | min:10',
            'msg'=>'required | max:200',
        ]);
        
        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->message=$request->msg;
        $contact->mobile=$request->mobile;
        $contact->added_on=date('Y-m-d h:i:s');

        $s=$contact->save();
        if ($s) {
            return back()->with('message','message send suceessfull');
        
        }
    }
}
