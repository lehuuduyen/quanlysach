<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input;
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Book::all();
        return Datatables::of($list)
            ->editColumn('image', function ($data) {
                $domain=url('');


                return "<img width='100%' src='".$domain.$data->image."'>";
            })
            ->editColumn('status', function ($data) {
                $str="<span class='btn btn-success'>Stocking</span>";

                if($data->status==0){
                    $str="<span class='btn btn-danger'>Out of stock</span>";

               }


                return $str;
            })
            ->rawColumns(['image','status'])->make(TRUE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('image')){

            $file = Input::file('image');
            $name=rand(0,100).'_'.strtotime(date('Y-m-d')).'_'.$file->getClientOriginalName();
            $file->move('img',$name );

            $data=$request->all();
            $data['image']='/img/'.$name;

            $kq=Book::create($data);

            return $this->responseSuccess($kq);
        }
        return $this->responseServerError("Hệ thống đang nghẽn, vui lòng quay lại sau");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
