<?php
namespace app\models;
use core\Model;
use app\models\Uploads;

class Uploads extends Model {
    public function __construct() {
        parent::__construct("uploads");
    }


    public function upload($FILES) {
        $LANGUAGE = Language::getApp();

        $allowed['images'] = array('png', 'jpg', 'jpeg', 'gif');
        $allowed['audios'] = array('mp3', 'vaw');
        $allowed['videos'] = array('mp4', '3gp');
        $allowed['documents'] = array('pdf', 'doc', 'docx');
        $allowed['archives'] = array('zip', 'rar', 'tar');

        if(isset($FILES['upl']) && $FILES['upl']['error'] == 0){
        	$extension = pathinfo($FILES['upl']['name'], PATHINFO_EXTENSION);
            $categorie_dir = "";
            $categorie = "";

        	if(in_array(strtolower($extension), $allowed['images'])){
                $categorie_dir = "images";
                $categorie = "image";
        	}else if(in_array(strtolower($extension), $allowed['audios'])) {
                $categorie_dir = "audios";
                $categorie = "audio";
            }else if(in_array(strtolower($extension), $allowed['videos'])) {
                $categorie_dir = "videos";
                $categorie = "video";
            }else if(in_array(strtolower($extension), $allowed['documents'])) {
                $categorie_dir = "documents";
                $categorie = "document";
            }else if(in_array(strtolower($extension), $allowed['archives'])) {
                $categorie_dir = "archives";
                $categorie = "archive";
            }else{
            	echo '{"status":"error", "reason":"' . $LANGUAGE['upload_error'] .' : '.$LANGUAGE['invalid_file_extension'] . '"}';
            	exit;
            }
            $name = md5(time() . $FILES['upl']['name']);

            $upload_path = $name.'.'.$extension;
            if($this->addUpload($categorie, $name, $extension)) {
                if(move_uploaded_file($FILES['upl']['tmp_name'], DIR_ROOT .'/uploads/'. $categorie_dir .'/'. $upload_path)){
                	echo '{"status":"success", "reason":"' . $LANGUAGE['upload_success'] . '"}';
                	exit;
                }
            }else{
                echo '{"status":"error", "reason":"' . $LANGUAGE['undefined_error'] . '"}';
            	exit;
            }
        }
        echo '{"status":"error"}';
        exit;
    }

    public function addUpload($categorie, $path, $extension) {
        $date = new Datetime();
        $date =  $date->format('Y-m-d');
        $data = [
            'upload_categorie' => $categorie,
            'upload_path' => $path,
            'upload_extension' => $extension,
            'upload_date' => $date
        ];
        return $this->insert($data);
    }

    public function deleteUploadbyId($id) {
        return $this->delete('upload_id', $id);
    }

    private $_lastPage;
    public function getLastPage() {
        return $this->_lastPage;
    }

    public function getUploadsByCategorie($categorie, $page) {
        $cat = "";
        switch ($categorie) {
            case 'images':
                $cat = "image";
                break;
            case 'videos':
                $cat = "video";
                break;
            case 'archives':
                $cat = "archive";
                break;
            case 'documents':
                $cat = "document";
                break;
            case 'audios':
                $cat = "audio";
                break;
        }
        if($cat != "") {

            $perUploadCount = 3;

            $rowCount = $this->getRowCount([
                "where" => "upload_categorie = '{$cat}'"
            ]);

            $lastPage =  ceil($rowCount/$perUploadCount);
            if($lastPage < 1) $lastPage = 1;

            if($page < 1) {
                $page = 1;
            }elseif($page > $lastPage) {
                $page = $lastPage;
            }
            $this->_lastPage = $lastPage;

            $start = (($page-1)*$perUploadCount);
            return $this->select([
                "where" => "upload_categorie = '{$cat}'",
                "limit" => "$start, $perUploadCount"
            ]);
        }
        return null;
    }
}
