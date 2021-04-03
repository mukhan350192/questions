<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function loginMember(Request $request){
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
            $user = DB::table('members')->where('login',$login)->where('password',$password)->first();
            if (!$user){
                $result['message'] = 'Неправильный логин или пароль';
                break;
            }
            $result['success'] = true;
        }while(false);

        return response()->json($result);
    }

    public function answers(Request $request){
        $member_id = $request->input('member_id');
        $question = $request->input('question');
        $correct = $request->input('correct');
        $score = $request->input('score');
        $tour = $request->input('tour');
        $result['success'] = false;

        do{
            if (!$member_id){
                $result['message'] = 'Не передан айди участника';
                break;
            }
            if (!$question){
                $result['message'] = 'Не передан номер вопроса';
                break;
            }
            if (!$correct){
                $result['message'] = 'Не передан корректность вопроса';
                break;
            }
            if (!$score){
                $result['message'] = 'Не передан бал участника';
                break;
            }

            if (!$tour){
                $result['message'] = 'Не передан тур';
                break;
            }


            $ins = DB::table('logs')->insertGetId([
                'member_id' => $member_id,
                'question' => $question,
                'correct' => $correct,
                'score' => $score,
                'tour' => $tour,
            ]);
            if (!$ins){
                $result['message'] = 'Попробуйте позже';
                break;
            }
            $result['success'] = true;
        }while(false);

        return response()->json($result);
    }

    public function getAnswers(Request $request){
        $tour = $request->input('tour');
        $question = $request->input('question');

        $data = DB::table('logs')
            ->join('members','member.id','=','logs.member_id')
            ->select('logs.score','logs.correct','member.name','member.surname')
            ->where('tour',$tour)
            ->where('question',$question)
            ->get();
        return response()->json($data);
    }

}
