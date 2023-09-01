<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\StoreBranchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    public function index()
    {
        $branches = Branch::paginate(15);
        $maker = Auth::user()->id;
        $checker = Auth::user()->id;

        trail('View branch', 'branch listing');
        return view('branch.index', compact('branches', 'maker', 'checker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $this->validate($request, [
           'names' => 'required',
           'code' => 'required',
           'maker',
           'checker'
        ]);

        trail('Create branch', 'create new branch');

       // $code = mt_rand(1000,9999);

        Branch::create([
            'code' => $request->get('code'),
            'names' => $request->get('names'),
            'maker' => $request->get('maker'),
            'checker' => $request->get('checker')
        ]);

        flash('branch created successfully')->important();
        return redirect()->route('branch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
