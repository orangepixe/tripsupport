{{Form::open(array('url'=>'knowledge-article','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{Form::label('title',__('Title'),array('class'=>'form-label')) }}
            {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))}}
        </div>
        <div class="form-group ">
            {{Form::label('category',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category',$category,null,array('class'=>'form-control hidesearch','required'=>'required'))}}
        </div>
        <div class="form-group  ">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>5,'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('Create'),array('class'=>'btn btn-secondary ml-10'))}}
</div>
{{Form::close()}}

