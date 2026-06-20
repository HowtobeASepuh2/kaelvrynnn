<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectMetric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnalyticsController extends Controller
{
    public function projectDemo(Project $project)
    {
        if (! $project->demo_link) {
            abort(404);
        }

        ProjectMetric::firstOrCreate(['project_id' => $project->id])->increment('demo_clicks');

        return redirect()->away($project->demo_link);
    }

    public function downloadCv()
    {
        $profile = Profile::firstOrFail();

        if (! $profile->cv_file || ! Storage::disk('public')->exists($profile->cv_file)) {
            abort(404);
        }

        $updated = DB::table('site_metrics')->where('key', 'cv_downloads')->increment('value');
        if (! $updated) {
            DB::table('site_metrics')->insert(['key' => 'cv_downloads', 'value' => 1, 'created_at' => now(), 'updated_at' => now()]);
        }

        return Storage::disk('public')->download($profile->cv_file);
    }
}
