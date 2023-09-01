<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
class PDFController extends Controller
{
    public function generatePDFReport($parcel_id)
{
    $parcels = DB::table('shipments')->where('parcel_id', $parcel_id)->get();

    // Generate HTML for PDF report
    $html = View::make('collection-process.report', compact('parcels'))->render();

    // Generate PDF file
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('Receipt.pdf');
}

public function GeneralReport(Request $request)
{
    $request->validate([
        'start_date' => 'required',
        'end_date' => 'required',
    ]);

    $startDateTime = Carbon::parse($request->input('start_date'));
    $endDateTime = Carbon::parse($request->input('end_date'));

    $parcels = DB::table('shipments')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

    if ($parcels->isEmpty()) {
        return redirect()->back()->with('error', 'No records available');
    }

    $html = View::make('collection-process.Generalreport', compact('parcels'))->render();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('Receipt.pdf');
}

}
