<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileLibrary extends Model
{
    protected $table = "files_library";
    protected $guarded = [];
    protected $appends = ['thump','thump370','thump770','tag_array'];
    use RecordsActivity;

    use SoftDeletes;


    public function album(){
        return $this->belongsTo(Albom::class,'album_id');
    }
    public function getThumpAttribute()
    {
        if($this->id>0){
            $thumb=explode('/',$this->file_name);
            array_splice($thumb, 2, 0, 'thump_120');

            $file_image= implode('/',$thumb);
        }else{
            if($this->file_name && strpos($this->file_name, 'uploads') !== false){
                $file_name=$this->file_name;
            }else{
                $file_name=$this->name;
            }
            if (strpos($file_name, 'uploads//images') !== false) {
                $file_image=$file_image= str_replace("uploads//images","uploads/images",$file_name);
            }else{
                $file_image=$file_image= str_replace("uploads/images","uploads/images",$file_name);
            }



        }
        return $file_image;
        if (file_exists( base_path() . '/' .$file_image)) {

            return $file_image;
        }else{
            return 'homeStyle/not_found.jpg';
        }

    }
    public function getThump370Attribute()
    {
        if($this->id>0){

            $thumb=explode('/',$this->file_name);
            array_splice($thumb, 2, 0, 'thump_370');

            $file_image= implode('/',$thumb);
        }else{
            if($this->file_name && strpos($this->file_name, 'uploads') !== false){
                $file_name=$this->file_name;
            }else{
                $file_name=$this->name;
            }
            if (strpos($file_name, 'uploads//images') !== false) {
                $file_image=$file_image= str_replace("uploads//images","uploads/images",$file_name);
            }else{
                $file_image=$file_image= str_replace("uploads/images","uploads/images",$file_name);
            }

        }
        return $file_image;
        if (file_exists( base_path() . '/' .$file_image)) {

            return $file_image;
        }else{
            return 'homeStyle/not_found.jpg';
        }
    }
    public function getThump770Attribute()
    {
        if($this->id>0){

            $thumb=explode('/',$this->file_name);
            array_splice($thumb, 2, 0, 'thump_770');

            $file_image= implode('/',$thumb);
        }else{
            if($this->file_name && strpos($this->file_name, 'uploads') !== false){
                $file_name=$this->file_name;
            }else{
                $file_name=$this->name;
            }
            if (strpos($file_name, 'uploads//images') !== false) {
                $file_image=$file_image= str_replace("uploads//images","uploads/images",$file_name);
            }else{
                $file_image=$file_image= str_replace("uploads/images","uploads/images",$file_name);
            }


        }
        return $file_image;
        if (file_exists( base_path() . '/' .$file_image)) {

            return $file_image;
        }else{
            return 'homeStyle/not_found.jpg';
        }
    }

    public function getTagArrayAttribute()
    {
        return explode(',',$this->tags);
    }

}
