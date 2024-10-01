<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        if (empty($request->category)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi kategori terlebih dahulu',
            ]);
        }
        if (empty($request->desc)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi deskripsi terlebih dahulu',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'desc' => 'required|string',
        ], [
            'category.required' => 'Lengkapi kategori terlebih dahulu',
            'category.string' => 'Kategori harus berupa teks.',
            'category.max' => 'Kategori tidak boleh lebih dari 255 karakter.',
            'desc.required' => 'Lengkapi deskripsi terlebih dahulu',
            'desc.string' => 'Deskripsi harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $category = new Category();
        $category->category = $request->category;
        $category->desc = $request->desc;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil disimpan!'
        ]);
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
