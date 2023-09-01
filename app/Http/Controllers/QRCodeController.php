<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
use File;
use Milon\Barcode\DNS2D;




class QRCodeController extends Controller
{
    public function generateQrCode(Request $request)
    {

     

        // $qrCode = QrCode::size(200)->generate($parcel_id);
        // $path = $qrCode->store('images', 'public');


        // QrCode::size(200)->generate($parcel_id, $path);

        // $qrCode = QrCode::format('png')->size(300)->generate($parcel_id);

        // $image = Image::make($svg)->encode('png');
        // dd($image);

                // $save_data = DB::table('shipments')->where('parcel_id', $parcel_id)
        // ->update([
        // 'qrcode_img' =>$image,
        // ]);
        $parcel_id = $request->input('parcel_id');

        $barcodeType = 'QRCODE';

        $barcode = DNS2D::getBarcodePNG($parcel_id, $barcodeType);
    


        flash()->info('Success, Code Generated successfully');

        return view('collection-process.generate_qrcode', compact('barcode', 'parcel_id'));
    }

    public function generateQRCodePrint(Request $request)
    {


        // Generate the QR code
        $parcel_id = $request->input('parcel_id');

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);

        $qr_image = base64_encode($writer->writeString($parcel_id));
        dd($qr_image);


        $qrCode = $writer->writeString($parcel_id);
        dd($qrCode);

        // Save the QR code image to a file
        $filePath = storage_path('app/public/qrcode.png');
        file_put_contents($filePath, $qrCode);

        // Return the file path or use it as needed
        return $filePath;
    }




}