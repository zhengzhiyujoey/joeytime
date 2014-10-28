<?php
/**
 * 文件操作类
 *
 * @author Administrator
 */
namespace Ku;
use Zend\File\Transfer\Transfer;
use Yaf\Registry;
class File {

    /**
     *获取上传目录(默认是以年月为目录 例'201403')
     * @param string $path
     * @return type
     */
    public static function getUploadPath($dir = '',$path = ''){
        $config = Registry::get('config');
        $dir = '';
        if(isset($config['upload']['dir']) && $config['upload']['dir']){
            $dir = $config['upload']['dir'];
        }
        $dir = rtrim(($dir?$dir:PUBLIC_PATH),DS).DS.'/uploads/';
        if($path){
            $reldir = DS.trim($path,DS);
        }else{
            $reldir = DS.date('Ym');
        }
        $dir = $dir.$reldir;
        if(!is_dir($dir)){
            \Ku\Tool::makeDir($dir);
        }
        return array('dir'=>$dir,'reldir'=>$reldir);
    }


    public static function upload($path = ''){
        $file = new Transfer();
        try{
            $info = $file->getFileInfo();
        }catch(\Exception $exc){
             throw new \Exception('加载文件失败');
        }
        $fileInfo = array_values($info);
        $pathArr = self::getUploadPath($path);
        $config = Registry::get('config');
        $file->addValidator('Extension', false, array('extension'=>$config['upload']['ext'],'messages'=>array('fileExtensionFalse'=>'上传的文件格式有误')));
        $file->addValidator('Size',false,array('min'=>0,'max'=>$config['upload']['size'],'messages'=>array('fileSizeTooBig'=>'文件大小已经超出了限制')));
        $extName = self::getExtension($fileInfo[0]['name']);
        $fileName = date("His", time()) . (intval(9000000 * (rand(0, 10000000) / 10000000)) + 1000000) . '.' . $extName;
        $file->addFilter('Rename', array('target' =>$fileName, 'overwrite' => true));
        if(!$file->isValid()){
            throw  new \Exception(current($file->getMessages()));
        }
            try{
                $file->setDestination($pathArr['dir']);
                $file->receive();
                return $pathArr['reldir'].DS.$fileName;
            }  catch (\Exception $exc){
                throw  new \Exception('文件上传失败，请重新上传');
            }

        
    }


    /**
     * 获取文件扩展名
     * @param string $path
     */
    public static function getExtension($fileName) {
        $exts = @split("[/\\.]", $fileName);
        $n = count($exts) - 1;
        return $exts[$n];
    }




}
