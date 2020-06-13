<?php

namespace App\Http\Controllers\SoftPhone;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Zoho\AuthByPassword;
use Illuminate\Http\Request;

class Auth extends Controller
{
    /**
     * Ответ клиенту.
     * На случай не верного логина или пароля.
     * На случай не верного токена или токена вышедшего по срокам.
     *
     * @param  Request  $request
     * @return string
     */
    public function getAuth(Request $request)
    {
        $out = [
            'error' => true,
            'message'=>$request->get('message')
        ];
        return json_encode($out);
    }

    public function getTest(Request $request)
    {
        echo $_SERVER['HTTP_HOST'];
        // callcentr.wellnessliving.com prod
        //
        print_r($_SERVER);exit();
    }
    /**
     * Авторизация в система. Если успешна - редирект на получение данных по отчету.
     * Если не успешна - редирект на страницу ввода логина и пароля
     *
     * @param  Request  $request
     * @return string
     */
    public function postAuth(Request $request)
    {
        try{

            $o_zoho_pass = new AuthByPassword();
            $s_token = $o_zoho_pass->getToken($request->post('email'));
        }
        catch(\Exception $e)
        {
            return redirect()->action(
                'SoftPhone\Auth@getAuth', ['message' => $e->getMessage()]
            );
        }
        if($s_token)
        {
            try{
                $user = new User();
                $user->getUserByLoginAndPass($request->post('email'),$request->post('password'));
                $user->updateToken($s_token);
            }
            catch(\Exception $e)
            {
                return redirect()->action(
                    'SoftPhone\Auth@getAuth', ['message' => $e->getMessage()]
                );
            }
            return \Redirect::to('/report/missed/'.$user->getToken());
        }
        return redirect()->action(
            'SoftPhone\Auth@getAuth', ['message' => "Please enter correct login and password."]
        );
    }
}
