<?php

return [

    /**
     * disable image upload service by this package? 
     * 是否使用本扩展包提供的本地图片上传组件服务 
     * true: enabled 启用
     * false: disabled 禁用
     */
    'usingLocalPackageUploadServer' => true,

    /**
     * change to your own image upload controller router if `usingLocalPackageUploadServer` set to `false`, otherwise keep as default 
     * 当 `usingLocalPackageUploadServer` 设置为 `false` 时，请指向自己实现的图片上传控制器路由，否则（如未实现），请保持默认值
     */
    'imageUploadUrl' => '/laravel-ckeditor/upload',
];