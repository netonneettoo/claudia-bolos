<?php

namespace App\Http\Controllers\Admin;

use App\CakeRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CakeRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cake-requests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cakeRequest = new CakeRequest();
        return view('admin.cake-requests.create', compact('cakeRequest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->file('cake_image'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cakeRequest = CakeRequest::find($id);
        if ($cakeRequest == null) {
            return redirect()->back();
        }
        return view('admin.cake-requests.show', compact('cakeRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cakeRequest = CakeRequest::find($id);
        if ($cakeRequest == null) {
            return redirect()->back();
        }
        return view('admin.cake-requests.edit', compact('cakeRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $validator = (new CakeRequest())->validate($request->all());
            if ($validator->fails()) {
                throw new \Exception('Erro na validação dos campos', 500);
            }

            //$cakeRequest = (new CakeRequest());

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            //
        }

        dd($request->file('cake_image')->getClientOriginalExtension());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
