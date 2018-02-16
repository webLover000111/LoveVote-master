<?php
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadManager {
	private $param;
	private $path;

	public function __construct() {
		$this->param = [
			'status' => false,
			'msg' => '',
			'file_path' => '',
		];
		$this->path = '';
	}
	/*设置存储*/
	public function setPath($path) {
		$this->path = $path;
	}
	/*判断是否为图片类型*/
	public function isImage($mimeType) {
		return starts_with($mimeType, 'image/');
	}
	/*判断是否为视频类型*/
	public function isVideo($mimeType) {
		return starts_with($mimeType, 'video/');
	}
	/*
		    * 产生仅有数字和字母的随机字符串
		    * laravel 的str_random代替这个函数
	*/
	public function randomKeys($length) {
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
		for ($i = 0; $i < $length; $i++) {
			$key .= $pattern{mt_rand(0, 35)}; //生成php随机数
		}
		return $key;
	}
	/*使文件大小易读*/
	public function human_filesize($bytes, $decimals = 2) {
		$size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
		$factor = floor((strlen($bytes) - 1) / 3);

		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
	}
	/**
	 * [上传文件]
	 * @param  Request $request [必须有file字段]
	 * @param  str  $filekey [判断上传文件类型]
	 * @param  boolean $isTem     [判断是否为临时文件,默认不是]
	 * @return array  $param[status,msg,file_path] [是否成功,错误信息,文件路径]
	 */
	public function upload(Request $request, $filekey, $isTem = false) {
		// 检查文件合法性
		if (!$request->hasFile('file')) {
			$this->param['msg'] = '上传文件为空';
			return $this->param;
		}
		$file = $request->file('file');
		if (!$file->isValid()) {
			$this->param['msg'] = '文件上传出错';
			return $this->param;
		}
		if ($filekey == 'upload_photo') {
			$this->setPath('/upload/photo/');
		} elseif ($filekey == 'upload_video') {
			$this->setPath('/upload/video/');
		} elseif ($filekey == 'upload_image') {
			if ($isTem) {
				$this->setPath('/upload/tmp/');
			} else {
				$this->setPath('/upload/image/');
			}
		} else {
			$this->param['msg'] = '调用方式错误';
			return $this->param;
		}

		$mimeType = $file->getClientMimeType();
		if ($this->isImage($mimeType)) {
			$allow = ['image/jpeg', 'image/jpg', 'image/png'];
			if (!in_array($mimeType, $allow)) {
				$this->param['msg'] = '图片仅支持jpeg,jpg,png格式';
				return $this->param;
			}
			$size = $file->getClientSize();
			if ($size > 5 * pow(1024, 2)) {
				$this->param['msg'] = '上传图片应小于5M，当前图片大小为' . $this->human_filesize($size);
				return $this->param;
			}
		} elseif ($this->isVideo($mimeType)) {
			$allow = ['	video/mp4', 'video/webm', 'video/ogg,'];
			if (!in_array($mimeType, $allow)) {
				$this->param['msg'] = '视频仅支持mp4,webmv,ogv格式';
				return $this->param;
			}
		} else {
			$this->param['msg'] = '上传文件非图片或视频格式';
			return $this->param;
		}
		// 保存文件
		$extension = $file->getClientOriginalExtension();
		$folderName = $this->path;
		$fileName = str_random(10) . $extension;
		$savePath = $folderName . $fileName;
		Storage::disk('local')->put($savePath, file_get_contents($file->getRealPath()));

		$this->param['status'] = true;
		$this->param['msg'] = 'Succeed';
		$this->param['file_path'] = $savePath;
		return $this->param;
	}
	/**
	 * 删除文件
	 * @param  [type] $filePath [description]
	 * @return [type]           [description]
	 */
	public function delete($filePath) {
		Storage::disk('local')->delete($filePath);
	}
}
