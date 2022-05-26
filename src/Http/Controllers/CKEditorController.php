<?php

namespace Douyasi\CKEditor\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Validator;

class CKEditorController extends Controller
{

    /**
     * ExamplePage
     * 示例页面
     *
     * @param  string $mode
     * @return Response
     */
    public function getExample($mode = 'basic')
    {
        if (config('app.debug', false)) {
            if (in_array($mode, ['basic', 'standard', 'full', 'customized'])) {
                return view('ckeditor::example', ['mode' => $mode]);
            } else {
                return abort(404);
            }

        } else {
            return 'You can see the example page only in DEBUG mode!';
        }
    }

    /**
     * Image Upload for CKEditor Controller
     * 针对 CKEditor 所写的图片上传控制器
     *
     * @param  Request $request
     * @return Response
     */
    public function postUploadPicture(Request $request)
    {
        if (config('ckeditor.usingLocalPackageUploadServer', false)) {
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $funcNum = $request->input('CKEditorFuncNum', 0);
                // btn_up : upload by form btn 通过表单按钮上传
                // drop_up: upload by drop/drag to browser 浏览器拖曳上传
                // clipboard_up: upload by clipboard/screen shot 截屏到剪切板上传
                $by = $request->input('by', 'btn_up');
                $data = $request->all();
                $rules = [
                    'upload'    => 'mimes:jpeg,png,gif|max:5120',
                ];
                $messages = [
                    'upload.required' => '请传入文件(a file is required)',
                    'upload.mimes'    => '请上传常规的图片文件(please upload a normal picture file with jpg, png & gif formats)',
                    'upload.max'      => '文件过大,请少于5MB(file size too large,be less than 5MB)',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->passes()) {
                    $realPath = $file->getRealPath();
                    $hash = md5_file($realPath);
                    $destPath = 'uploads/content/';
                    $savePath = $destPath.''.date('Ymd', time());
                    is_dir($savePath) || mkdir($savePath);
                    $name = $file->getClientOriginalName();
                    $ext = strtolower($file->getClientOriginalExtension());
                    $oFile = $hash.'.'.$ext;
                    $fullFileName = '/'.$savePath.'/'.$oFile;
                    if ($file->isValid()) {
                        if (in_array($by, ['btn_up', 'drop_or_clipboard_up'])) {
                            $uploadSuccess = $file->move($savePath, $oFile);
                        }
                        $oFilePath = $savePath.'/'.$oFile;
                        $_url = $fullFileName;
                        return response()->json([
                            'uploaded' => 1,
                            'fileName' => $name,
                            'url' => $_url,
                        ]);
                        /*
                        if ($by === 'drop_or_clipboard_up' || $by === 'btn_up') {
                            return response()->json([
                                'uploaded' => 1,
                                'fileName' => $name,
                                'url' => $_url,
                            ]);
                        } else {
                            return response()->json([
                                'uploaded' => 0,
                                'error' => [
                                    'message' => 'upload with wrong way and config!',
                                ]
                            ]);
                        }
                        */
                    }
                }
                $err = $validator->messages()->first();
                $err = $err ? ': '.$err : '';
            }
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'upload failed'. $err .'!',
                ]
            ]);
        }
        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'upload not allowed!',
            ]
        ]);
    }


    /**
     * Image Browser for CKEditor Controller
     * 针对 CKEditor 所写的图片浏览控制器
     *
     * not supported|暂不支持
     * 
     * @param  Request $request
     * @return Response|string
     */
    public function getBrowser(Request $request)
    {
        return 'not supported!';
    }

}
