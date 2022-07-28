<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\TemplateResource;
use App\Http\Resources\CreateInspectionResource;
use App\Http\Resources\HandOver as ResourcesHandOver;
use App\Http\Resources\OneHandOver;
use App\Models\Attrubite;
use App\Models\DateAndTime;
use App\Models\Document;
use App\Models\HandOver;
use App\Models\InProgressInspection;
use PDF2;
use App\Models\ReportCategory;
use App\Models\Selector;
use App\Models\Template;
use App\Models\TextBox;
use App\Models\VisitType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppApiController extends Controller
{
    //
    public function form(Request $request)
    {
        //see the field form XD and validate it
        $request->validate([
            'note' => ['required', 'string', 'max:1044'],
            'images' => ['required'],
        ]);
        // return $request->obada['name'];
        //store the  images from site
        // if (!$request->hasFile('images')) {
        //     return response()->json([
        //         'status' => 'fails',
        //         'code' => 200,
        //         'message' => 'upload file not found',
        //     ], 200);
        // } else {
        //     $allowedfileExtension = ['pdf', 'jpg', 'png'];
        //     $files = $request->file('images');
        //     $uploadedimages = [];
        //     foreach ($files as $file) {
        //         // return 'a';
        //         $extension = $file->getClientOriginalExtension();
        //         $check = in_array($extension, $allowedfileExtension);
        //         if ($check) {
        //             foreach ($files as $mediaFiles) {
        //                 $name = $mediaFiles->getClientOriginalName();
        //                 $path = $mediaFiles->storeAs('public/images', $name);
        //                 response()->json([
        //                     'status' => 'success',
        //                     'code' => 200,
        //                     'message' => 'images saved',
        //                 ], 200);
        //             }
        //         } else {
        //             return response()->json([
        //                 'status' => 'fails',
        //                 'code' => 200,
        //                 'message' => 'Invalid File Format',
        //             ], 200);
        //         }
        //         array_push($uploadedimages, $file->getClientOriginalName());
        //         response()->json([
        //             'status' => 'success',
        //             'code' => 200,
        //             'message' => 'images saved',
        //         ], 200);
        //     }
        // }
        //store the signtures
        // $uploadedsignture = [];
        // for ($i = 1; $i <= $request->signatureCount; $i++) {
        //     if (!$request->hasFile('signature' . $i)) {
        //         return response()->json([
        //             'status' => 'fails',
        //             'code' => 200,
        //             'message' => 'upload file not found',
        //         ], 200);
        //     } else {
        //         $allowedExtension = ['jpg', 'jpeg', 'png'];
        //         $file = $request->file('signature' . $i);
        //         // $erros = [];
        //         $extension = $file->getClientOriginalExtension();
        //         $check = in_array($extension, $allowedExtension);
        //         if ($check) {
        //             $name = time() . $file->getClientOriginalName();
        //             $path = $file->storeAs('public/images/signture/', $name);
        //             array_push($uploadedsignture, [
        //                 'key' => $request['signatureTitle' . $i],
        //                 'signName' => $request['signatureName' . $i],
        //                 'filename' => $name,
        //             ]);
        //             response()->json([
        //                 'status' => 'success',
        //                 'code' => 200,
        //                 'message' => 'images saved',
        //             ], 200);
        //         } else {
        //             return response()->json([
        //                 'status' => 'fails',
        //                 'code' => 200,
        //                 'message' => 'Invalid File Format',
        //             ], 200);
        //         }
        //     }
        // }
        // return json_decode($request->data)->firstForm;
        // foreach (json_encode($request->data) as $requestData) {
        $data = [
            'first_page' => json_decode($request->data)->firstForm,
            'note' => $request->note,
            'categories' => json_decode($request->data)->categories,
            // 'pictures' => $uploadedimages,
            // 'signutares' => $uploadedsignture,
            // 0 => $request->data[0],
        ];
        // }
        // return $data;
        //create the pdf
        // $info = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        // $files = session()->get('files' . session()->get('LoggedAccount')['email'], []);
        // $request = session()->get('request' . session()->get('LoggedAccount')['email'], []);
        // $data = session()->get('data' . session()->get('LoggedAccount')['email'], []);
        // if (isset($data['data' . session()->get('LoggedAccount')['email']])) {
        //     session()->forget('data' . session()->get('LoggedAccount')['email']);
        //     $data['data' . session()->get('LoggedAccount')['email']] = [
        //         'info' => $info,
        //         'files' => $files,
        //         0 => $request
        //     ];
        // } else {
        //     $data['data' . session()->get('LoggedAccount')['email']] = [
        //         'info' => $info,
        //         'files' => $files,
        //         0 => $request
        //     ];
        // }
        // session()->put('data' . session()->get('LoggedAccount')['email'], $data);
        // return redirect()->route('Exportform');
        /////////////////////////////////////////
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "50000000");
        view()->share('data', $data);
        $pdf = PDF2::chunkLoadView('<html-separator/>', 'apiPDF', $data);
        // $pdf = PDF2::loadView('pdf', $data);
        $output = $pdf->output();
        $name = 'file' . $request->note . time() . rand(1111111111, 9999999999) . '.pdf';
        // storeAs($name, $output);
        Storage::put('pdf/' . $name, $pdf->output());
        // $document = Document::Create([
        // 'docNo' => session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'],
        // 'doc' => $name
        // ]);
        //TODO un comment the 3 line under this
        // session()->forget('Quinfo');
        // session()->forget('files');
        // download PDF file with download method
        // /upload/pdf/Doc.dsfaadfsaffadsewr.pdf
        return $file = 'https://www.c-rpt.com/storage/app/pdf' . '/' . $name;

        // $headers = array(
        //     'Content-Type: application/pdf',
        // );
        // //ssaap
        // return response()->download($file, 'filename.pdf', $headers);
        return $pdf->stream('Report.pdf');
        //store the pdf
        //return the pdf
    }

    public function saveValue(Request $request)
    {
        $request->validate([
            'IPI_id' => ['required', 'integer', 'exists:in_progress_inspections,IPI_id'],
            'value' => ['required'],
        ]);
        $insp = InProgressInspection::find($request->IPI_id);
        if ($insp) {
            $insp->value = $request->value;
            $insp->save();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'Done' => $insp
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Something went wrong',
            ], 200);
        }
    }


    public function inProgressHistory($perpage)
    {
        // s
        $inProgress = InProgressInspection::where('is_complated', 0)->ignoreRequest(['InProgress'])->filter()->paginate(
            $perpage,
            [
                'IPI_id', 'name', 'desc', 'location', 'date', 'doc_no', 'value', 'is_complated', 'created_at'
            ],
            'InProgress'
        );
        if ($inProgress) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'inProgress' => $inProgress
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Something went wrong',
            ], 200);
        }
    }

    public function ComplateHistory($perpage)
    {
        $Complate = InProgressInspection::where('is_complated', 1)->ignoreRequest(['Complate'])->filter()->paginate(
            $perpage,
            [
                'IPI_id', 'name', 'desc', 'location', 'date', 'is_complated', 'created_at'
            ],
            'Complate'
        );
        if ($Complate) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'Complate' => $Complate
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Something went wrong',
            ], 200);
        }
    }

    public function inspection_inprogress(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:96'],
            'desc' => ['string', 'max:192'],
            'date' => ['required', 'date'],
            'doc_no' => ['required', 'integer'],
            'location' => ['required', 'string'],
            'template_id' => ['required', 'integer', 'exists:templates,template_id'],
        ]);
        $questions = ReportCategory::where('template_id', $request->template_id)->with(['att', 'selector', 'textbox'])->get();

        $data = InProgressInspection::Create([
            'name' => $request->name,
            'desc' => $request->desc,
            'date' => $request->date,
            'doc_no' => $request->doc_no,
            'location' => $request->location,
            'value' => $questions,
            'is_complated' => 0,
        ]);
        if ($data) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'InProgress' => $data
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Something went wrong',
            ], 200);
        }
    }
    public function getOnehandover($id)
    {
        $handover = HandOver::find($id);
        if ($handover) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'handOver' => OneHandOver::collection([$handover])
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Data Not Found',
            ], 200);
        }
    }

    public function gethandover($perpage)
    {
        $handovers = HandOver::paginate($perpage);
        if ($handovers) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'handOver' => ResourcesHandOver::collection($handovers)
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Data Not Found',
            ], 200);
        }
    }

    public function handover(Request $request)
    {
        // return 'true';
        $request->validate([
            'note' => ['required', 'string', 'max:1024'],
            'name' => ['required', 'string', 'max:72'],
            'signture1' => ['required', 'mimes:png,jpg,jpeg'],
            'signture1Name' => ['required', 'string', 'max:72'],
            'signture2' => ['required', 'mimes:png,jpg,jpeg'],
            'signture2Name' => ['required', 'string', 'max:72'],
        ]);
        //;
        $lastDocNo = HandOver::all()->last()['Doc_No'];
        if ($lastDocNo) {
            $lastDocNo = $lastDocNo + 1;
        } else {
            $lastDocNo = 1;
        }
        $handOver = HandOver::Create([
            'note' => $request->note,
            'name' => $request->name,
            'signture1' => $request->signture1->getClientOriginalName(),
            'signture1Name' => $request->signture1Name,
            'signture2' => $request->signture2->getClientOriginalName(),
            'signture2Name' => $request->signture2Name,
            'Doc_No' => $lastDocNo,
        ]);
        if (!$request->hasFile('signture1')) {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'upload file not found',
            ], 200);
        } else {
            $allowedExtension = ['jpg', 'jpeg', 'png'];
            $file = $request->file('signture1');
            // $erros = [];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedExtension);
            if ($check) {
                $name = $file->getClientOriginalName();
                $path = $file->storeAs('public/images', $name);
                response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'images saved',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'fails',
                    'code' => 200,
                    'message' => 'Invalid File Format',
                ], 200);
            }
        }
        if (!$request->hasFile('signture2')) {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'upload file not found',
            ], 200);
        } else {
            $allowedExtension = ['jpg', 'jpeg', 'png'];
            $file = $request->file('signture2');
            // $erros = [];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedExtension);
            if ($check) {
                $name = $file->getClientOriginalName();
                $path = $file->storeAs('public/images', $name);
                response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'images saved',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'fails',
                    'code' => 200,
                    'message' => 'Invalid File Format',
                ], 200);
            }
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successfull Request',
            'data' => [
                'handOver' => $handOver
            ],
        ], 200);
    }
    //s
    public function template(Request $request)
    {
        $request->validate([
            'template_name' => ['required', 'string', 'max:72'],
            'template_desc' => ['required', 'string', 'max:144'],
            'template_pic' => ['mimes:png,jpg,jpeg', 'max:10500'],
            'template_with_visit_type' => ['required', 'boolean'],
            'template_instructions' => ['required', 'string', 'max:1440'],
            'template_user_id' => ['required', 'integer', 'exists:users,user_id'],
            // 'template_category' => ['json'],
        ]);
        $newTemplate = Template::Create([
            'name' => $request->template_name ?? '',
            'desc' => $request->template_desc ?? '',
            'pic' => $request->file('template_pic')->getClientOriginalName() ?? '', //'https://c-rpt.com/storage/app/public/images/' .
            'with_visit_type' =>  $request->template_with_visit_type ?? 0,
            'instructions' =>  $request->template_instructions ?? '',
            'signatures' =>  $request->signatures ?? '',
            'user_id' => $request->template_user_id ?? '',
        ]);
        if ($newTemplate) {
            if (!$request->hasFile('template_pic')) {
                return response()->json([
                    'status' => 'fails',
                    'code' => 200,
                    'message' => 'upload file not found',
                ], 200);
            } else {
                $allowedExtension = ['jpg', 'jpeg', 'png'];
                $file = $request->file('template_pic');
                // $erros = [];
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedExtension);
                if ($check) {
                    $name = $file->getClientOriginalName();
                    $path = $file->storeAs('public/images', $name);
                    response()->json([
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'images saved',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'fails',
                        'code' => 200,
                        'message' => 'Invalid File Format',
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'There Is Somthing Wrong',
            ], 200);
        }
        //first i need to make loop for creating the category
        if ($request->template_category) {
            foreach (json_decode($request->template_category) as $key => $data) {
                $category = ReportCategory::Create([
                    'name' => $data->name,
                    'template_id' => $newTemplate->template_id,
                ]);
                if ($data->api->att) {
                    foreach ($data->api->att as $key2 => $data2) {
                        $order = Attrubite::all()->last();
                        if ($order) {
                            $order = $order->order + 1;
                        } else {
                            $order = 1;
                        }
                        $attrubite = Attrubite::Create([
                            'name' => $data2->name,
                            'template_id' => $newTemplate->template_id,
                            'status' => $data2->status,
                            'dateAndTime' => $data2->dateAndTime,
                            'is_required' => $data2->is_required,
                            'category_id' => $category->category_id,
                            'order' => $order,
                        ]);
                        // if (json_decode($data->api->att->dateAndTime)) {
                        //     foreach (json_decode($data->api->att->dateAndTime) as $key5 => $data5) {
                        //         $dateAndTime = DateAndTime::Create([
                        //             'title' => $data5->title,
                        //             'date' => $data5->date,
                        //             'is_required' => $data5->is_required,
                        //             'attrubite_value_key' => $data5->attrubite_value_key,
                        //             'template_id' => $newTemplate->template_id,
                        //             'category_id' => $category->category_id,
                        //             'attrubite_id' => $attrubite->attrubite_id,
                        //         ]);
                        //     }
                        // } else {
                        // }
                    }
                } else {
                }
                if ($data->api->textbox) {
                    foreach ($data->api->textbox as $key3 => $data3) {
                        $textbox = TextBox::Create([
                            'name' => $data3->name,
                            'is_required' => $data3->is_required,
                            'is_number' => $data3->is_number ?? 0,
                            'template_id' => $newTemplate->template_id,
                            'category_id' => $category->category_id,
                        ]);
                    }
                } else {
                }
                if ($data->api->selector) {
                    foreach ($data->api->selector as $key4 => $data4) {
                        $selector = Selector::Create([
                            'name' => $data4->name,
                            'values' => $data4->values,
                            'is_required' => $data4->is_required,
                            'is_multi' => 0,
                            'template_id' => $newTemplate->template_id,
                            'category_id' => $category->category_id,
                        ]);
                    }
                } else {
                }

                if ($data->api->multiselector) {
                    foreach ($data->api->multiselector as $key6 => $data6) {
                        $selector = Selector::Create([
                            'name' => $data6->name,
                            'values' => $data6->values,
                            'is_required' => $data6->is_required,
                            'is_multi' => 1,
                            'template_id' => $newTemplate->template_id,
                            'category_id' => $category->category_id,
                        ]);
                    }
                } else {
                }
            }
        } else {
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successfull Request',
        ], 200);
        //done !
    }
    //dsfaewqr
    public function inspection($id)
    {
        $request = [
            'template_id' => $id
        ];
        $validator = Validator::make($request, [
            'template_id' => ['required', 'integer', 'exists:templates,template_id']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'Wrong Data',
            ], 200);
        }
        $data = ReportCategory::where('template_id', $id)->with(['att', 'selector', 'textbox'])->get();
        $template = Template::where('template_id', $id)->first();
        if ($data && $template) {

            $docNo = Document::all()->last();
            if ($docNo) {
                $docNo = $docNo->docNo + 1;
            } else {
                $docNo = 1;
            }
            if ($template->with_visit_type == 1) {
                $visit_type = VisitType::all();
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Successfull Request',
                    'data' => [
                        'Template' => $template,
                        'visit_type' => $visit_type,
                        'Category' => CreateInspectionResource::collection($data),
                        'Doc_No' => $docNo,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Successfull Request',
                    'data' => [
                        'Template' => $template,
                        'visit_type' => [],
                        'Category' => CreateInspectionResource::collection($data),
                        'Doc_No' => $docNo,
                    ],
                ], 200);
            }
        }
    }
    // sfd
    public function homepage($perpage)
    {
        $template = Template::filter()->paginate($perpage);
        if ($template) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'template' => TemplateResource::collection($template)->response()->getData(),
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'There Is Some Thing Wrong',
            ], 200);
        }
    }

    public function NewTemplateTest()
    {
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "50000000");
        // view()->share('data', $data);
        $pdf = PDF2::loadView('pdfTemplate2');
        // $pdf = PDF::loadView('pdf', $data);
        // download PDF file with download method
        $output = $pdf->output();
        // $name = 'upload/Doc.' .session()->get('info', [])['info']['docNo']. '.pdf';
        // file_put_contents($name, $output);
        // Document::Create([
        //     'docNo' => session()->get('info', [])['info']['docNo'],
        //     'doc' => $name
        // ]);
        // //TODO un comment the 3 line under this
        // session()->forget('cart');
        // session()->forget('info');
        // session()->forget('info2');
        return $pdf->download('pdf_file' . rand(111111111, 999999999) . '.pdf');
    }
}
