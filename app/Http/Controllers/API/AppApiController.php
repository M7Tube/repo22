<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CreateInspectionResource;
use App\Http\Resources\HandOver as ResourcesHandOver;
use App\Http\Resources\OneHandOver;
use App\Models\Attrubite;
use App\Models\Document;
use App\Models\HandOver;
use App\Models\InProgressInspection;
use App\Models\ReportCategory;
use App\Models\Selector;
use App\Models\Template;
use App\Models\TextBox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppApiController extends Controller
{
    public function form(Request $request)
    {
        //see the field form XD and validate it
        $request->validate([
            // 'note' => ['required', 'string', 'max:288'],
            // 'images' => ['required'],
            // 'pictureFromSite.*' => ['mimes:png,jpg,jpeg'],
            // 'signture1' => ['required', 'mimes:png,jpg,jpeg'],
            // 'signture1Name' => ['required', 'string', 'max:72'],
            // 'signture2' => ['required', 'mimes:png,jpg,jpeg'],
            // 'signture2Name' => ['required', 'string', 'max:72'],
        ]);
        //store the  images from site
        if (!$request->hasFile('images')) {
            return response()->json([
                'upload file not found' => 'not found'
            ], 400);
        } else {
            $allowedExtension = ['jpg', 'jpeg', 'png'];
            $files = $request->file('images');
            $erros = [];
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedExtension);
                if ($check) {
                    foreach ($files as $mediaFile) {
                        $name = $mediaFile->getClientOriginalName() . Carbon::now();
                        $path = $mediaFile->storeAs('public/images/', $name);
                        //ad_picture
                    }
                    return response()->json([
                        'message' => 'images saved'
                    ], 200);
                } else {
                    return response()->json(['invalid_file_format'], 422);
                }
            }
        }
        return 'true';
        //store the signtures
        // if (!$request->hasFile('signture1')) {
        //     return response()->json([
        //         'status' => 'fails',
        //         'code' => 200,
        //         'message' => 'upload file not found',
        //     ], 200);
        // } else {
        //     $allowedExtension = ['jpg', 'jpeg', 'png'];
        //     $file = $request->file('signture1');
        //     // $erros = [];
        //     $extension = $file->getClientOriginalExtension();
        //     $check = in_array($extension, $allowedExtension);
        //     if ($check) {
        //         $name = $file->getClientOriginalName();
        //         $path = $file->storeAs('public/images', $name);
        //         response()->json([
        //             'status' => 'success',
        //             'code' => 200,
        //             'message' => 'images saved',
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'status' => 'fails',
        //             'code' => 200,
        //             'message' => 'Invalid File Format',
        //         ], 200);
        //     }
        // }
        // if (!$request->hasFile('signture2')) {
        //     return response()->json([
        //         'status' => 'fails',
        //         'code' => 200,
        //         'message' => 'upload file not found',
        //     ], 200);
        // } else {
        //     $allowedExtension = ['jpg', 'jpeg', 'png'];
        //     $file = $request->file('signture2');
        //     // $erros = [];
        //     $extension = $file->getClientOriginalExtension();
        //     $check = in_array($extension, $allowedExtension);
        //     if ($check) {
        //         $name = $file->getClientOriginalName();
        //         $path = $file->storeAs('public/images', $name);
        //         response()->json([
        //             'status' => 'success',
        //             'code' => 200,
        //             'message' => 'images saved',
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'status' => 'fails',
        //             'code' => 200,
        //             'message' => 'Invalid File Format',
        //         ], 200);
        //     }
        // }
        //create the pdf
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

    public function History()
    {
        $inProgress = InProgressInspection::where('value', '!=', null)->paginate(
            25,
            [
                'name', 'desc', 'location', 'date', 'value', 'created_at'
            ],
            'InProgress'
        );
        $Complate = InProgressInspection::where('value', null)->paginate(
            25,
            [
                'name', 'desc', 'location', 'date', 'created_at'
            ],
            'Complate'
        );
        if ($inProgress && $Complate) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'InProgress' => $inProgress,
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
            'location' => ['required', 'string'],
        ]);
        $data = InProgressInspection::Create([
            'name' => $request->name,
            'desc' => $request->desc,
            'date' => $request->date,
            'location' => $request->location,
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

    //
    public function template(Request $request)
    {
        // return $request->template_category;
        $request->validate([
            'template_name' => ['required', 'string', 'max:72'],
            'template_desc' => ['required', 'string', 'max:144'],
            'template_pic' => ['required', 'mimes:png,jpg,jpeg', 'max:10500'],
            'template_user_id' => ['required', 'integer', 'exists:users,user_id'],
            // 'template_category' => ['json'],
        ]);
        $newTemplate = Template::Create([
            'name' => $request->template_name,
            'desc' => $request->template_desc,
            'pic' => $request->file('template_pic')->getClientOriginalName(),
            'user_id' => $request->template_user_id,
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
        //ss
        //first i need to make loop for creating the category
        if (!is_null($request->template_category)) {
            foreach ($request->template_category as $key => $data) {
                $category = ReportCategory::Create([
                    'name' => $data->name,
                    'template_id' => $newTemplate->template_id,
                ]);
                if (!is_null($data->att)) {
                    foreach ($data->att as $key2 => $data2) {
                        $attrubite = Attrubite::Create([
                            'name' => $data2->name,
                            'template_id' => $newTemplate->template_id,
                            'status' => $data2->status,
                            'category_id' => $category->category_id,
                        ]);
                    }
                } else {
                }
                if (!is_null($data->textbox)) {
                    foreach ($data->textbox as $key3 => $data3) {
                        $textbox = TextBox::Create([
                            'name' => $data3->name,
                            'template_id' => $newTemplate->template_id,
                            'category_id' => $category->category_id,
                        ]);
                    }
                } else {
                }
                if (!is_null($data->selector)) {
                    foreach ($data->selector as $key4 => $data4) {
                        $selector = Selector::Create([
                            'name' => $data4->name,
                            'values' => $data4->values,
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
    }

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
        if ($data) {
            $docNo = Document::all()->last();
            if ($docNo) {
                $docNo = $docNo->docNo + 1;
            } else {
                $docNo = 1;
            }
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'Category' => CreateInspectionResource::collection($data),
                    'Doc_No' => $docNo,
                ],
            ], 200);
        }
    }

    public function homepage($perpage)
    {
        $template = Template::filter()->paginate($perpage);
        if ($template) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'template' => $template,
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
}
