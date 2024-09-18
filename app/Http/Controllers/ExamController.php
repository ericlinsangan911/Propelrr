<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function index()
    {
        $position = '';
        return view('exam.fibonacci',['position' => $position]);
    }

   
    public function calculate(Request $request)
    {
        $request->validate([
            'position' => 'required|integer|between:1,20',
        ]);

        $position = $request->input('position');
        $fibonacciNumber = $this->getFibonacci($position);

        return view('exam.fibonacci', ['fibonacciNumber' => $fibonacciNumber, 'position' => $position]);
    }

    private function getFibonacci($n)
    {
        if ($n < 1 || $n > 20) {
            return 'Input must be between 1 and 20.';
        }
    
        $a = 0;
        $b = 1;
        $sequence = [$a];
    
        for ($i = 1; $i < $n; $i++) {
            $sequence[] = $b;
            $temp = $b;
            $b = $a + $b;
            $a = $temp;
        }
    
        return implode(', ', $sequence);
    }

    public function sortIndex()
    {   
        $sortedIds = [];
        return view('exam.constructor', ['sortedIds' => $sortedIds]);
    }

    public function sortIds(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);
        $ids = array_map('intval', explode(',', $validated['ids']));
        $sortedIds = $this->examService->bubbleSort($ids);

        return view('exam.constructor', ['sortedIds' => $sortedIds]);
    }

    public function form()
    {   
        return view('exam.form');
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|regex:/^[a-zA-Z\s,.]+$/',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^09\d{9}$/',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $dob = new \DateTime($request->input('dob'));
        $today = new \DateTime();
        $age = $today->diff($dob)->y;
        User::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'dob' => $request->input('dob'),
            'age' => $age,
            'gender' => $request->input('gender'),
        ]);

        return response()->json(['success' => true]);
    }
}
