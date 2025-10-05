<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatResponse extends Model
{
    protected $fillable = [
        'session_id',
        'service_type',
        'project_goal',
        'design_status',
        'integration_needed',
        'timeline',
        'budget',
        'additional_message',
        'name',
        'email',
        'phone',
        'mobile_platform',
        'mobile_integration',
        'mobile_design_handling',
        'mobile_budget_timeline',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
