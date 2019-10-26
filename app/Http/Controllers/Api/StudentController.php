<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return StudentCollection
     */
    public function index()
    {
        return new StudentCollection(
            Student::query()->latest()->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return StudentResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $student = Student::create($data);

        return new StudentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return StudentResource
     */
    public function show($id)
    {
        return new StudentResource(
            Student::query()->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return StudentResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
//        return $request;
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:students,email,{$id}",
            'phone' => 'required',
            'address' => 'required',
        ]);
        $student = Student::query()->findOrFail($id);

        $student->update($data);

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return StudentResource
     * @throws \Exception
     */
    public function destroy($id)
    {
        $student = Student::query()->findOrFail($id);

        $student->delete();

        return new StudentResource($student);
    }

    public function search($field, $query)
    {
        return new StudentCollection(
            Student::query()->where($field, 'LIKE', "%$query%")->latest()->paginate(10)
        );
    }
}
