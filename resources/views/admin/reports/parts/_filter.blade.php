{!! Form::open([ 'url' => url('reports'), 'method' => 'GET' , 'class' => 'form-inline']) !!}
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group">
            {{-- <span class="input-group-addon"><i class="fa fa-glass"></i></span> --}}
                <div class="reportsIcon filter"></div>
                {!! Form::select('activity', ['active' => 'Active', 'inactive' => 'Inactive'], Request::get('activity'), ['class' => 'form-control', 'id' => 'activity']) !!}
            </div>            
            <div class="form-group">
                {!! Form::select('activity', ['syte' => 'Sytes', 'inactive' => 'Inactive'], Request::get('activity'), ['class' => 'form-control', 'id' => 'activity']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label class="checkbox-inline">                    
                    {!! Form::checkbox('abcn', 1, null) !!} ABCN
                </label>
                <label class="checkbox-inline">
                    {!! Form::checkbox('avo', 1, null) !!} AVO
                </label>
                <label class="checkbox-inline">
                    {!! Form::checkbox('mr', 1, null) !!} MR
                </label>
            </div>
        </div>
        <div class="col-lg-4">
            <button type="button" class="pull-right btn btn-success"><i class="fa fa-search"></i></button>
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; margin-right:15px; padding: 5px 10px; border: 1px solid #ccc;">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                <span>Show result for all time</span> <b class="caret"></b>
            </div>
        </div>
    </div>
{!! Form::close() !!}