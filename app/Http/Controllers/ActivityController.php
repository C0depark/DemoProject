<?php

namespace App\Http\Controllers;

use App\Models\ActivityModel;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function getGroupedActivities() {
        return json_encode(ActivityModel::getGroupedActivities());
    }
}
