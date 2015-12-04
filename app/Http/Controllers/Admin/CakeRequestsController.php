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
    public function create(Request $request)
    {
        $cakeRequest = new CakeRequest();
        return view('admin.cake-requests.create', compact('cakeRequest', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $request->merge(['delivery_timestamp' => date('Y-m-d', strtotime(str_replace('/', '-', $request->get('delivery_timestamp'))))]);

            $validator = (new CakeRequest())->validate($request->all());

            if ($validator->fails()) {
                throw new \Exception('Erro na validação dos dados', 500);
            }

            $cakeRequest = (new CakeRequest())->fill($request->all());

            $urlCakeImage = CakeRequest::uploadCakeImage($request->file('cake_image'));
            if ($urlCakeImage != null) {
                $cakeRequest->cake_image = $urlCakeImage;
            }

            if (! $cakeRequest->save()) {
                throw new \Exception('Não foi possível salvar o pedido', 500);
            }

            DB::commit();
            return redirect('/admin/cake-requests/' . $cakeRequest->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
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

            $request->merge(array('delivery_timestamp' => date('Y-m-d', strtotime(str_replace('/', '-', $request->get('delivery_timestamp'))))));

            $validator = (new CakeRequest())->validate($request->all());

            if ($validator->fails()) {
                throw new \Exception('Erro na validação dos dados', 500);
            }

            $cakeRequest = CakeRequest::put($request->all(), $id);


            $urlCakeImage = CakeRequest::uploadCakeImage($request->file('cake_image'));
            if ($urlCakeImage != null) {
                $cakeRequest->cake_image = $urlCakeImage;
            }

            if (! $cakeRequest->save()) {
                throw new \Exception('Não foi possível salvar o pedido', 500);
            }

            DB::commit();
            return redirect('/admin/cake-requests/' . $id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
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
