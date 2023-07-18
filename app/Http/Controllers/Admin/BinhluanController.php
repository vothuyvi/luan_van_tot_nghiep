<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Binhluan;
use Illuminate\Http\Request;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $binhluan = Binhluan::with('products')->get();
        return View('admin/qlbinhluan/view')->with(compact('binhluan'));
        // return View('admin/qlbinhluan/view', ['data' => Binhluan::with('products')->orderBy('MaBL', 'ASC')]);
    }
    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $binhluan = Binhluan::find($data['comment_id']);
        $binhluan->Status = $data['comment_status'];
        $binhluan->save();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
