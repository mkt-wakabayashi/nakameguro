<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class CustomerRegister extends Controller
{
    public function indexTempReg()
    {
        return view('tempreg');
    }

    /**
     * Add temporary customer details before registration
     *
     * 
     */
    public function addTempCustomer(Request $request)
    {
        $email = $request->email;

        $validator = Validator::make($request->all(), [
            'email' => 'required', 'string', 'email', 'max:255', 'unique:customer,email_id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        //Check whether the customer is already requested for registration
        $isExist = DB::table('customer')->where('email_id', $email)->exists();
        if ($isExist) {
            $validator->errors()->add('email', 'すでに登録されているメールアドレスです。');
            return Redirect::back()->withErrors($validator);
        } else {
            $email_left = Str::before($email, '@');
            $email_right = Str::after($email, '@');

            $id = DB::table('customer')->insertGetId(
                ['email_id' => $email, 'email_left' => $email_left, 'email_right' => $email_right]
            );

            //Prefix customer number with SB 
            $customerNumber = 'SB' . str_pad($id, 5, "0", STR_PAD_LEFT);
            $main_reg_link = Str::finish(URL::to('/'), '/') . 'register/' . $customerNumber;
            $affected = DB::table('customer')
                ->where('id', $id)
                ->update(['number' => $customerNumber, 'main_reg_link' => $main_reg_link]);

            //Send register URL to customer
            $data = array('name' => $email_left, "main_reg_link" => $main_reg_link);
            Mail::send('mailbody', $data, function ($message) use ($email, $email_left) {
                $message->to($email, $email_left)
                    ->subject('本登録メールリンク');
                $message->from('secbox@secbox.com', 'Sec Box');
            });

            return redirect()->back()->with('message', '仮登録メールを送信しました。');
        }
    }
}
