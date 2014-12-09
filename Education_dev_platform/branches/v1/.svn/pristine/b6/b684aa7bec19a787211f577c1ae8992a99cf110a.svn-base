<?php
/**
 * 控制器： 导入数据
 * @author CalvinXu
 *
 */
namespace System\Controller;
class ImportController extends BaseAuthController {
    
    private $fileExt = array('xls');
    private $dataType = array(1=>'课程资源',2=>'视频资源');


    public function indexAct() {
        if(!IS_POST){
            $this->assign(array(
                'dataTypeHtml'=> $this->getComboBox($this->dataType, 'dataType',array('selVal'=>-1,'width'=>120)),	
            ));
            $this->display();
        }else{
            $postDataType = $_POST['dataType'];
            $checkField = $_POST['checkField'];
            if(!in_array($postDataType,  array_keys($this->dataType))){
                $this->showResult(result_data(0,'请选择导入对象！'));
            }
            if(empty($checkField)){
                $this->showResult(result_data(0,'头部字段不能为空！'));
            }
            $file = $_FILES['importFile'];
            if($file['type'] != 'application/vnd.ms-excel'){
                $this->showResult(result_data(0,'文件格式错误'));
            }
            $data = new \Org\Util\Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('utf-8'); //编码
            $data->read($file['tmp_name']);
            $firstRow = $data->sheets[0]['cells'][1]; //第一行的数据
            $fieldArr = explode(',', strtolower($checkField));
            if(count($fieldArr) != count($fieldArr)){
                $this->showResult(result_data(0,'核对字段和文件里头部字段不一致'));
            }
            //print_r($firstRow);
            $allField = array();
            foreach ($firstRow as $value) {
                if(!in_array($value, $fieldArr)){
                    $this->showResult(result_data(0,'文件里缺少 '.$value.'字段'));
                }else{
                    $allField[] = $value;
                }
            }
            for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {   
                if($postDataType == 1){ //课程
                    
                }else if($postDataType == 2){ //视频
                    
                }
                if($i%1000 == 0){ //每插入1000条数据 让数据库休息
                    sleep(5);
                }
            } 
            
        }
    }
    
}