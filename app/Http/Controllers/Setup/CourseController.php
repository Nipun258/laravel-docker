<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseEditRequest;
use App\Http\Requests\CourseStoreRequest;
use App\Models\Course;
use App\Models\StudyBoard;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function CourseIndex()
    {
        Gate::authorize('course.list');
        $data = Course::all();

        return view('admin.setups.course.index', compact('data'));
    }

    public function CourseAdd()
    {
        Gate::authorize('course.create');
        $studyBoards = StudyBoard::where('active_status',1)->get();
        $categories = $this->getCategories([3,4,5,7]);
        $courseMediums = $categories->where('category_type_id', '3');
        $courseTypes = $categories->where('category_type_id', '4')->where('category_code', 0);
        $courseTypeExtensions = $categories->where('category_type_id', '5')->where('category_code', 0);
        $courseApplicationOpenMethods = $categories->where('category_type_id', '7');
        return view('admin.setups.course.add',compact('studyBoards','courseMediums','courseTypes','courseTypeExtensions','courseApplicationOpenMethods'));
    }

    public function CourseStore(CourseStoreRequest $request)
    {
        Gate::authorize('course.create');
        Course::create($request->prepareData());

        $notification = array(
            'message' => 'New Course Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('course.index')->with($notification);
    }

    public function CourseEdit($id)
    {
        Gate::authorize('course.updation');
        $courseId = decrypt($id);
        $editData = Course::find($courseId);
        $studyBoards = StudyBoard::where('active_status',1)->get();
        $categories = $this->getCategories([3,4,6,7]);
        $courseMediums = $categories->where('category_type_id', '3');
        $courseTypes = $categories->where('category_type_id', '4');
        $courseMainCategories = $categories->where('category_type_id', '6');
        $courseApplicationOpenMethods = $categories->where('category_type_id', '7');

        return view('admin.setups.course.edit', compact('editData','studyBoards','courseMediums','courseTypes','courseMainCategories','courseApplicationOpenMethods'));
    }

    public function CourseUpdate(CourseEditRequest $request, $id)
    {
        Gate::authorize('course.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Taught course data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('course.index')->with($notification);
    }

    public function CourseShow($id)
    {
        Gate::authorize('course.show');
        $courseId = decrypt($id);
        $data = Course::find($courseId);

        //dd($studyBoardChairPersonDetails);
        return view('admin.setups.course.show', compact('data'));
    }

    public function CourseDelete($id)
    {
        Gate::authorize('course.delete');
        $courseId = decrypt($id);
        $data = Course::find($courseId);
        $data->delete();

        $notification = array(
            'message' => 'Course Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('course.index')->with($notification);
    }
}
