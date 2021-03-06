<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\Data;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        // if (!session()->has("search")) {
        //     session()->put("search", null);
        //     session()->put("trashed", null);
        // }
        // return Inertia::render("Dashboard/Index", [
        //     "filters" => session()->only(["search", "trashed"]),
        //     "datos" => Data::where('number_table','<>', '',)
        //     ->orderByDesc("updated_at")
        //         ->filter(request()->only("search", "trashed"))
        //         ->paginate(20),
        // ]);
        if (!session()->has("search")) {
            session()->put("search", null);
            session()->put("trashed", null);
        }
        return Inertia::render("Dashboard/AffiliatedList", [
            "filters" => session()->only(["search", "trashed"]),
            "datos" => Data::where('name', '<>', '',)
            // ->orderByDesc("updated_at")
            ->orderBy('name')
            ->filter(request()->only("search", "trashed"))
            ->paginate(20),
        ]);
    }

    public function affiliated()
    {
        if (!session()->has("search")) {
            session()->put("search", null);
            session()->put("trashed", null);
        }
        return Inertia::render("Dashboard/AffiliatedList", [
            "filters" => session()->only(["search", "trashed"]),
            "datos" => Data::where('name', '<>', '',)
                // ->orderByDesc("updated_at")
                ->orderBy('name')
                ->filter(request()->only("search", "trashed"))
                ->paginate(20),
        ]);
    }

    public function store(Request $request)
    {
        DB::table('data')->truncate();

        $path1 = $request->file('csv')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        $data = Excel::import(new DataImport, $path);

        return redirect()->route('dashboard.affiliated')->with('success', "Datos Importados!");
    }

    public function export()
    {
        return Excel::download(new DataExport, 'datos.xlsx');
    }

    public function destroy() {
        // Data::truncate();
        Data::where('number_table', '<>', '',)->update(['number_table' => '']);
        return redirect()->route('dashboard.index')->with('success', "Datos Eliminados!");
    }
}
