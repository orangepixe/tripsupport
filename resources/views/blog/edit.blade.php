{{ Form::model($blog, array('route' => array('blog.update', $blog->id),'enctype' => "multipart/form-data", 'method' => 'PUT')) }}
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
        <div class="form-group ">
            {{Form::label('thumbnail',__('Thumbnail'),array('class'=>'form-label'))}}
            {{Form::file('thumbnail',array('class'=>'form-control'))}}
        </div>
        <div class="form-group ">
            {{Form::label('status',__('Status'),array('class'=>'form-label'))}}
            {{Form::select('status',$status,null,array('class'=>'form-control hidesearch','required'=>'required'))}}
        </div>
        <div class="form-group  ">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>5,'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('Update'),array('class'=>'btn btn-secondary ml-10'))}}
</div>
{{Form::close()}}
