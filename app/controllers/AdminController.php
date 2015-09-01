<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	  public function __construct()
			  {
			    # code...
			    $this->beforeFilter('admin');
			  }
	public function login()
	{
		
	}
	public function index()
	{
		$products= Products::all();
		return View::make('admin.index',compact('products'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	//Part One
		$file= Input::file('script');
		$filename= Input::file('script')->getClientOriginalName();

		$destinationPath=storage_path().'/files';
		$file->move($destinationPath, $filename);
		//Part Two
		$product= new Products;
		$product->title= Input::get('title');
		$product->description=Input::get('desc');
		$product->price=Input::get('price');
		$product->somethingelse=Input::get('something');
		$product->filename=$filename;
		$product->save();
		//Part Three
		return Redirect::to('admin');
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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
		DB::table('products')->where('id',$id)->delete();
		return Redirect::back();
	}


}
