{{Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{Form::label('category',__('Category'),array('class'=>'form-label'))}}
            {{Form::text('category',null,array('class'=>'form-control','placeholder'=>__('Enter category')))}}
        </div>
    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('Update'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}

