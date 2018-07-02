<div class="panel panel-{{ $values['color'] }}">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa {{ $values['icon'] }} fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
                <div class="huge">{{ $values['count'] }}</div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <span class="pull-left">@lang($values['message'])</span>
        <div class="clearfix"></div>
    </div>
</div>