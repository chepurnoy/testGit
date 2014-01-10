<?php

/**
 * Coco behavior uploader
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 */
class CocoFileBehavior extends CActiveRecordBehavior
{

    /**
     * The public url for file
     */
    public $url;

    /**
     * The path to the directory on the server for protected file
     */
    public $path;

    /**
     * @param int $primaryKey Primary key
     */
    public $primaryKey;

    /**
     * An array where keys are fields that contain file     
     */
    public $fields = array();

    /**
     * An array of data fields that contain the file if they have been loaded.
     */
    protected $originalFields;

    /**
     * Prefix for unique session key
     */
    protected $prefix;

    /**
     * Method is called automatically when filling AR model data obtained from the database.
     * In this method an array $originalFields ​​are loaded
     * values of field with the images, if they have been loaded.
     *
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function afterFind($event)
    {
        foreach ($this->fields as $field) {
            $this->originalFields[$field] = $this->getOwner()->$field;
        }
        return parent::afterFind($event);
    }

    /**
     * It checks if there is data in the fields with the images.
     * If a user updates or creates new data are entered.
     * If the user does not change, it loads the data from the array $originalFields.
     *
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function beforeValidate($event)
    {
        foreach ($this->fields as $field) {
            if (Yii::app()->session->get('file_' . $this->prefix . $field)) {
                $tmp = explode('/', Yii::app()->session->get('file_' . $this->prefix . $field));
                $this->getOwner()->$field = end($tmp);
            } else {
                $this->getOwner()->$field = $this->originalFields[$field];
            }
        }
        return parent::beforeValidate($event);
    }

    /**
     * After save, for move by 
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function afterSave($event)
    {
        foreach ($this->fields as $field) {

            if (Yii::app()->session->get('file_' . $this->prefix . $field)) {
                if (!is_dir($this->getFolderPath($field))) {

                    mkdir($this->getFolderPath($field), 0777, true);
                }
                $handle = fopen($this->getFilePath($field), 'w');
                ob_start();
                readfile(Yii::app()->session->get('file_' . $this->prefix . $field));
                $file = ob_get_clean();
                fwrite($handle, $file);

                @unlink(Yii::app()->session->get('file_' . $this->prefix . $field));

                fclose($handle);
            }
            Yii::app()->session->remove('file_' . $this->prefix . $field);
        }
        return parent::beforeSave($event);
    }

    /**
     * Get folder path
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function getFolderPath($field = null)
    {
        if (is_null($field)) {
            return rtrim($this->path, '/') . '/' . $this->getOwner()->tableName() . '/' . $this->getOwner()->{$this->primaryKey};
        }

        return rtrim($this->path, '/') . '/' . $this->getOwner()->tableName() . '/' . $this->getOwner()->{$this->primaryKey} . '/' . $field . '/';
    }

    /**
     * Get file folder path "getFilePath"
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function getFilePath($field)
    {
        return rtrim($this->getFolderPath($field), '/') . '/' . $this->getOwner()->{$field};
    }

    /**
     * Get file type
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     * 
     * @param string $field Field name
     * @param boolean $full Full or not full file type
     * 
     * @return string Return file type
     */
    public function getFileType($field, $full = true)
    {
        if (empty($this->getOwner()->{$field})) {
            return;
        }
        if (true == $full) {
            return mime_content_type($this->getFilePath($field));
        }
        $mimeContentType = explode('/', mime_content_type($this->getFilePath($field)));
        return $mimeContentType[1];
    }

    /**
     * Get file if file protected
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function getFile($field)
    {
        header('Content-Description: File Transfer');
        header('Status: 200');
        header('Content-Type: ' . $this->getFileType($field));
        header('Content-Disposition: attachment; filename=' . basename($this->getOwner()->{$field}));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush();
        readfile($this->getFilePath($field));
        Yii::app()->end();
    }

    /**
     * Set prefix for unique key
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Get file src if folder not protected
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function getFileSrc($field)
    {
        if (!is_null($this->url)) {
            if (!$this->getOwner()->{$field}) {
                return;
            }
            if (is_null($this->getOwner()->{$this->primaryKey}) && !is_null(Yii::app()->session->get('file_' . $this->prefix . $field))) {
                return rtrim($this->url, '/') . '/' . $this->getOwner()->{$field};
            }
            return rtrim($this->url, '/') . '/' . $this->getOwner()->tableName() . '/' . $this->getOwner()->{$this->primaryKey} . '/' . $field . '/' . $this->getOwner()->{$field};
        }
        throw new Exception('Public attribute "url" do not define', 500);
    }

    /**
     * Recursive delete the directory and all its files.
     *
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * Delete files from the server before removing data from the database.
     *
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function afterDelete($event)
    {
        $this->rrmdir($this->getFolderPath());

        return parent::beforeDelete($event);
    }

    /**
     * Save file to ssesion, after move to "getFilePath"
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     */
    public function onAfterFileUploaded($fullFileName, $field)
    {
        Yii::app()->session->add('file_' . $this->prefix . $field, $fullFileName);
    }

}
