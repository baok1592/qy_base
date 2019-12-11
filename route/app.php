<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;


Route::get('', 'Index/index');

//微信授权获取token
Route::group('auth', function () {
    Route::get('wxcode_url', 'auth.Auth/wxcodeUrl');   //请求公众号code
    Route::post('get_xcx_token', 'auth.Auth/getXcxToken');   //小程序获取用户token
    Route::post('token_verify', 'auth.Auth/verifyToken');   //验证用户token
    Route::get('gzh_token', 'auth.Auth/getToken');   //异步接收公众号code,获取openid，返回token
    Route::post('upinfo', 'auth.Auth/xcx_upinfo');   //更新用户昵称、头像
});

//公共
Route::group('index', function () {

    Route::group('', function () {
        Route::post('/upload/img', 'cms.Common/uploadImg');   //上传图片
        Route::post('/upload/img_id', 'cms.Common/uploadImgID');   //上传图片返还ID
        Route::get('get_refresh', 'common.Task/getRefresh');  //定时任务
        Route::get('/export_excl', 'cms.Common/export_excl');   //导出
    });

    //用户
    Route::group('user', function () {

    });

    //管理员
    Route::group('admin', function () {
        Route::post('login', 'cms.Admin/login');//管理员登录
        Route::get('check_login', 'cms.Common/checkLogin');//管理员检查是否登录
        Route::get('get_code', 'cms.Admin/getCode');//获取验证码


        Route::any('ue_uploads', 'cms.Common/ue_uploads');
    });
});

//图片
Route::group('img_category', function () {
    //公共
    Route::group('', function () {
    });

    //管理员
    Route::group('admin', function () {
        Route::post('add_category', 'cms.ImageManage/addImageCategory');//添加分类
        Route::put('del_category', 'cms.ImageManage/deleteImageCategory');//删除分类
        Route::get('get_category', 'cms.ImageManage/getImageCategory');//获取所有分类
        Route::get('get_all_img', 'cms.ImageManage/getAllImage');//获取所有图片
        Route::post('edit_image', 'cms.ImageManage/editImage');//隐藏图片
        Route::post('/upload/img', 'cms.Common/uploadImg');   //上传图片
    })->middleware('CheckCms');
});

//分组group
Route::group('group', function () {
    //公共
    Route::group('', function () {

    });

    //管理员
    Route::group('admin', function () {
        Route::post('add_group', 'cms.Group/addGroup');//添加文章
        Route::post('edit_group', 'cms.Group/editGroup');//修改文章
        Route::put('del_group', 'cms.Group/deleteGroup');//删除文章
        Route::get('get_all_group', 'cms.Group/getAllGroup');//获取所有的分组
        Route::get('get_one_group', 'cms.Group/getOneGroup');//获取分组详情

    })->middleware('CheckCms');
});

//用户
Route::group('user', function () {

    Route::group('', function () {
        Route::put('/login', 'user.User/userLogin'); //模拟用户登录
    });

    //管理员
    Route::group('admin', function () {
        Route::get('get_all_user', 'cms.UserManage/getAllUser');//获取所有用户信息
    })->middleware('CheckCms');
});

//备份
Route::group('backup', function () {
    Route::get('add_backup', 'cms.Backup/addBackup');//添加备份
    Route::put('del_backup', 'cms.Backup/deleteBackup');//添加备份
    Route::get('get_backup', 'cms.Backup/getBackup');//添加备份
})->middleware('CheckCms');;

//cms管理员
Route::group('cms', function () {

    Route::group('', function () {
        Route::post('/get_config', 'cms.System/GetConfig');   //获取配置信息
        Route::post('/edit_config', 'cms.System/edit_config');  //修改配置信息
        Route::post('/edit_template', 'cms.System/editTemplate');  //修改模板信息
        Route::put('/update', 'cms.Common/upValue');   //更新某模型下的某布尔字段,如上下级架

    });

    Route::group('admin', function () {
        Route::post('edit_psw', 'cms.Admin/editPSW');//管理员修改密码
        Route::post('edit_admin', 'cms.AdminManage/editAdmin');//更新管理员
        Route::post('add_admin', 'cms.AdminManage/addAdmin');//添加管理员
        Route::get('get_all_admin', 'cms.AdminManage/getAdminAll');//获取所有管理员
        Route::put('del_admin', 'cms.AdminManage/deleteAdmin');//删除管理员
        Route::post('set_web_auth', 'cms.AdminManage/setWebAuth');//设置前端管理员
    });
})->middleware('CheckCms');
