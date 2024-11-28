<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Courses;
use App\Models\Theme;
use App\Models\Evaluation;
use App\Models\Competence;

class EvaluationController extends Controller
{

    public function getCompetences($themeId)
    {
        $competences = Competence::where('idTheme', $themeId)->select('id', 'nom')->get();
        return response()->json($competences);
    }

    public function viewEvaluation(Request $request, $courseId)
    {
        $course = Courses::with(['themes.competence.evaluation.user'])->findOrFail($courseId);
        $personnels = $course->personnels;

        $evaluations = Evaluation::where('idFormation', $courseId)
            ->with(['competence.theme', 'user'])
            ->get();

        $selectedPersonnel = $request->get('personnel');

        $filteredEvaluations = $selectedPersonnel
        ? $evaluations->where('user.username', $selectedPersonnel)
        : $evaluations;
            return view('evaluation-view', compact('course', 'personnels', 'filteredEvaluations', 'selectedPersonnel'));//,'themes'
    }
    public function addevaluation($courseId)
    {
        $personnels = DB::table('users')
        ->join('personelleformation', 'users.id', '=', 'personelleformation.idUser')
        ->select('users.id', 'users.username')
        ->distinct()
        ->get();
        $themes = DB::table('theme')
            ->where('idFormation', $courseId)
            ->select('id', 'nom')
            ->get();
        $competences = DB::table('competence')
            ->join('theme', 'competence.idTheme', '=', 'theme.id')
            ->where('theme.idFormation', $courseId)
            ->select('competence.id', 'competence.nom')
            ->get();
        return view('addevaluation', compact('personnels', 'themes', 'competences', 'courseId'));
    }
    //AJOUTER
    public function createevaluation(Request $request, $courseId)
    {
        $request->validate([
            'competence_id' => 'nullable|exists:competence,id',
            'competence_name' => 'nullable|string|max:255',
            'theme_name' => 'nullable|string|max:255',
            'theme_id' => 'nullable|exists:theme,id',
            //'course_id' => 'required|exists:courses,id', // Add this validation
            'user_id' => 'required|exists:users,id',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);
        if (!$request->filled('competence_id') && !$request->filled('competence_name')) {
            return redirect()->back()
                ->withErrors(['competence_id' => 'يجب اختيار مهارة أو إدخال مهارة جديدة.'])
                ->withInput();
        }
        $themeId = $request->input('theme_id') ??
        DB::table('theme')->insertGetId([
            'idFormation' => $courseId,
            'nom' => $request->input('theme_name'),
        ]);
        $competenceId = $request->input('competence_id') ??
        DB::table('competence')->insertGetId([
            'idTheme' => $themeId,
            'nom' => $request->input('competence_name'),
        ]);
        DB::table('evaluation')->insert([
            //'idFormation' => $request->input('course_id'),
            'idFormation' => $courseId,
            'idUser' => $request->input('user_id'),
            'idCompetence' => $competenceId,
            'note' => $request->input('note'),
            'commentaire' => $request->input('commentaire'),
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
        return redirect()->route('evaluation.show', $courseId)->with('success', 'Évaluation créée avec succès.');
    }
    public function addTheme(Request $request, $courseId)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'idCompetence' => 'required|array',
        ]);
        try {
            DB::transaction(function () use ($request, $courseId) {
                $theme = Theme::create([
                    'idFormation' => $courseId,
                    'nom' => $request->input('nom'),
                ]);
                foreach ($request->input('competence') as $competenceName) {
                    Competence::create([
                        'idTheme' => $theme->id,
                        'nom' => $competenceName,
                    ]);
                }
            });
            return redirect()->route('evaluation.show', $courseId)
                ->with('success', 'Thème ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'ajout du thème.']);
        }
    }

    public function submitEvaluation(Request $request, $courseId)
    {
        $request->validate([
            'competence_id' => 'required|exists:competences,id',
            //'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);
        try {
            DB::transaction(function () use ($request, $courseId) {
                Evaluation::create([
                    'idFormation' => $courseId,
                    'idUser' => $request->input('user_id'),
                    'idCompetence' => $request->input('competence_id'),
                    'note' => $request->input('note'),
                    'commentaire' => $request->input('commentaire'),
                ]);
            });
            return redirect()->route('evaluation.show', $courseId)
            ->with('success', 'Évaluation enregistrée avec succès.');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement.']);
        }
    }
    //delete
    public function destroy($id)
    {
        $evaluation = Evaluation::find($id);
        if (!$evaluation) {
            return redirect()->back()->withErrors(['error' => 'Évaluation non trouvée.']);
        }
        $evaluation->delete();
        return redirect()->back()->with('success', 'Évaluation supprimée avec succès.');
    }
    //edit
    public function editevaluation($id)
    {
    $evaluation = Evaluation::with(['competence.theme', 'user'])->find($id);
        if (!$evaluation) {
            return redirect()->back()->withErrors(['error' => 'Évaluation non trouvée.']);
        }
        $personnels = DB::table('users')
        ->join('personelleformation', 'users.id', '=', 'personelleformation.idUser')
        ->where('personelleformation.idFormation', $evaluation->idFormation)
        ->select('users.id', 'users.username')
        ->distinct()
        ->get();
        $themes = DB::table('theme')
        ->where('idFormation', $evaluation->idFormation)
        ->select('id', 'nom')
        ->get();
        $competences = DB::table('competence')
            ->whereIn('idTheme', $themes->pluck('id'))
            ->select('id', 'nom', 'idTheme')
            ->get();
            return view('editevaluation', compact('evaluation', 'personnels', 'themes', 'competences'));
    }
    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'nullable|exists:theme,id',
            'theme_name' => 'nullable|string|max:255',
            'competence_id' => 'nullable|exists:competence,id',
            'competence_name' => 'nullable|string|max:255',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);
        $evaluation = Evaluation::findOrFail($id);

    // Gérer le thème
    $themeId = $request->input('theme_id') ?? Theme::create([
        'idFormation' => $evaluation->idFormation,
        'nom' => $request->input('theme_name'),
    ])->id;

    // Gérer la compétence
    $competenceId = $request->input('competence_id') ?? Competence::create([
        'idTheme' => $themeId,
        'nom' => $request->input('competence_name'),
    ])->id;
    $evaluation->update([
        'idUser' => $request->input('user_id'),
        'idCompetence' => $competenceId,
        'note' => $request->input('note'),
        'commentaire' => $request->input('commentaire'),
    ]);

    return redirect()->route('evaluation.show', $evaluation->idFormation)
        ->with('success', 'Évaluation mise à jour avec succès.');
    }
    //View
    public function show($id)
    {
        $evaluation = Evaluation::with(['competence.theme', 'user'])->find($id);
        if (!$evaluation) {
            return redirect()->back()->withErrors(['error' => 'Évaluation introuvable.']);
        }
        return view('evaluation-view', compact('evaluation'));
    }
    public function showf($courseId)
    {
        $results = DB::table('evaluation')
            ->join('competence', 'evaluation.idCompetence', '=', 'competence.id')
            ->join('theme', 'competence.idTheme', '=', 'theme.id')
            ->where('evaluation.idFormation', $courseId)
            ->select('theme.nom as theme', 'competence.nom as competence')
            ->get();
        return view('evaluation.results', compact('results'));
    }

}
