<?php

namespace Modules\CatalogManagement\Traits;

use Modules\CatalogManagement\Entities\Program;
use Modules\CatalogManagement\Entities\Level;
use Session;
use Carbon\carbon;
use PDF;
trait ProgramTrait {

    public function saveProgram()
    {
        $this->program = new Program;
        $this->program->cause_id = !empty($this->data['cause_id']) ? $this->data['cause_id'] : $this->cause_id;
        $this->program->tag = !empty($this->data['tag']) ? $this->data['tag'] : $this->tag;
        $this->program->display_order = !empty($this->data['display_order']) ? $this->data['display_order'] : $this->display_order;
        $this->program->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : NULL;
        $this->program->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : '1';
        $this->program->label = !empty($this->data['label']) ? $this->data['label'] : $this->label;
        $this->program->graduation_qualification = !empty($this->data['graduation_qualification']) ? $this->data['graduation_qualification'] : NULL;
        $this->program->study_tenure = !empty($this->data['study_tenure']) ? $this->data['study_tenure'] : 3;
        $this->program->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;

        if ( ! $this->program->save()) {
            return redirect()->back()->withErrors('Error Saving record');
        }
        return $this->program;
    }

    public function saveLevel()
    {
        $level = new Level;
        $level->program_id = $this->data['program_id'];
        $level->label = $this->data['label'];
        $level->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : NULL;
        $level->is_terminal = !empty($this->data['is_terminal']) ? $this->data['is_terminal'] : false;
        $level->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $level->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : 1;
        if ( !$level->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Data Entry Error');
        }
        return $level;
    }
    
}
