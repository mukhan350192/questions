<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request){
        $login = $request->input('login');
        $password = $request->input('password');
        $result['success'] = false;

        do{
            if (!$login){
                $result['message'] = 'Не передан логин';
                break;
            }
            if (!$password){
                $result['message'] = 'Не передан пароль';
                break;
            }
            $user = User::where('login',$login)->where('password',$password)->first();
            if (!$user){
                $result['message'] = 'Неправильный логин или пароль';
                break;
            }
            $result['success'] = true;
        }while(false);

        return response()->json($result);
    }


    public function addUsers(Request $request){
        $login = $request->input('login');
        $password = $request->input('password');
        $result['success'] = false;
        do{
            if (!$login){
                $result['message'] = 'Не передан логин';
                break;
            }
            if (!$password){
                $result['message'] = 'Не передан пароль';
                break;
            }
            $add = DB::table('members')->insertGetId([
               'login' => $login,
               'password' => $password,
            ]);
            if (!$add){
                $result['message'] = 'Попробуйте позже';
                break;
            }
            $result['success'] = true;
        }while(false);
        return response()->json($result);
    }

    public function startGame(Request $request){
        $start = $request->input('start');
        $result['success'] = false;

        do{
            if (!$start){
                break;
            }
            $st = DB::table('start_game')->where('id',1)->update([
                'status' => 'waiting',
            ]);
            $result['success'] = true;

        }while(false);

        return response()->json($result);
    }


}
