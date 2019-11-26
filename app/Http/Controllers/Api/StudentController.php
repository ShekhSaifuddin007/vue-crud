<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
            Student::query()->latest('id')->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return StudentResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|unique:students,phone',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $data['image'] = $image->store('/profile');
        }

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
     * @param Request $request
     * @param int $id
     * @return StudentResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:students,email,{$id}",
            'phone' => "required|unique:students,phone,{$id}",
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        $student = Student::query()->findOrFail($id);

        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $imageUrl = $image->store('profile');
            Storage::delete($student->image);

            $data['image'] = $imageUrl;
        }

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

    /**
     * @param $field
     * @param $query
     * @return StudentCollection
     */
    public function search($field, $query)
    {
        return new StudentCollection(
            Student::query()->where($field, 'LIKE', "%$query%")->latest()->paginate(10)
        );
    }
}
