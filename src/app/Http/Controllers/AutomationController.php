<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    public function store(Request $settings)
    {
        $currentSettings = Automation::find(1);
        $currentSettings->reorder_level = $settings->reorder_level;
        $currentSettings->reorder_amount = $settings->reorder_amount;
        $currentSettings->enabled = $settings->enabled;
        $currentSettings->save();
    }
}
