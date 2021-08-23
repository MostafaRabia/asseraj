<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTeacherRequest;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterTeacherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterTeacherRequest $r)
    {
        $create = $r->validated();
        $create['ip'] = $r->ip();
        $create['is_activated'] = 0;

        $created = User::create($create);
        // event(new Registered($created));
        
        $arr = [
            'first_name' => 'الاسم الأول',
            'last_name' => 'الاسم الأخير',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'gender' => 'الجنس',
            'age' => 'السن',
            'country' => 'البلد',
            'state' => 'المحافظة',
            'city' => 'المدينة',
            'section' => 'القسم',
            'reads_save' => 'قراءات التحفيظ',
            'information' => 'معلومات',
            'languages' => 'اللغة',
        ];
        foreach($arr as $key=>$value){
            $data[$value] = $r->{$key};
        }        

        ContactUs::create([
            'name' => $create['first_name'].' '.$create['last_name'],
            'email' => $create['email'],
            'phone' => $create['phone'],
            'subject' => 'تسجيل معلم جديد',
            'message' => json_encode($data),
            'user_id' => $created->id,
        ]);

        return response()->json(['status' => 'done']);
    }
}
