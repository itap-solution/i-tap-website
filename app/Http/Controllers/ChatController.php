<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatResponse;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function storeResponse(Request $request)
    {
        $request->validate([
            'service_type' => 'nullable|string|max:255',
            'project_goal' => 'nullable|string|max:255',
            'design_status' => 'nullable|string|max:255',
            'integration_needed' => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:255',
            'additional_message' => 'nullable|string',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile_platform' => 'nullable|string|max:255',
            'mobile_integration' => 'nullable|string|max:255',
            'mobile_design_handling' => 'nullable|string|max:255',
            'mobile_budget_timeline' => 'nullable|string|max:255',
        ]);

        $sessionId = $request->session_id ?? Str::uuid();

        // Check if a record already exists for this session
        $chatResponse = ChatResponse::where('session_id', $sessionId)->first();

        if ($chatResponse) {
            // Update existing record
            $updateData = array_filter([
                'service_type' => $request->service_type,
                'project_goal' => $request->project_goal,
                'design_status' => $request->design_status,
                'integration_needed' => $request->integration_needed,
                'timeline' => $request->timeline,
                'budget' => $request->budget,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile_platform' => $request->mobile_platform,
                'mobile_integration' => $request->mobile_integration,
                'mobile_design_handling' => $request->mobile_design_handling,
                'mobile_budget_timeline' => $request->mobile_budget_timeline,
            ], function($value) {
                return $value !== null && $value !== '';
            });

            // Handle additional_message specially (append to existing)
            if ($request->additional_message) {
                $existingMessage = $chatResponse->additional_message;
                $newMessage = $existingMessage ? $existingMessage . "\n\n" . $request->additional_message : $request->additional_message;
                $updateData['additional_message'] = $newMessage;
            }

            $chatResponse->update($updateData);
        } else {
            // Create new record
            $chatResponse = ChatResponse::create([
                'session_id' => $sessionId,
                'service_type' => $request->service_type,
                'project_goal' => $request->project_goal,
                'design_status' => $request->design_status,
                'integration_needed' => $request->integration_needed,
                'timeline' => $request->timeline,
                'budget' => $request->budget,
                'additional_message' => $request->additional_message,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile_platform' => $request->mobile_platform,
                'mobile_integration' => $request->mobile_integration,
                'mobile_design_handling' => $request->mobile_design_handling,
                'mobile_budget_timeline' => $request->mobile_budget_timeline,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Response saved successfully',
            'data' => $chatResponse
        ]);
    }

    public function getResponses()
    {
        $responses = ChatResponse::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $responses
        ]);
    }
}
