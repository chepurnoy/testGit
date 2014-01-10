<?php

/**
 * CocoCodWidget
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 * @version $Id$
 * @package extensions
 * @since 1.0
 */
Yii::import('application.extensions.cocoCod.coco.*');

class CocoCodWidget extends CocoWidget
{

    public $defaultActionName = 'cocoCod';
    public $uploadUrl;
    private $_baseUrl;

    // de: EYuiActionRunnable
    public function runAction($action, $data)
    {
        Yii::log('ACTION CALLED - action is: ' . $action, 'info');

        $vars = unserialize($data);

        $this->allowedExtensions = $vars['allowedExtensions'];
        $this->sizeLimit = (integer)$vars['sizeLimit'];
        $this->uploadDir = $vars['uploadDir'];
        $this->uploadUrl = $vars['uploadUrl'];
        $this->receptorClassName = $vars['receptorClassName'];
        $this->methodName = $vars['methodName'];
        $this->userdata = $vars['userdata'];

        if (($this->allowedExtensions == null) || ($this->allowedExtensions == ''))
            $this->allowedExtensions = array();

        Yii::log('ACTION CALLED - data is: ' . CJSON::encode($vars), 'info');


        if ($action == 'upload') {

            $uploader = new ValumsFileUploader($this->allowedExtensions, $this->sizeLimit);
            if ($uploader->checkServerSettings() != null) {
                Yii::log("CocoWidget. Please increase post_max_size and upload_max_filesize to " . $this->sizeLimit, "error");
                return;
            }

            // ensure directory
            $this->uploadDir = rtrim($this->uploadDir, '/') . '/';

            @mkdir($this->uploadDir, 0777, true);

            $result = $uploader->handleUpload($this->uploadDir);
            if (isset($result['success'])) {
                if ($result['success'] == true) {
                    Yii::log('ACTION CALLED - RESULT=SUCCESS', 'info');
                    $fullpath = $result['fullpath'];
                    $this->onFileUploaded($fullpath, $this->userdata, $result);
                } else {
                    Yii::log('ACTION CALLED - RESULT=ERROR1', 'info');
                }
                if (is_null($this->uploadUrl)) {
                    $this->uploadUrl = Yii::app()->getBaseUrl(true) . '/uploads/';
                }

                $result['uploadUrl'] = rtrim($this->uploadUrl, '/') . '/' . $result['filename'] . '.' . $result['ext'];
            } else {
                Yii::log('ACTION CALLED - RESULT=ERROR2', 'info');
            }

            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        }
    }

    private function onFileUploaded($filePath, $userdata, $result)
    {

        // will invoke method in a class defined when you setup the widget:
        // using: receptorClassName and methodName attributes.
        $this->_invokeMethod($filePath, $userdata, $result);
    }

    private function getClassNameFromPhp($filename)
    {
        $noext = trim(substr(strrev(trim($filename)), 4, strlen(trim($filename)) - 4));
        $k = 0;
        for ($i = 0; $i < strlen($noext); $i++) {
            if (($noext[$i] == '\\') || ($noext[$i] == '/'))
                $k = $i;
            if ($k > 0)
                break;
        }
        if ($k == 0)
            $k = strlen($noext);

        return strrev(substr($noext, 0, $k));
    }

    private function _invokeMethod($upladedFilePath, $userdata, $result)
    {
        try {
            if (!empty($this->receptorClassName)) {
                $phpFilepath = Yii::getPathOfAlias($this->receptorClassName) . ".php";
                $className = $this->getClassNameFromPhp($phpFilepath);
                Yii::log('receptorClassName is: ' . $phpFilepath . ', className=' . $className, 'info');
                if (!file_exists($phpFilepath)) {
                    Yii::log('the provided receptorClassName does not exist.' . $phpFilepath, 'error');
                    return false;
                }

                if (!class_exists($className, false))
                    require($phpFilepath);

                if (!class_exists($className, false))
                    return false;

                $inst = new $className();
                if ($inst != null) {
                    try {
                        $methodname = $this->methodName;
                        try {
                            $inst->$methodname($upladedFilePath, $userdata, $result);
                        } catch (Exception $e) {
                            Yii::log(__CLASS__ . ' an error occurs when invoke: ' . $phpFilepath . ' method: ' . $methodname
                                . ', error is: ' . $e
                                , 'error');
                        }
                        // method invoked
                    } catch (Exception $e) {
                        Yii::log('the defined receptorClassName has not a method named -' . $this->methodName . '-'
                            , 'error');
                    }
                } else {
                    Yii::log('the defined receptorClassName is an invalid class. cannot be instanciated.', 'error');
                }
            }
        } catch (Exception $e) {
            Yii::log(__CLASS__ . ' an error occurs.', 'error');
        }
    }

    public function registerCoreScripts()
    {

        $localAssetsDir = dirname(__FILE__) . '/assets';
        $this->_baseUrl = Yii::app()->getAssetManager()->publish($localAssetsDir);

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        if ($this->debug)
            $this->_baseUrl = 'protected/extensions/cocoCod/assets';

        foreach (scandir($localAssetsDir) as $f) {
            $_f = strtolower($f);
            if (strstr($_f, ".js"))
                $cs->registerScriptFile($this->_baseUrl . "/" . $_f);
            if (strstr($_f, ".css"))
                $cs->registerCssFile($this->_baseUrl . "/" . $_f);
        }
    }

    public function run()
    {

        $id = $this->id;
        $upid = $id . 'uploader';
        $logid = $id . 'logger';
        $action = $this->defaultControllerName . '/' . $this->defaultActionName;
        $params['action'] = 'upload';
        $params['data'] = ""; // see later after $vars


        $htopts = '';
        if (empty($this->htmlOptions)) {
            $htopts = "class='cocowidget'";
        } else {
            if (!isset($this->htmlOptions['class']))
                $this->htmlOptions['class'] = 'cocowidget';
            foreach ($this->htmlOptions as $key => $val)
                $htopts .= " {$key}='$val'";
        }

        if ($this->onCompleted == null)
            $this->onCompleted = 'function(id,filename,jsoninfo){ }';
        if (!($this->onCompleted instanceof CJavaScriptExpression))
            $this->onCompleted = new CJavaScriptExpression($this->onCompleted);

        if ($this->onCancelled == null)
            $this->onCancelled = 'function(id,filename){ }';
        if (!($this->onCancelled instanceof CJavaScriptExpression))
            $this->onCancelled = new CJavaScriptExpression($this->onCancelled);

        if ($this->onMessage == null)
            $this->onMessage = 'function(messageText){ }';
        if (!($this->onMessage instanceof CJavaScriptExpression))
            $this->onMessage = new CJavaScriptExpression($this->onMessage);

        $vars = array(
            'allowedExtensions' => $this->allowedExtensions,
            'sizeLimit' => $this->sizeLimit, // server-side size validation
            'uploadDir' => $this->uploadDir,
            'uploadUrl' => $this->uploadUrl,
            'receptorClassName' => $this->receptorClassName,
            'methodName' => $this->methodName,
            'userdata' => $this->userdata,
        );

        $params['data'] = serialize($vars);
        $url = str_replace(Yii::app()->createAbsoluteUrl('/site/cocoCod'), Yii::app()->createAbsoluteUrl($action), Yii::app()->createAbsoluteUrl('site/cocoCod', $params));

        $options = CJavaScript::encode(
            array(
                'id' => $id,
                'loggerid' => $logid,
                'action' => $url,
                'onCompleted' => $this->onCompleted,
                'onCancelled' => $this->onCancelled,
                'onMessage' => $this->onMessage,
                'buttonText' => $this->buttonText,
                'dropFilesText' => $this->dropFilesText,
                'uploaderContainer' => $upid,
                'sizeLimit' => $this->sizeLimit, // for client-side size validt.
                'multipleFileSelection' => $this->multipleFileSelection,
                'maxConnections' => $this->maxConnections,
                'maxUploads' => $this->maxUploads,
                'maxUploadsReachMessage' => $this->maxUploadsReachMessage,
                //'data'=>serialize($vars),
            )
        );

        echo
        "
	<!-- CocoWidget begins -->
	<div id='{$id}' {$htopts}>
		<div id='{$upid}' class='uploader'></div>
		<div id='{$logid}' class='logger'></div>
	</div>
	<!-- CocoWidget ends -->
";

        Yii::app()->getClientScript()->registerScript(
            $id, "
	var _cocoUp = new CocoWidget({$options});
	_cocoUp.run();
", CClientScript::POS_LOAD
        );
    }

}
