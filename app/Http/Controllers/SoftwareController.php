<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Software;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $softwares = Software::with('category')->get();
        return view('software.index')->with('softwares', $softwares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $category = $request->get('category', null);
        $category = Category::find($category);
        return view('software.create')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:software',
            'version' => 'required',
            'date_time' => 'required',
            'content' => 'required',
            'icon' => 'required|file',
            'file' => 'required|file',
        ]);
        $software = Software::create($request->toArray());
        if($request->hasFile('icon')) {
            $software->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        if($request->hasFile('file')) {
            $software->addMediaFromRequest('file')->toMediaCollection('file');
        }
        $category = $request->get('category_id');
        return redirect(route('software.index', $category))->with('success', 'Sub Category successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param Software $software
     * @return View
     */
    public function show(Software $software): View
    {
        return view('software.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Software $software
     * @return View
     */
    public function edit(Software $software): View
    {
        return view('software.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Software $software
     * @return RedirectResponse
     */
    public function update(Request $request, Software $software): RedirectResponse
    {
        return back()->with('success', 'Sub Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Software $software
     * @return RedirectResponse
     */
    public function destroy(Software $software): RedirectResponse
    {
        $software->delete();
        return back()->with('success', 'Sub Category successfully deleted');
    }

    public function api()
    {
        return response()->json(Software::with('category')->get());
    }
}
