<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function download($filename)
    {
        $path = public_path('storage/response_pdfs/' . $filename);
        return response()->download($path);

        // if (!Storage::exists($path)) {
        //     abort(404);
        // }
        
        // return Storage::download($path);
    }

    // public function download($courseId){
    //     try{

    //         $filePath = public_path("storage/course_files/{$course->file}");

    //         if (file_exists($filePath)) {
    //             $filename = $course->title . '.pdf';

    //             $headers = [
    //                 'Content-Type' => 'application/pdf',
    //             ];

    //             return response()->download($filePath, $filename, $headers);
    //         } else {
    //             return redirect()->route('courses.index')->with('error', 'PDF file not found.');
    //         }

    //     }catch(\Exception $e){
    //         Log::error('Error while downloading file: '. $e->getMessage());
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
        
    // }
}
