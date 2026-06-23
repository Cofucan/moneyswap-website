<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Incident;
use App\Models\Announcement;
use Auth;
use Carbon\Carbon;
use Session;
use File;

trait CommentTrait {
    
    public function saveComment()
    {
        $this->comment = new Comment; 
        $this->comment->comment_body = $this->data['comment_body'];              
        $this->comment->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : NULL;
        $this->comment->commentable_type = !empty($this->data['commentable_type']) ? $this->data['commentable_type'] : NULL;
        switch ($this->comment->commentable_type){
            case "announcements":
                if(!isset($this->announcement))
                {
                    $this->announcement = Announcement::find(!empty($this->data['announcement_id']) ? $this->data['announcement_id'] : $this->commentable_id);
                }
                $this->announcement->Comments()->save($this->comment);
            break;
            case "incidents":
                if(!isset($this->incident))
                {
                    $this->incident = Incident::find(!empty($this->data['incident_id']) ? $this->data['incident_id'] : $this->commentable_id);
                }
                $this->incident->Comments()->save($this->comment);
            break;
           
            default:
            $this->comment->save();
        }    
        return $this->comment;
    }
}
