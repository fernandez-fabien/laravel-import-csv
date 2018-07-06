<?php

namespace App\Http\Controllers;

use App\Models\Csv;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('csv.index', [
            'csv' => Csv::paginate()
        ]);
    }
}