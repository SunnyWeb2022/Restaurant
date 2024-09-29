<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booktable;
// use App\Http\Controllers\responce;


class BooktableController extends Controller
{
    
   public function store(Request $resquest)
   {
        // dd($resquest->all());
        $booktable = booktable::create([
            'name' =>$resquest->name,
            'phone' =>$resquest->phone,
            'email' =>$resquest->email,
            'persons' =>$resquest->persons,
            'date' =>$resquest->date,
        ]);

        return response()->json('Successfully Table Book');

    }
}
