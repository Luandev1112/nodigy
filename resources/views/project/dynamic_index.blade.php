@extends('layouts.home')

@section('content')
<div class="main-container">
    <div class="home-section4">
        <div class="container">
            <div class="searchbar row">
                <div class="search col-sm-7">
                    <div class="form-group">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.72633 0.51628C6.41702 0.652618 5.11292 1.17541 3.98839 2.01481C3.57169 2.32588 2.80614 3.09339 2.49523 3.51186C1.5296 4.81151 1.01336 6.28543 0.957845 7.90147C0.92479 8.86436 1.041 9.69349 1.33505 10.5922C1.70195 11.7137 2.33227 12.7469 3.16682 13.5947C4.39029 14.8377 5.93644 15.6012 7.66366 15.8153C8.12863 15.873 9.31715 15.8417 9.7602 15.7602C10.7905 15.5706 11.7072 15.215 12.5364 14.6833L12.8572 14.4775L15.1054 16.85C16.3419 18.1548 17.405 19.2663 17.4677 19.32C17.8613 19.6564 18.5459 19.5637 18.8463 19.1334C18.9972 18.9172 19.0439 18.7756 19.0473 18.5248C19.0526 18.1205 19.0267 18.0887 16.651 15.5838C15.4626 14.3306 14.4525 13.2598 14.4064 13.2041L14.3226 13.1029L14.5188 12.8477C15.8489 11.1181 16.3643 8.84288 15.9303 6.61701C15.7134 5.50482 15.1457 4.28209 14.4217 3.36793C12.8001 1.32054 10.286 0.249745 7.72633 0.51628ZM9.22964 2.53802C11.6067 2.85958 13.4894 4.62744 13.9938 7.01169C14.094 7.48545 14.1315 8.43301 14.0678 8.88488C13.8852 10.1802 13.3484 11.2866 12.4691 12.18C11.6213 13.0413 10.5696 13.5876 9.37673 13.7863C8.97652 13.853 8.09745 13.8533 7.66828 13.7869C6.12187 13.5477 4.72117 12.6358 3.86061 11.3081C3.55307 10.8336 3.38768 10.49 3.21757 9.97227C3.03251 9.40909 2.95889 8.98726 2.93528 8.35449C2.81684 5.18173 5.33603 2.51564 8.47758 2.48898C8.67913 2.48727 9.01756 2.50931 9.22964 2.53802Z" fill="white"/></svg>
                        <input type="text" class="form-control" placeholder="Search nэtwork" id="project_search" />
                    </div>
                </div>
                <div class="links col-sm-5">
                    <a href="javascript:void(0)" data-rel="all" class="fil-cat active filter all_rpoject">All Projects</a>
                    <a href="javascript:void(0)" data-rel="testnet" class="fil-cat filter chain_type">Testnet</a>
                    <a href="javascript:void(0)" data-rel="mainnet" class="fil-cat filter chain_type">Mainnet</a>
                    <a href="javascript:void(0)" data-rel="a-z" class="fil-cat" id="sortType">A-Z</a>
                    <input type="hidden" name="sort_type" id="sort_type" value="">
                    <input type="hidden" name="filter_chain_type" id="filter_chain_type" value="">
                </div>
            </div>
            <div class="web3itemscontent" id="portfolio" style="opacity:1;">                
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script type="text/javascript" id="rendered-js">

$('body').addClass('web3projects');

$(document).ready(function() {
    var selectedClass = "";
    /*$(".filter").click(function(){
        $(this).addClass("active").siblings().removeClass("active");
        
        selectedClass = $(this).attr("data-rel");        
        $("#portfolio").fadeTo(500, 1);
        $("#portfolio .tile").not("." + selectedClass).fadeOut().removeClass("scale-anm");
        setTimeout(function(){
            $("." + selectedClass).fadeIn().addClass("scale-anm");
            $("#portfolio").fadeTo(500, 1);
        },300);
        setTimeout(function(){
            $("#loading-animation").hide();
            $(".web3itemscontent").css("visibility","visible");
        },800);
    });*/
});

let getProjectListUrl = "{{ route('web3projects.getlist') }}";
let currentRequest;
$(document).ready(function() {
    
    getProjectList();

    $('body').on("keyup change", "#project_search", function(e){        
        getProjectList();
    });
    $("#sortType").click(function() {
        $(this).addClass("active").siblings().removeClass("active");
        var sortType = $(this).attr('data-rel');
        $('#sort_type').val(sortType);
        if(sortType=="a-z"){
            $(this).html('Z-A');
            $(this).attr('data-rel','z-a');
        }else{
            $(this).html('A-Z');
            $(this).attr('data-rel','a-z');
        }
        getProjectList();
    });

    $(".chain_type").click(function() {
        $(this).addClass("active").siblings().removeClass("active");
        var sortType = $(this).attr('data-rel');
        $('#filter_chain_type').val(sortType);
        getProjectList();
    });
    $(".all_rpoject").click(function() {
        $(this).addClass("active").siblings().removeClass("active");
        $('#filter_chain_type').val("");
        $('#sort_type').val("");
        getProjectList();
    });

});

function getProjectList(){
    if (currentRequest && currentRequest.readyState !== 4) {
        currentRequest.abort();
    }
    var pro_search = $('#project_search').val();
    var sort_type = $('#sort_type').val();
    var filter_chain_type = $('#filter_chain_type').val();
    
    currentRequest = $.ajax({
        url: getProjectListUrl,
        type: 'POST',
        data: {pro_search:pro_search,sort_type:sort_type,filter_chain_type:filter_chain_type},
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(result) 
        {
            $('#portfolio').html();
            if (result.status == true) {                
                $("#portfolio").fadeTo(500, 0, function() {
                    $('#portfolio').html(result.html).fadeTo(500, 1);
                });
            }
        },
        error: function(error) { }
    });
}
</script>

@endsection