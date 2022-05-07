<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HandOver as ResourcesHandOver;
use App\Http\Resources\OneHandOver;
use App\Models\Attrubite;
use App\Models\Document;
use App\Models\HandOver;
use App\Models\ReportCategory;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppApiController extends Controller
{

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
        $handOver = HandOver::Create([
            'note' => $request->note,
            'name' => $request->name,
            'signture1' => $request->signture1->getClientOriginalName(),
            'signture1Name' => $request->signture1Name,
            'signture2' => $request->signture2->getClientOriginalName(),
            'signture2Name' => $request->signture2Name,
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
        $request->validate([
            'template_name' => ['required', 'string', 'max:72'],
            'template_desc' => ['required', 'string', 'max:144'],
            'template_pic' => ['required', 'mimes:png,jpg,jpeg', 'max:10500'],
            'template_user_id' => ['required', 'integer', 'exists:users,user_id'],
        ]);
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
                $path = $file->store('public/images');
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

        $template = Template::Create([
            'name' => $request->name,
            'pic' => $name,
            'user_id' => $request->user_id,
        ]);
        if ($template) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Successfull Request',
                'data' => [
                    'created_Template' => $template
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'There Is Somthing Wrong',
            ], 200);
        }
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
        $data = ReportCategory::where('template_id', $id)->with('att', 'selector', 'textbox')->get();
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
                    'Category' => $data,
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
