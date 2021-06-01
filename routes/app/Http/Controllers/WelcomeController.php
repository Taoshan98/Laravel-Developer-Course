<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(Request $request, $name = "", $lastname = "", $age = 0){

        $lang = $request->input("lang");

        switch ($lang){
            case 'en':
                $langString = "Your lang is english";
                break;
            default:
                $langString = "";
        }

        return "Hello $name $lastname " . ($age !== 0 ? "you are $age old " : " ") . $langString ;
    }
}
