<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IftttActionController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function status()
    {
        return response()->json(['success' => 'success'], 200);
    }
}
