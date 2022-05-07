<?php

namespace App\Http\Controllers\API\CONTROL;

use App\Http\Controllers\Controller;
use App\Models\Attrubite;
use App\Models\ReportCategory;
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
        //
        $data = ReportCategory::paginate();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfully Request',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 400,
                'message' => 'There Is Some Problem',
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:72'],
            'template_id' => ['required', 'integer', 'exists:templates,template_id'],
        ]);
        return ReportCategory::Create([
            'name' => $request->name,
            'template_id' => $request->template_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = ReportCategory::find($id);
        if ($data) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfully Request',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 400,
                'message' => 'There Is Some Problem',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:3'],
        ]);
        return $request->name;
        $category = ReportCategory::find($id);
        $category->name = $request->name;
        $category->save();
        // $category->update(['name' => $request->name]);
        return response()->json([
            'message' => 'Category Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportCategory $reportCategory)
    {
        Attrubite::where('category_id', $reportCategory)->delete();
        return ReportCategory::where($reportCategory)->delete();
    }
}
