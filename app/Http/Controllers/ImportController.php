<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function showTable()
    {
        return view('dynamic_table');
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $data = [];

        if (($handle = fopen($file->getPathname(), "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }

        return redirect('/dynamic-table')->with('data', $data);

    }
}
