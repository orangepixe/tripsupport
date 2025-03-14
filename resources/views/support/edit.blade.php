{{Form::model($support, array('route' => array('ticket.update', $support->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{Form::label('headline',__('Headline'),array('class'=>'form-label'))}}
            {{Form::text('headline',null,array('class'=>'form-control','placeholder'=>__('Enter ticket headline')))}}
        </div>
        @if(\Auth::user()->type!='client')
            <div class="form-group col-md-6">
                {{Form::label('client',__('Client'),array('class'=>'form-label'))}}
                {{Form::select('client',$clients,null,array('class'=>'form-control hidesearch'))}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('assignment',__('Assignment'),array('class'=>'form-label'))}}
                {{Form::select('assignment',$users,null,array('class'=>'form-control hidesearch'))}}
            </div>
        @else
            <input type="hidden" name="client" value="{{\Auth::user()->id}}">
            <input type="hidden" name="assignment" value="{{$support->assignment}}">
        @endif
        <div class="form-group col-md-6">
            {{Form::label('importance',__('Importance'),array('class'=>'form-label'))}}
            {{Form::select('importance',$importance,null,array('class'=>'form-control hidesearch'))}}
        </div>
        @if(\Auth::user()->type!='client')
            <div class="form-group col-md-6">
                {{Form::label('stage',__('Stage'),array('class'=>'form-label'))}}
                {{Form::select('stage',$stage,null,array('class'=>'form-control hidesearch'))}}
            </div>
        @else
            <input type="hidden" name="stage" value="{{$support->stage}}">
        @endif
        <div class="form-group col-md-12">
            {{Form::label('category',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category',$category,null,array('class'=>'form-control hidesearch'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('summary',__('Summary'),array('class'=>'form-label'))}}
            {{Form::textarea('summary',null,array('class'=>'form-control','rows'=>5))}}
        </div>
    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('Update'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}
