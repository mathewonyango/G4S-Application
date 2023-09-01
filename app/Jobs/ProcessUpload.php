<?php

namespace App\Jobs;

use App\Payment;
use App\Upload;
use Faker\Provider\PhoneNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class ProcessUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;
    public $upload;

    /**
     * Create a new job instance.
     *
     * @return Upload $upload
     */
    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::connection()->disableQueryLog();
        $upload = $this->upload;
        $upload_id = $upload->id;
        $total_record_count = 0;
        $access_path = Storage::disk($upload->disk)->path($upload->file_name);
        $upload->update(['status' => 'import-processing', 'total_records' => $total_record_count]);

        $row =(new FastExcel)->import($access_path, function ($line) use ($upload_id) {

            $line = array_change_key_case($line, CASE_LOWER);

            $phone_number = PhoneNumber::make($line['phone_number'])->ofCountry(config('app.phone_validation_country_code'));

            $first_name = @$line['first_name'];
            $last_name = @$line['last_name'];

            return Payment::create([
                'name' => $first_name . ' ' . $last_name,
                'amount' => @$line['amount'],
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone_number' => str_replace('+', '', $phone_number),
                'upload_id' => $upload_id,
            ]);
        });
    }
}
