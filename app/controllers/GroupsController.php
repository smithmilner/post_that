<?php

use Security\Repo\Group\GroupInterface

class GroupsController extends BaseController {

	protected $GroupRepo;

	public function __construct(GroupInterface $GroupRepo)
	{
		$this->GroupRepo = $GroupRepo;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('groups.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @todo  Create group validator
	 *
	 * @return Response
	 */
	public function store()
	{
		// if validator passes
		if (true)
		{
			return $this->GroupRepo->store();
		}
		// Add errors
		return Redirect::back()->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$group = $this->GroupRepo->byId($id);
        return View::make('groups.show')->with('group', $group);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = $this->GroupRepo->byId($id);
        return View::make('groups.edit')->with('group', $group);
	}

	/**
	 * Update the specified resource in storage.
	 * @todo  make a group validator
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// passes validation
		if (true)
		{
			$this->GroupRepo->update($id, Input::all());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->GroupRepo->destroy($id);
		return Redirect::route('groups.index');
	}

}
