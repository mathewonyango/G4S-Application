<?php

namespace App\Http\Controllers;

use App\Timeline;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access_uploads')) {
            return abort(401);
        }

        $uploads = Upload::latest()->paginate();

        return view('uploads.index', compact('uploads'));
    }

    public function downloadSample()
    {
        trail('sample-excel: ', 'download sample file');

        return Response::download(public_path('sample.xlsx'), 'sample.xlsx');
    }


    public function create()
    {
        if (!Gate::allows('perform_uploads')) {
            return abort(401);
        }

        return view('uploads.create');
    }

    public function processUpload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        $file = $request->file('file');

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        if (!Gate::allows('perform_uploads')) {
            return abort(401);
        }

        $path = Storage::putFileAs('uploads', $file, transaction_uniq() . '.' . $extension);

        $upload = Upload::create([
            'name' => $request->get('name', $fileName),
            'file_name' => $path,
            'type' => null,
            'uuid' => uuid(),
            'status' => 'queued',
            'stage' => 'checker-approval',
            'original_file_name' => $fileName,
            'mime_type' => $mimeType,
            'extension' => $extension,
            'disk' => config('filesystems.default'),
            'size' => $fileSize,
            'created_by' => user()->id
        ]);

        trail('upload', 'Uploaded - ' . $upload->name, $upload);

        $upload_id = $upload->id;

        Timeline::create([
            'upload_id' => $upload_id,
            'title' => 'Uploaded',
            'comment' => null,
            'performed_by' => user()->id
        ]);

        ProcessUpload::dispatch($upload);

        if (!session('upload_error_' . $upload_id)) {
            flash()->info('Upload successful, file is being processed in the background')   ;
        }

        session(['upload_error_' . $upload_id => false]);

        return redirect()->route('uploads.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
