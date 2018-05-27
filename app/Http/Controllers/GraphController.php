<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
use App\ToolView;
use App\ToolReview;
use App\ToolQuestion;
use App\ToolAnswer;
use Carbon\Carbon;

class GraphController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData(Request $request) {
        if (!$request->ajax())
            return 'This route must be used ajex';
        if (!$request->has('interval'))
            return 'You must specify an interval';
        
        $months = [ 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' ];
        $data = [];
        $interval = $request->input('interval');
        $tool = $request->input('tool');
        if (!$tool) {
            switch ($interval) {
                case 'year':
                    $data['labels'] = $months;
                    array_splice($data['labels'], date('m'));
                    for ($i = 1; $i <= date('m'); $i++) {
                        $data['views'][$i-1]     = ToolView::whereMonth('created_at', '=', $i)->count();
                        $data['reviews'][$i-1]   = ToolReview::whereMonth('created_at', '=', $i)->count();
                        $data['questions'][$i-1] = ToolQuestion::whereMonth('created_at', '=', $i)->count();
                        $data['answers'][$i-1]   = ToolAnswer::whereMonth('created_at', '=', $i)->count();
                    }
                    break;
                case 'month':
                    for ($i = 1; $i <= date('d'); $i++) {
                        $data['labels'][$i-1]    = (string)$i;
                        $data['views'][$i-1]     = ToolView::whereDay('created_at', '=', $i)->count();
                        $data['reviews'][$i-1]   = ToolReview::whereDay('created_at', '=', $i)->count();
                        $data['questions'][$i-1] = ToolQuestion::whereDay('created_at', '=', $i)->count();
                        $data['answers'][$i-1]   = ToolAnswer::whereDay('created_at', '=', $i)->count();
                    }
                    break;
            }
        } else {
            $tool = Tool::where('slug', $tool)->firstOrFail();
            switch ($interval) {
                case 'year':
                    $data['labels'] = $months;
                    array_splice($data['labels'], date('m'));
                    for ($i = 1; $i <= date('m'); $i++) {
                        $data['views'][$i-1]     = $tool->views()->whereMonth('created_at', '=', $i)->count();
                        $data['reviews'][$i-1]   = $tool->reviews()->whereMonth('created_at', '=', $i)->count();
                        $data['questions'][$i-1] = $tool->questions()->whereMonth('created_at', '=', $i)->count();
                        $data['answers'][$i-1]   = $tool->questionAnswers()->whereMonth('tool_answers.created_at', '=', $i)->count();
                    }
                    break;
                case 'month':
                    for ($i = 1; $i <= date('d'); $i++) {
                        $data['labels'][$i-1]    = (string)$i;
                        $data['views'][$i-1]     = $tool->views()->whereDay('created_at', '=', $i)->count();
                        $data['reviews'][$i-1]   = $tool->reviews()->whereDay('created_at', '=', $i)->count();
                        $data['questions'][$i-1] = $tool->questions()->whereDay('created_at', '=', $i)->count();
                        $data['answers'][$i-1]   = $tool->questionAnswers()->whereDay('tool_answers.created_at', '=', $i)->count();
                    }
                    break;
            }
        }

        return $data;
    }

    public function getTools(Request $request) {
        if (!$request->ajax())
            return 'This route must be used ajex';

        $tools = Tool::publicTools();

        if ($request->has('searchQuery')) {
            $searchColumns = [
                'name'            => 10,
                'slug'            => 9,
            ];
            $tools = $tools->search('*' . $request->input('searchQuery') . '*', $searchColumns, true);
        }

        $tools = $tools->paginate(4);

        return view('partials.graphtools', [ 'tools' => $tools ])->render();
    }
}
