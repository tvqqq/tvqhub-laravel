<div class="card">
    <div class="card-header">
        <i class="fas fa-layer-group"></i>
        <strong>{{ count($item->url_details) }}</strong> clicks
    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr class="text-center">
                    <th width="2%">#</th>
                    <th>IP</th>
                    <th>Location</th>
                    <th width="25%">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($item->url_details as $detail)
                    <tr class="text-center">
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->params['ip'] }}</td>
                        <td>
                            @isset($detail->params['ip_tracking'])
                                {{ $detail->params['ip_tracking']['district'] }},
                                {{ $detail->params['ip_tracking']['city'] }},
                                {{ $detail->params['ip_tracking']['country_name'] }}
                                <img src="https://ipgeolocation.io/static/flags/{{ strtolower($detail->params['ip_tracking']['country_code2']) }}_64.png" width="25px" />
                            @else
                                Location is not available.
                            @endisset
                        </td>
                        <td>{{ $detail->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
