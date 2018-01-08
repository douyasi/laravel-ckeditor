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

}
