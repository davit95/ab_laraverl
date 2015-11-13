@if(isset($item->vo_plan))
    <div class="productCartW">
        <div class="sideCartTL">
            <h4 class="bold aqua">PRODUCT:</h4>
        </div>
        <div class="sideCartTr orange">
            <a href="#" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a>
        </div>
        <div class="clear"></div>
        <p>
            <span class="mediumBold">Virtual Office</span>
            <br>
            <span class="gray3">KPMG Building - 355 S. Grand Ave. Los Angeles, CA 90071</span>
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