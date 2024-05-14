<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Mail\RecommendationSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    public function welcome()
    {

        return view('welcome');
    }


    public function pdfView(Request $request) {
        $userLanguage = app()->getLocale();

        // Selecting columns dynamically based on the user's language
        $columns = [
            'title_' . $userLanguage . ' as title',
            'subt_' . $userLanguage . ' as subTitle', 
            'ld_' . $userLanguage . ' as licenseDetails',
            'txt_' . $userLanguage . ' as msg',
            'ftxt_' . $userLanguage . ' as footerMsg',
        ];
        $pdfContents = coPdf::select($columns)->limit(1)->get();

        $ipAddress = $request->server('REMOTE_ADDR');
        return view('pdf.order', ['ipAddress' => $ipAddress], ['pdfContents' => $pdfContents]);
    }
    

    public function orderSubmit(Request $request)
    {
        // Validate the form data (add more validation rules as needed)

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'www' => 'nullable|string|max:255',
            'mail_address' => 'required|email|max:255',
            'managing_director' => 'required|string|max:255',
            'app_name' => 'required|string|max:255',
            'logo_no' => 'required|string|max:255',
            'published' => 'required|string',
           'own_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)  // Pass the validation errors to the view
                ->withInput();           // Pass the old input data to the view
        }
        $agencId  = $request->input('image_radio');
        $timestamp = now()->timestamp;
        if($request->image_radio == 'own_logo') {
            $title = $request->input('app_name');
            $screen_logo_filename = Str::slug($title) . '-' . $timestamp . '-app-logo.' . $request->file('own_logo')->getClientOriginalExtension();
            // Move files to upload directory
            $request->file('own_logo')->move(base_path('upload-files/agency/'), $screen_logo_filename);
            $data['app_logo'] = 'upload-files/agency/' . $screen_logo_filename;
            $data['app_no'] = $request->input('logo_no');
            $data['app_name'] = $request->input('app_name');
            $successInfo = agencies::create($data);
            $agencId = $successInfo->id;
        }

        $ipAddress = $request->getClientIp();
        $userLanguage = app()->getLocale();
        $columns = [
            'title_' . $userLanguage . ' as title',
            'subt_' . $userLanguage . ' as subTitle', 
            'ld_' . $userLanguage . ' as licenseDetails',
            'txt_' . $userLanguage . ' as msg',
            'ftxt_' . $userLanguage . ' as footerMsg',
        ];
        $pdfContents = coPdf::select($columns)->limit(1)->get();


        // Generate PDF
        $pdf = PDF::loadView('pdf/order', ['data' => $request->all(), 'ipAddress' => $ipAddress, 'pdfContents' => $pdfContents]);
        $pdfData = $pdf->output();

        $savePath = 'upload-files/order-pdf/';
        $filename = Str::slug($request->input('app_name')) . '-' . $timestamp . '.pdf';
        $pdf->save(base_path($savePath) . $filename);


        $orderData =[
            'company_name' => $request->input('company_name'),
            'street' => $request->input('street'),
            'zip' => $request->input('zip'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'telephone' => $request->input('telephone'),
            'www' => $request->input('www'),
            'mail_address' => $request->input('mail_address'),
            'managing_director' => $request->input('managing_director'),
            'agency_id' => $agencId,
            'ip' => $ipAddress,
            'pdf_url' => $savePath . $filename,
        ];

       $createdOrder =  order::create($orderData);


        // Send email
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new OrderSubmission($request->all(), $pdfData));
        // Send email to user
        $userLanguage = app()->getLocale();
        $messagesData = [
            'title' => __('messages.order', [], $userLanguage),
            'head_title' => __('messages.success', [], $userLanguage),
            'messages' => [
                '1' => __('messages.order_submition_message1', [], $userLanguage),
                '0' => __('messages.thank_you', [], $userLanguage),
            ]
        ];
        Mail::to($request->mail_address)->send(new SuccessMessage($request->all(), $messagesData, $pdfData));
        // show message to blade
        $successMessage = __('messages.info_submission_success', [], $userLanguage);

        return redirect()->back()->with('success', $successMessage);
    }



}
