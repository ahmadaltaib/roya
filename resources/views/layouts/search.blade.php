<section class="text-center search-box">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 text-center">
                <form id="search-form" method="post">
                    @csrf
                    <div class="input-group">
                            <input class="form-control py-2 border-right-0 bg-light" type="search" placeholder="{{ __('roya.NEED_QUICK_HELP_TYPE_YOUR_WORDS') }}" id="keyword" name="keyword" value="@if(isset($sKeyword) && !empty($sKeyword)) {{$sKeyword}} @endif" autocomplete="off">
                            <span  class="input-group-append"><div id="find" class="input-group-text bg-light border-left-0 search-btn"><i class="fa fa-search" title="{{__('roya.FIND')}}"></i></div></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>