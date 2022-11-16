<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanEnterExamApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $examId = $request->route()->parameter('id');
        $pivotRow = Auth::user()->exams()->where('exam_id', $examId)->first();

        if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
            return response()->json(['message'  => 'I\'ve been to the exam before']);
        }

        return $next($request);
    }
}
