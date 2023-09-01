<?php

namespace App\Http\Controllers;

use App\Faq;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqsController extends Controller
{
    public function showFaqs(){
//        $faqs = Faq::all();
        $faqs = Faq::orderBy('id', 'DESC')->get();

        return view('faqs.index', compact('faqs'));
    }
    public function createFaqs(){
        return view('faqs.create');
    }
    public function addFaqs(Request $request){
        $question = $request->get('question');
        $answer = $request->get('answer');

        DB::table('faqs')->insert([
            'question' => $question,
            'answer'=> $answer,
            'created_at'=> Carbon::now(),
        ]);
        flash()->info('The FAQ added successfully. ');
        return redirect()->route('faq.show');

    }
    public  function edit($id){
        $faq = Faq::find($id);
        return view('faqs.edit', compact('faq'));
    }
    public  function update(Request $request, $id){
        $data = $request->all();
        $question = $request->get('question');
        $answer = $request->get('answer');

        $faq= Faq::find($id);

        $new_update = DB::table('faqs')
            ->where('id', $id)
            ->update([
                'question' => $question,
                'answer' => $answer,
            ]);
        flash()->info('Update done successful');
        return redirect()->route('faq.show');
    }

    public  function remove($id){
        $faq = Faq::find($id);
        Faq::destroy($id);
        flash()->info('The FAQ plus the answer has been successfully removed from the system');
        return redirect()->route('faq.show');
    }
}
