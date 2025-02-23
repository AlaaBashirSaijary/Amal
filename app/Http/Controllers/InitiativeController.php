<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Initiative;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class InitiativeController extends Controller
{
    /**
     * عرض قائمة المبادرات المعتمدة.
     */
    public function index()
    {
        $initiatives = Initiative::with('category')->where('is_approved', true)->get();
        return response()->json(['data' => $initiatives], 200);
    }

    /**
     * عرض تفاصيل مبادرة معينة.
     */
    public function show($id)
    {
        $initiative = Initiative::with('category')->find($id);

        if (!$initiative) {
            return response()->json(['error' => 'المبادرة غير موجودة'], 404);
        }

        return response()->json(['data' => $initiative], 200);
    }

    /**
     * إنشاء مبادرة جديدة.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'financial_goal' => 'required|numeric',
            'images' => 'nullable|image',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $initiative = new Initiative($request->all());
        $initiative->is_approved = false;

        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('public/images');
            $initiative->images = $path;
        }

        $initiative->save();

        return response()->json(['data' => $initiative], 201);
    }

    /**
     * اعتماد مبادرة معينة.
     */
    public function approve($id)
    {
        $initiative = Initiative::find($id);

        if (!$initiative) {
            return response()->json(['error' => 'المبادرة غير موجودة'], 404);
        }

        $initiative->update(['is_approved' => true]);

        return response()->json(['message' => 'تم اعتماد المبادرة بنجاح'], 200);
    }

    /**
     * تحديث مبادرة معينة.
     */
    public function update(Request $request, $id)
    {
        $initiative = Initiative::find($id);

        if (!$initiative) {
            return response()->json(['error' => 'المبادرة غير موجودة'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'financial_goal' => 'sometimes|required|numeric',
            'images' => 'sometimes|nullable|image',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('public/images');
            $initiative->images = $path;
        }

        $initiative->update($request->all());

        return response()->json(['data' => $initiative], 200);
    }

    /**
     * حذف مبادرة معينة.
     */
    public function destroy($id)
    {
        $initiative = Initiative::find($id);

        if (!$initiative) {
            return response()->json(['error' => 'المبادرة غير موجودة'], 404);
        }

        $initiative->delete();

        return response()->json(['message' => 'تم حذف المبادرة بنجاح'], 200);
    }
}
