<?php
namespace Admin\Controller;
use Think\Controller;

class VerifyController extends Controller{
	/**
	 * [getCode 获取验证码]
	 * @return null
	 */
    public function getCode(){
        $Config = array(
            //'useZh' => true,
            'length' => 3
        );
        $Code = new \Think\Verify($Config);
        $Code->entry();
    }
}