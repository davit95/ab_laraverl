@if($item->type == 'vo')
    <div class="productCartW">
        <div class="sideCartTL">
            <h4 class="bold aqua">PRODUCT:</h4>
        </div>
        <div class="sideCartTr orange">
            {!! Form::open(['url' => url('cart/'.$item->id), 'method' => 'DELETE']) !!}
                <a href="#" class="delete-item gray3">
                    Remove &nbsp;
                    <img src="images/remove.png" class="remove"/>
                </a>
            {!! Form::close() !!}
        </div>
        <div class="clear"></div>
        <p>
            <span class="mediumBold">Virtual Office</span>
            <br>
            <span class="gray3">
                @if (!is_null($center = $item->center))
                    - 
                    {!! $center->address1 !!}
                    {!! $center->address2!!}<br>
                    {!! $center->city_name !!}, {!! $center->us_state !!} {!! $center->postal_code !!}
                @endif
            </span>
            <br>
            <span class="smallLine mediumBold">12 month term</span>
        </p>
        <table width="100%">
            <tr>
                <td class="sideCartL2">{!! $item->vo_plan !!}:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">${!! $item->price !!}</span>
                    <span class="smallLine gray3"> /month</span>
                </td>
            </tr>
            <tr>
                <td class="sideCartL2">MAIL FORWARDING:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">${!! $item->vo_mail_forwarding_price !!}</span>
                    <span class="smallLine gray3"> /month</span>
                </td>
            </tr>
            <tr>
                <td class="sideCartL2">SET UP FEE:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">$100</span>
                    <br>
                    <span class="smallLine gray3">(one time only)</span>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="sideCartL2">TOTAL:</td>
                <td class="sideCartr2">
                    <span class="mediumBold aqua mediumBold">${!! $item->sum !!}</span>
                </td>
            </tr>
        </table>
    </div>
@endif

@if($item->type == 'mr')
    <div class="productCartW">
        <div class="sideCartTL">
            <h4 class="bold aqua">PRODUCT:</h4>
        </div>
        <div class="sideCartTr orange">
            {!! Form::open(['url' => url('cart/'.$item->id), 'method' => 'DELETE']) !!}
                <a href="#" class="delete-item gray3">
                    Remove &nbsp;
                    <img src="images/remove.png" class="remove"/>
                </a>
            {!! Form::close() !!}
        </div>
        <div class="clear"></div>
        <p>
            <span class="mediumBold">{!! is_null($center = $item->center)?'':$center->city_name !!}</span>
            <br>
            <span class="gray3">
                @if (!is_null($center = $item->center)) 
                    {!! $center->address1 !!}
                    {!! $center->address2!!}<br>
                    {!! $center->city_name !!}, {!! $center->us_state !!} {!! $center->postal_code !!}
                @endif
            </span>
            <br>
            <span class="smallLine mediumBold">
                {{ (new DateTime($item->mr_date))->format('d/m/Y') }}<br>
                {{ (new DateTime($item->mr_start_time))->format('H:i a') }} - {{ (new DateTime($item->mr_end_time))->format('H:i a') }}</span>
        </p>
        <table width="100%">
            <tr>
                <td class="sideCartL2">MEETING ROOM:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">${!! $item->price_per_hour !!}</span>
                </td>
            </tr>
            <tr>
                <td class="sideCartL2">TOTAL AMOUNT:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">${!! $item->price !!}</span>
                </td>
            </tr>
            <tr>
                <td class="sideCartL2">30% DUE NOW:</td>
                <td class="sideCartr2">
                    <span class="mediumBold">{{ $item->price_due }}</span>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="sideCartL2">TOTAL:</td>
                <td class="sideCartr2">
                    <span class="mediumBold aqua mediumBold">${!! $item->price_total !!}</span>
                </td>
            </tr>
        </table>
    </div>
@endif