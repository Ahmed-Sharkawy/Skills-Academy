<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{

    public function index()
    {
        $studentRoul = Role::where('name', 'student')->first();
        $students    =  User::select('id', 'name', 'email', 'email_verified_at')->where('role_id', $studentRoul->id)->paginate(10);;

        return view('admin.student.index', compact('students'));
    }

    public function show(User $user)
    {
        if ($user->role->name == 'student') {
            $user->load('exams');
            return view('admin.student.show', compact('user'));
        }

        return abort(403);
    }

    public function openExam(User $user, Exam $exam)
    {
        $user->exams()->updateExistingPivot($exam->id, ['status'  => 'opened']);
        Toastr::success('Updated Upatus Successfully');

        return redirect()->route('dashboard.student.show', $user->id);
    }

    public function closedExam(User $user, Exam $exam)
    {
        $user->exams()->updateExistingPivot($exam->id, ['status'  => 'closed']);
        Toastr::success('Updated Upatus Successfully');

        return redirect()->route('dashboard.student.show', $user->id);
    }
}
