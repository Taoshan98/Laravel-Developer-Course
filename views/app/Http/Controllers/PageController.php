<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    protected $data = [
        [
            "name" => "Nunzio",
            "lastname" => "Marfè",
        ],
        [
            "name" => "Giuseppe",
            "lastname" => "Marfè",
        ],
        [
            "name" => "Francesco",
            "lastname" => "Marfè",
        ]
    ];

    public function about()
    {
        return view('about');
    }

    public function blog()
    {
        return view('blog',
            [
                'imgTitle' => 'Image Blog',
                'imgUrl' => 'https://picsum.photos/300/200',
                'slot' => ''
            ]
        );
    }

    public function staff()
    {

        //$this->data = [];
        return view('staff',
            [
                'title' => 'our staff',
                'staff' => $this->data
            ]
        );

        /*return view('staff')
            ->with('title', "our staff")
            ->with('staff', $this->data);*/

        /*return view('staff')
            ->withTitle("our staff")
            ->withStaff($this->data);*/


        // per me non ha funzionato

        /*$data = $this->data;
        $title = "our staff";

        return view('staff', compact('title', 'data'));*/

    }
}
