<?php

namespace Douyasi\CKEditor\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Validator;

class CKEditorController extends Controller
{

    /**
     * 示例页面
     *
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
     * 针对 CKEditor 所写的图片上传控制器
     *
     * @param  Request $request
     * @return Response
     */
    public function postUploadPicture(Request $request)
    {
        if (config('ckeditor.usingLocalPackageUploadServer', false)) {
            if ($request->hasFile('upload')) {
                //
                $file = $request->file('upload');
                $funcNum = $request->input('CKEditorFuncNum', 0);
                $by = $request->input('by', 'btn_up');  // btn_up 通过按钮上传 drop_up 浏览器拖曳上传
                $data = $request->all();
                $rules = [
                    'upload'    => 'mimes:jpeg,png,gif|max:5120',
                ];
                $messages = [
                    'upload.required' => '必须传入文件',
                    'upload.mimes'    => '文件类型不允许,请上传常规的图片(jpg、png、gif)文件',
                    'upload.max'      => '文件过大,文件大小不得超出5MB',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->passes()) {
                    $realPath = $file->getRealPath();
                    $hash = md5_file($realPath);
                    $destPath = 'uploads/content/';
                    $savePath = $destPath.''.date('Ymd', time());
                    is_dir($savePath) || mkdir($savePath);  //如果不存在则创建目录
                    $name = $file->getClientOriginalName();
                    $ext = strtolower($file->getClientOriginalExtension());
                    $oFile = $hash.'.'.$ext;
                    $fullfilename = '/'.$savePath.'/'.$oFile;  //原始完整路径
                    if ($file->isValid()) {
                        if (in_array($by, ['btn_up', 'drop_or_clipboard_up'])) {
                            $uploadSuccess = $file->move($savePath, $oFile);  //移动文件
                        }
                        $oFilePath = $savePath.'/'.$oFile;
                        $_url = $fullfilename;
                        if ($by === 'drop_or_clipboard_up' || $by === 'btn_up') {  // 拖曳上传或剪切板上传 || 传统表单上传
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
                    }
                }
                $err = $validator->messages()->first();
                $err = $err ? ': '.$err : '';
            }
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'upload failed '. $err .'!',
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
     * 针对 CKEditor 所写的图片浏览控制器
     *
     * @param  Request $request
     * @return Response
     */
    public function getBrowser(Request $request)
    {
        return 'not supported!';
    }

}
