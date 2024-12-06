<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyBoardSubjectStoreRequest;
use App\Models\StudyBoard;
use App\Models\StudyBoardSubject;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class StudyBoardSubjectContoller extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function StudyBoardSubjectIndex()
    {
        Gate::authorize('study.board.subject.list');
        $data = StudyBoardSubject::all();

        return view('admin.setups.study_board_subject.index', compact('data'));
    }

    public function StudyBoardSubjectAdd()
    {
        Gate::authorize('study.board.subject.create');
        $studyBoards = StudyBoard::where('active_status',1)->get();
        return view('admin.setups.study_board_subject.add',compact('studyBoards'));
    }

    public function StudyBoardSubjectStore(StudyBoardSubjectStoreRequest $request)
    {
        Gate::authorize('study.board.subject.create');
        StudyBoardSubject::create($request->prepareData());

        $notification = array(
            'message' => 'New Study Board Subject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('study.board.subject.index')->with($notification);
    }

    public function StudyBoardSubjectEdit($id)
    {
        Gate::authorize('study.board.subject.updation');
        $studyBoardSubjectId = decrypt($id);
        $studyBoards = StudyBoard::where('active_status',1)->get();
        $editData = StudyBoardSubject::find($studyBoardSubjectId);
        return view('admin.setups.study_board_subject.edit', compact('editData','studyBoards'));
    }

    public function StudyBoardSubjectUpdate(StudyBoardSubjectStoreRequest $request, $id)
    {
        Gate::authorize('study.board.subject.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Study Board Subject data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('study.board.subject.index')->with($notification);
    }

    public function StudyBoardSubjectDelete($id)
    {
        Gate::authorize('study.board.subject.delete');
        $studyBoardSubjectId = decrypt($id);
        $data = StudyBoardSubject::find($studyBoardSubjectId);
        $data->delete();

        $notification = array(
            'message' => 'Study Board Subject Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('study.board.subject.index')->with($notification);
    }

}
