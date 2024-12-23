<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
     protected $table = "posts";
    protected $guarded = [];
    protected $appends = ['published_at_days' ,'created_at_days','view_type_id_new','editor'];

    use SoftDeletes;
    use RecordsActivity;

    public function Category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
    public function getImageUrlAttribute(){
        if($this->photo()->count()){
            //return asset($this->photo->thump770);
            return asset($this->photo->file_name);
            //return asset($this->photo->thump770);
        }else{
            $cover=asset('/').'img/default.jpg';
            return $cover;
        }

//        return asset($this->photo->thump770);
    }
    public function getOrginalImageAttribute(){
        if($this->photo()->count()){
            return asset($this->photo->file_name);
        }else{
            $cover=asset('/').'img/default.jpg';
            return $cover;
        }

//        return asset($this->photo->thump770);
    }

    public function getDescriptionsAttribute(){
        return $this->details;
    }


    public function Country(){
        return $this->belongsTo(Country::class ,'country_id');
    }
	
	public function Writer(){
        return $this->belongsTo(Writer::class ,'writer_id');
    }
    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }

    public function PostPhoto(){
        return $this->hasMany(PostAlbumPhoto::class ,'post_id');
    }
    public function getPublishedAtDaysAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }
    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function Position(){
        return $this->belongsTo(PostPosition::class ,'position');
    }
    public function User(){
        return $this->belongsTo(User::class ,'user_id');
    }
    public function Video(){
        return $this->belongsTo(Video::class ,'video');
    }
    public function Cases(){
        return $this->belongsTo(Cases::class ,'case_id');
    }
    public function view_type(){
        return $this->belongsTo(ViewType::class ,'view_type_id');
    }
    public function getViewTypeIdNewAttribute()
    {
        if($this->view_type_id){
            return $this->view_type_id;
        }else{
            return 1;
        }
    }
    public function postTags()
    {
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id');
    }
    public function getEditorAttribute()
    {
        return $this->writer;
    }




    public function scopePrivetFile($query){
        return $query->general()->where('private_file', 1);
    }

    public function scopeSlider($query){
        return $query->general()->where('slider',1)->where('static',0);
    }


    public function scopeStatment($query){
        return $query->general()->where('chosen',1);
    }

    public function scopeReport($query){
        return $query->general()->where('report',1);
    }

    public function scopeGeneral($query){
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $date = Carbon::now();
        //where('remember',0)->
        return $query->where('active', '=', '1')->whereDate('published_at', '<',$date )
            ->whereIn('user_id', $users)->orderBy('published_at','desc');
    }
    public function scopeNews($query){
        return $query->general()
            // ->where('category_id','!=', 53)
            ->where('main_news',1);
    }
    public function scopePopular($query){
        return $query->general()->news()->orderBy('view_count','desc');
    }
    public function scopeStatic($query){
        return $query->general()
            // ->where('category_id','!=', 53)
            ->where('static',1);
    }
    public function scopeRemember($query){
        return $query->general();
            //->where('remember',1);
        // ->where('category_id','!=', 53)
    }
    public function scopeActivities($query){
        return $query->general()
            ->where('category_id',30);
        // ->where('category_id','!=', 53)
    }


}
