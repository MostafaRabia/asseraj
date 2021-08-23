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
            'age' => 'العمر',
            'languages' => 'اللغة',
            'gender' => 'النوع',
            'country' => 'الدولة',
            'state' => 'المحافظة',
            'city' => 'المدينة',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الموبايل',
            'section' => 'القسم',
            'reads_save' => 'القراءة / الرواية',
            'information' => 'معلومات',
        ];
        foreach($arr as $key=>$value){
            $data[$value] = $r->{$key};
        }
        $data['الرقم التسلسلي'] = $created->id;

        ContactUs::create([
            'name' => $create['first_name'].' '.$create['last_name'],
            'email' => $create['email'],
            'phone' => $create['phone'],
            'subject' => 'تسجيل معلم جديد',
            'message' => 'تسجيل معلم جديد',
            'data' => $data,
        ]);

        return response()->json(['status' => 'done']);
    }
}
