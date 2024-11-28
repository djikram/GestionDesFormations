<?php

namespace App\Http\Controllers;
use App\Models\CoursFormation;
use App\Models\ImageFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Courses;
use App\Models\User;
use Carbon\Carbon;

class CoursesController extends Controller
{
    public function showDash()
    {
        $perPage = request()->get('perPage', 10); // Default to 10 items per page
        $evaluatedCourses = Courses::whereHas('evaluations')->get(); // Cours avec des évaluations
        $nonEvaluatedCourses = Courses::doesntHave('evaluations')->get(); // Cours sans évaluations

        return view('dash', compact('evaluatedCourses', 'nonEvaluatedCourses'));
    }
    public function indexcourse()
    {
    //     $courses = DB::table('courses')
    // ->join('users', 'courses.formateur', '=', 'users.id')
    // ->select('courses.*', 'users.username')
    // ->get();
    // return view('courses', ['courses' => $courses]);

    // $courses = Courses::with('formateurs',)->get();

    // return view('courses', ['courses' => $courses]);

    $coursesCount = Courses::where('modeformation', 'حضوري')->count();
    $distanceCount = Courses::where('modeformation', 'عن بعد')->count();
    $courses = Courses::with(['formateurs', 'personnels', 'coursFiles', 'imageFiles'])->get();

    // Pass counts and courses data to the view
    return view('courses', compact('coursesCount', 'distanceCount', 'courses'));

    }
    public function addcourse()
    {
        $formateurs = User::where('role', 'Formateur')->get();
        $personnels = User::where('role', 'Personnel')->get();
        return view('addcourse', compact('formateurs','personnels'));
    }
    public function editcourse($id){
        $course = Courses::find($id);
        if (!$course) {
            return redirect()->route('Courses')->with('error', 'Course not found.');
        }
        $formateurs = User::where('role', 'Formateur')->get();
        $personnels = User::where('role', 'Personnel')->get();
        $selectedFormateurs = DB::table('formateurformation')
            ->where('idFormation', $id)
            ->pluck('idUser')
            ->toArray();
        $selectedPersonnels = DB::table('personelleformation')
            ->where('idFormation', $id)
            ->pluck('idUser')
            ->toArray();
        $coursFiles = DB::table('coursformation')->where('idFormation', $id)->get();
        $imagesFiles = DB::table('imageformation')->where('idFormation', $id)->get();
        return view('editcourse', [
            'course' => $course,
            'formateurs' => $formateurs,
            'selectedFormateurs' => $selectedFormateurs,
            'personnels' => $personnels,
            'selectedPersonnels' => $selectedPersonnels,
            'coursFiles' => $coursFiles,
            'imagesFiles' => $imagesFiles
        ]);


        // $course = DB::table('courses')->where('id', $id)->first();
        // $formateurs = DB::table('users')->where('role', 'Formateur')->get();
        // $personnels = DB::table('users')->where('role', 'Personnel')->get(); // Fetch personnels
        // return view('editcourse', ['course' => $course, 'formateurs' => $formateurs, 'personnels' => $personnels]);
    }

    //Ajouter
    public function createcourse(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'formateur' => 'required|array', // Formateurs multiples requis
        'personnel' => 'required|array',  // Validate the selected personnel
        'datedebut' => 'nullable|date',
        'datefin' => 'nullable|date|after_or_equal:datedebut',
        'modeformation' => 'required|string',
        'groupecible' => 'required|string',
        // 'nbrBenefi'=> 'required|int',
        'nbrJours' => 'nullable|int',// Champ pour entrer les jours manuellement
        'nbrcours' => 'nullable|int',
        'organisateur'=> 'nullable|string',
        'cours.*' => 'required|file|mimes:pdf,ppt,pptx,doc,docx,xls,xlsx|max:2048',
        'image.*' => 'required|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
    ]);
    //cours
    $coursPaths = [];
    if ($request->hasFile('cours')) {
        foreach ($request->file('cours') as $file) {
            $filePath = $file->getClientOriginalName();
            $file->move(public_path('courses'), $filePath);
            $coursPaths[] = $filePath; // Ajouter chaque chemin dans le tableau
        }
    }
    //images
    $imagesPaths = [];
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $imagesPaths[] = $fileName;
        }
    }
    // Calculate duration
    $nbrJours = $request->input('nbrJours');
    if (!$nbrJours) {
    $datedebut = $request->input('datedebut');
    $datefin = $request->input('datefin');

    if ($datedebut && $datefin) {
        $nbrJours = Carbon::parse($datedebut)->diffInDays(Carbon::parse($datefin)) + 1;
    } else {
        $nbrJours = 'لم يحدد بعد';
        }
    }

    $formation = DB::table('courses')->insertGetId([
        'name' => $request->input('name'),
        //'formateur' => $request->input('formateur'),
        'datedebut' => $request->input('datedebut'),
        'datefin' => $request->input('datefin'),
        'modeformation' => $request->input('modeformation'),
        'groupecible' => $request->input('groupecible'),
        // 'nbrBenefi' => $request->input('nbrBenefi'),
        'nbrJours' => $nbrJours,
        'nbrcours'=> $request->input('nbrcours'),
        'organisateur' => $request->input('organisateur'),

    ]);
    // Ajout des formateurs multiples dans la table formateurformation
    foreach ($request->input('formateur') as $formateurId) {
        DB::table('formateurformation')->insert([
            'idFormation' => $formation,
            'idUser' => $formateurId,
        ]);
    }
    // Add personnels to personelleformation table
    foreach ($request->input('personnel') as $personnelId) {
        DB::table('personelleformation')->insert([
            'idFormation' => $formation,
            'idUser' => $personnelId,  // Assuming 'idUser' in 'personelleformation' links to the 'users' table
        ]);
    }

    foreach ($coursPaths as $courPath) {
        DB::table('coursformation')->insert([
        'idFormation' => $formation,
        'name' => $courPath,
    ]);
    }

    foreach ($imagesPaths as $imagePath) {
        DB::table('imageformation')->insert([
            'idFormation' => $formation,
            'name' => $imagePath,
        ]);
    }

    return redirect()->route('Courses')->with('success', 'Formation ajoutée avec succès.');
}

public function destroy($id)
{
    $course = Courses::findOrFail($id);
    $course->delete();
    return redirect()->route('Courses')->with('success', 'Course deleted successfully.');
}
    public function edit($id)
{
    $course = Courses::find($id);
    if (!$course) {
        return redirect()->route('Courses')->with('error', 'Course not found.');
    }

 // Récupérer les formateurs du cours via la table `formateurformation`
    $selectedFormateurs = DB::table('formateurformation')
    ->where('idFormation', $id)
    ->pluck('idUser')
    ->toArray();

    $formateurs = DB::table('users')->where('role', 'Formateur')->get();

    $personnels = DB::table('users')->where('role', 'Personnel')->get(); // Get all personnel

    $selectedPersonnels = DB::table('personelleformation')
        ->where('idFormation', $id)
        ->pluck('idUser')
        ->toArray();

    $coursFiles = DB::table('coursformation')->where('idFormation', $id)->get();
    $coursFiles = $course->files;

    $imagesFiles = DB::table('imageformation')->where('idFormation', $id)->get();
    $imagesFiles = $course->files;

    dd($selectedFormateurs);
    dd($selectedPersonnels);
    return view('editcourse', ['course' => $course,'formateurs' => $formateurs,'selectedFormateurs' => $selectedFormateurs,'personnels' => $personnels,'selectedPersonnels' => $selectedPersonnels,
'coursFiles' => $coursFiles,'imagesFiles' => $imagesFiles]);
}
public function update(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'formateur' => 'required|array',
        'personnel' => 'required|array',
        'datedebut' => 'nullable|date',
        'datefin' => 'nullable|date|after_or_equal:datedebut',
        'modeformation' => 'required|string',
        'groupecible' => 'required|string',
        'nbrJours' => 'nullable|int',
        'nbrcours'=> 'nullable|int',
        'organisateur' => 'nullable|string',
        'cours.*' => 'nullable|file|mimes:pdf,ppt,pptx,doc,docx,xls,xlsx|max:2048',
        'image.*' => 'required|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
    ]);

    // Récupérer le cours existant
    $course = DB::table('courses')->where('id', $request->id)->first();
    if (!$course) {
        return redirect()->route('Courses')->with('error', 'Course not found.');
    }

    DB::table('formateurformation')->where('idFormation', $course->id)->delete();
    foreach ($request->input('formateur') as $formateurId) {
    DB::table('formateurformation')->insert([
        'idFormation' => $course->id,
        'idUser' => $formateurId,
    ]);
    }
// Remove old personnels and insert new ones
DB::table('personelleformation')->where('idFormation', $course->id)->delete();
foreach ($request->input('personnel') as $personnelId) {
    DB::table('personelleformation')->insert([
        'idFormation' => $course->id,
        'idUser' => $personnelId,
    ]);
}

    // Supprimer tous les fichiers existants
    $existingFiles = DB::table('coursformation')->where('idFormation', $course->id)->get();
    foreach ($existingFiles as $file) {
        $filePath = public_path('courses/' . $file->name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        DB::table('coursformation')->where('id', $file->id)->delete();
    }
    // Ajouter de nouveaux fichiers téléversés
    if ($request->hasFile('cours')) {
        foreach ($request->file('cours') as $file) {
            $filePath = $file->getClientOriginalName();
            $file->move(public_path('courses'), $filePath);
            // Insérer dans la table `coursformation`
            DB::table('coursformation')->insert([
                'idFormation' => $course->id,
                'name' => $filePath,
            ]);
        }
    }

    // Supprimer toutes les images existantes
    $existingImages = DB::table('imageformation')->where('idFormation', $course->id)->get();
    foreach ($existingImages as $file) {
        $imagePath = public_path('images/' . $file->name);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        DB::table('imageformation')->where('id', $file->id)->delete();
    }
    // Ajouter de nouvelles images téléversées
if ($request->hasFile('image')) {
    foreach ($request->file('image') as $file) {
        $imageName = $file->getClientOriginalName();
        $file->move(public_path('images'), $imageName);

        DB::table('imageformation')->insert([
            'idFormation' => $course->id,
            'name' => $imageName,
        ]);
    }
}
    // Calculer le nombre de jours si nécessaire
    $nbrJours = $request->input('nbrJours');
    if (!$nbrJours) {
        $datedebut = $request->input('datedebut');
        $datefin = $request->input('datefin');
        if ($datedebut && $datefin) {
            $nbrJours = Carbon::parse($datedebut)->diffInDays(Carbon::parse($datefin)) + 1;
        } else {
            $nbrJours = 'لم يحدد بعد';
        }
    }

    // Mettre à jour les informations du cours
    DB::table('courses')->where('id', $request->id)->update([
        'name' => $request->input('name'),
        // 'formateur' => $request->input('formateur'),
        'datedebut' => $request->input('datedebut'),
        'datefin' => $request->input('datefin'),
        'modeformation' => $request->input('modeformation'),
        'groupecible' => $request->input('groupecible'),
        'nbrBenefi' => $request->input('nbrBenefi'),
        'nbrJours' => $nbrJours,
        'nbrcours' => $request->input('nbrcours'),
        'organisateur' => $request->input('organisateur'),
    ]);

    return redirect()->route('Courses')->with('success', 'Course updated successfully!');
}
    //View
    public function show($id)
    {
        // $course = DB::table('courses')
        // ->join('users', 'courses.formateur', '=', 'users.id')
        // ->select('courses.*', 'users.username')
        // ->where('courses.id', $id)
        // ->first();
        $course = DB::table('courses')
        ->where('id', $id)
        ->first();

        $formateurs = DB::table('formateurformation')
        ->join('users', 'formateurformation.idUser', '=', 'users.id')
        ->where('formateurformation.idFormation', $id)
        ->select('users.username')
        ->get();

        // $personnels = DB::table('personelleformation')
        // ->join('users', 'personelleformation.idUser', '=', 'users.id')
        // ->where('personelleformation.idFormation', $id)
        // ->select('users.username')
        // ->get();

    $personnels = DB::table('personelleformation')
    ->join('users', 'personelleformation.idUser', '=', 'users.id')
    ->where('personelleformation.idFormation', $id)
    ->select('users.username', 'users.genre') // Ensure genre is selected
    ->get();

        $coursFiles = DB::table('coursformation')
        ->where('idFormation', $id)
        ->pluck('name');

        $imagesFiles = DB::table('imageformation')
        ->where('idFormation', $id)
        ->pluck('name');


        return view('detailcourse', compact('course','formateurs','personnels', 'coursFiles', 'imagesFiles'));
    }


}
