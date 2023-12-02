<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminContactSuccess;

class AjaxController extends Controller
{
    public function contact(Request $requests)
	{
		$config_email = getOption('email');
		extract($requests->all(), EXTR_OVERWRITE);
		$validator = Validator::make($requests->all(), [
			'name' => 'required',
			'phone' => 'required|numeric|min:10',
			'email' => 'required|email',
		], [
			'name.required' => __('Vui lòng nhập tên!'),
			'phone.numeric' => __('Số điện thoại không đúng định dạng!'),
			'phone.min' => __('Số điện thoại không đúng định dạng!'),
			'phone.required' => __('Vui lòng nhập điện thoại!'),
			'email.email' => __('Địa chỉ email không đúng định dạng!'),
		]);
		if ($validator->fails()) {
			return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
		}
		try{
			$created_at = $updated_at = date('Y-m-d H:i:s');
			$data = [
				'name' => $name ?? '',
				'phone' => $phone ?? '',
				'email' => $email ?? '',
				'content' => $content ?? '',
				'status' => 1,
			];		
			Contact::add($data);
			$message = 'Gửi đăng ký thành công!';
			if (isset($config_email['smtp_email_reply_to']) && ($config_email['smtp_email_reply_to'] != '')) {
                try {
                    $email_admin = $config_email['smtp_email_reply_to'];
                    Mail::to($email_admin)->send(new AdminContactSuccess($data));
                } catch (Exception $e) {
                    \Log::info('Gửi mail yêu cầu thất bại '.$e);                                
                }
            }
			return [
				'status' => 1,
				'message' => $message
			];
		} catch (Exception $e) {
			return [
				'status' => 0,
				'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau!'
			];
		}

	}

    public function huongDanGuiMail(){
        $data = [
            'name' => 'danghuutien',
            'phone' => '12345',
            'email' => 'sadasdsdsa',
            'content' =>  '',
            'status' => 1,
        ];	
        $userEmail = 'user@example.com';
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminContactSuccess($data));
        return 'Email sent successfully!';
    }
}
