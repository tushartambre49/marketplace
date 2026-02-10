<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Listings\SearchListingsAction;

class SearchController extends Controller
{
    public function index(
        Request $request,
        SearchListingsAction $action
    ) {
        $results = $action->execute($request->all());

        return response()->json($results);
    }
}
