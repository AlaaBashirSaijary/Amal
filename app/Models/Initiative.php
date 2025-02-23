<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',           // عنوان المبادرة
        'description',     // وصف المبادرة
        'financial_goal',  // الهدف المالي
        'images',          // الصور التوضيحية (مسار الصورة)
        'start_date',      // تاريخ بدء المبادرة
        'end_date',        // تاريخ انتهاء المبادرة
        'category_id',     // التصنيف الذي تنتمي إليه المبادرة
        'is_approved',     // حالة التحقق (تم التحقق أم لا)
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
