<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users($page = 'index')
    {
        $allowedPages = ['index', 'list', 'activity_report'];
        return $this->renderView('users', $page, $allowedPages);
    }

    private function renderView($folder, $page, $allowedPages)
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("admin.$folder.$page");
    }
}