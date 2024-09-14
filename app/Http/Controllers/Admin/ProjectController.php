<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->all();
        $queryProject = Project::query();

        if ($request->input('title')) {
            $title = $request->input('title');
            $queryProject->whereHas('translations', function ($q) use ($title) {
                $q->where('name', 'LIKE', "%$title%");
                return $q;
            });
        }
        if ($request->input('type')) {
            $queryProject->where('type', '=', $request->input('type'));
        }

        $projects = $queryProject
            ->orderByDesc('start_date')
            ->paginate(25);

        return view(
            'admin.projects.index',
            compact('data', 'projects')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $inputs = request()->validate([
            'name' => 'string|max:255',
        ]);


        $project = new Project();
        $project->translateOrNew('en')->name = $inputs['name'];
        $project->translateOrNew('ro')->name = $inputs['name'];
        $project->translateOrNew('ru')->name = $inputs['name'];
        $project->save();


        return redirect()->route('admin.projects.edit', $project->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        return view(
            'admin.projects.edit',
            compact('project')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'ro_name' => 'required|string',
            'ru_name' => 'string|nullable',
            'en_name' => 'string|nullable',
            'ro_funder' => 'string|nullable',
            'ru_funder' => 'string|nullable',
            'en_funder' => 'string|nullable',
            'ro_content' => 'string|nullable',
            'ru_content' => 'string|nullable',
            'en_content' => 'string|nullable',
            'start_date' => 'string|nullable',
            'end_date' => 'string|nullable',
            'budget' => 'integer|nullable',
        ]);


        // Update translations
        $project->translate('ro')->update([
            'name' => $request->input('ro_name'),
            'content' => $request->input('ro_content'),
            'funder' => $request->input('ro_funder'),
        ]);

        $project->translate('en')->update([
            'name' => $request->input('en_name'),
            'content' => $request->input('en_content'),
            'funder' => $request->input('en_funder'),

        ]);

        $project->translate('ru')->update([
            'name' => $request->input('ru_name'),
            'content' => $request->input('ru_content'),
            'funder' => $request->input('ru_funder'),

        ]);

        // Update other project fields if needed
        $project->update([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'budget' => $request->input('budget'),
            'active' => 1
        ]);

        return redirect()->route('admin.projects');
    }


    public function changeStatus(Project $project)
    {
        $project->update(['active' => !$project->active]);

        return back();
    }


    public function destroy(Project $project, Request $request)
    {
        DeleteImage::delete($project);

        $project->delete();
        $request->session()->flash('deleted', 'Proiectul cu id-ul: ' . $project->id . ' a fost ștearsă.');

        return back();
    }

    public function storeImageGeneral(Request $request, Project $project)
    {
        // Validate the uploaded file
        $request->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        // Retrieve the uploaded file
        $file = $request->file('picture');

        // Create an Intervention Image instance
        $image = Image::make($file);

        // Resize the image (e.g., to a width of 800px and auto height)
        $image->resize(410, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintain the aspect ratio
            $constraint->upsize(); // Prevent upsizing if the image is smaller
        });

        // Generate a filename and delete the old file if it exists
        $extension = $file->extension();
        $filename = time();
        Storage::delete('public/' . $project->picture);

        // Save the resized image to the storage
        $image->save(storage_path('app/public/projects/' . $filename . '.' . $extension));

        // Prepare the inputs for updating the project
        $inputs['picture'] = 'projects/' . $filename . '.' . $extension;

        // Update the project
        $project->update($inputs);

        // Return the URL of the stored image
        echo asset('storage/' . $inputs['picture']);
    }


    public function deleteImageGeneral(Project $project)
    {
        DeleteImage::delete($project);
        return back();
    }
}
