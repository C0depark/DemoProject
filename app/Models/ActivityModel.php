<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActivityModel extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = 'create_date';

    protected $table = 'tbl_activity';

    protected $fillable = [
        'activity', 'type', 'participants', 'price', 'link', 'key', 'accessibility', 'create_date'
    ];

    public static function getGroupedActivities() {
        return self::query()
            ->selectRaw('type')
            ->selectRaw('MAX(price) as max_price')
            ->selectRaw('ROUND(AVG(price),2) as avg_price')
            ->selectRaw('SUM(participants) as total_participants')
            ->groupBy('type')->get();
    }
}
