<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {

        return response()->json([
            'data' => todo::query()->get(),
            'count' => todo::query()
                ->select([DB::raw("(select count(*) from todos) as all_count")
                    ,DB::raw("(select count(*) from todos where is_done=0) as undone_count")
                    ,DB::raw("(select count(*) from todos where is_done=1) as done_count") ])
                ->limit(1)
                ->first(),

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Builder|Model|int
     */
    public function store(Request $request)
    {
        $result = todo::query()->create(['title' => $request->get('title')]);

        return $result ?? 500;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
