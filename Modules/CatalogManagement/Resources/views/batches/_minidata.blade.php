<tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$batch->label}}</td>
                <td>{{$batch->enrolments->count()}}</td>
                <td>{{$batch->mandatory_subjects }}</td>
                <td>{{$batch->elective_subjects}}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm" href="{{ route('batches.show', $batch) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('batches.edit',$batch) }}"><i class="fa fa-edit"></i> </a>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('batches.destroy',$batch) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
            </tr>
