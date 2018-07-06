<?php

namespace App\Http\Controllers;

use App\Models\Csv;
use App\Http\Requests\CsvRequest;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CsvRequest $request)
    {
        $path = $request->file->store('files');
        Csv::create([
            "filename" => $request->file->getClientOriginalName(),
            "filepath" => $path,
            "extension" => $request->file->extension()
        ]);
        return redirect()->route('csv.index')->withSuccess("Your file has been imported");
    }
}