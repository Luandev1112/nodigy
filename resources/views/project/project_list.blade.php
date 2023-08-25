@foreach ($allData as $key => $row)
    @php
        $chaintype = ($row->chain_type==1) ? "testnet":"mainnet";
        $chaintype_text =(isset($chainType[$row->chain_type]))? $chainType[$row->chain_type]:"";
    @endphp
    <div class="box tile scale-anm all <?=$chaintype?> project" id="project_{{$row->id}}">
        <div class="row">
            <div class="col-sm-3">
                <div class="items">
                    <div class="img">
                        <img src="{{$row->getImageUrl()}}" alt="Image" />
                    </div>
                    <div class="row1">
                        <div class="name">{{$row->project_name}}</div>
                        <div class="per"><span>{{ $chaintype_text }}</span></div>
                    </div>
                    <div class="row2">
                        <div class="price">${{$row->id}}.5B</div>
                        <div class="value">Market Cap</div>
                    </div>
                    <div class="row3">
                        <div class="buttons">
                            @if($row->project_website)
                                <a target="_black" href="{{$row->project_website}}">Live</a>
                            @else
                                <a href="javascript:void(0);">Coming soon</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <p>{!! $row->description !!}</p>
            </div>
        </div>
    </div>
@endforeach