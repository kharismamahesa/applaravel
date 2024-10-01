<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Kategori',
        ];
        return view('category', $data);
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
        try {
            // Validasi input dengan pesan error custom
            $request->validate([
                'category' => 'required|string|max:255',
                'desc' => 'required|string|max:255',
            ], [
                'category.required' => 'Lengkapi kategori terlebih dahulu',
                'desc.required' => 'Lengkapi deskripsi terlebih dahulu',
            ]);

            // Jika validasi berhasil, simpan data ke database
            $category = new Category();
            $category->category = $request->category;
            $category->desc = $request->desc;
            $category->save();

            // Kembalikan respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil disimpan!'
            ]);
        } catch (ValidationException $e) {
            // Jika validasi gagal, kembalikan pesan error custom dalam format JSON
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors() // Ambil semua error validasi
            ], 422); // Status 422 untuk Unprocessable Entity
        }
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

    public function getCategoriesData(Request $request)
    {
        $categories = Category::select(['id', 'category', 'desc', 'created_at', 'updated_at']);

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '"><i class="fa fa-edit" ></i></button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash" ></i></button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
