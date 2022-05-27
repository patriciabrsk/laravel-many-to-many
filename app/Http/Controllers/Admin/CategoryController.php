<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ? Recupero i dati dalla view
        $data = $request->all();

        // | Creo una nuova categoria
        $newCategory = new Category();

        // § Inserisco i dati della view nella nuova categoria
        $newCategory->name = $data['name'];
        $newCategory->color = $data['color'];

        // # Salvo la nuova categoria
        $newCategory->save();

        // * Visualizzo la show della categoria creata
        return redirect()->route('admin.categories.show', $newCategory)->with('message', "La categoria $newCategory->name è stata creata con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // ? Recupero i dati dalla view
        $data = $request->all();

        // § Inserisco i dati della view nella categoria da modificare
        $category->name = $data['name'];
        $category->color = $data['color'];

        // # Salvo la nuova categoria
        $category->save();

        return redirect()->route('admin.categories.show', $category)->with('message', "La categoria $category->name è stata modificata con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('deleted-message', "La categoria $category->name è stata eliminata con successo");
    }
}
