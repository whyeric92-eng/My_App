<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,xlsx,xls'],
        ]);

        (new UsersImport)->import($request->file('file'));

        Inertia::flash('toast', ['type' => 'success', 'message' => '导入完成']);

        return redirect()->route('dashboard');
    }
}
