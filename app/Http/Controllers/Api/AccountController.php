<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'accounts' => Account::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return JsonResponse
     */
    public function store(StoreAccountRequest $request, Account $account)
    {
        $name = $request->input('name');
        $api_key = $request->input('api_key');
        $account->name = $name;
        $account->api_key = $api_key;
        $result = $account->save();

        return response()->json([
            'status' => $result,
            'account' => $account
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
