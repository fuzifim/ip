@extends('layout')
@section('title', 'Danh sách Ip')
@section('header')
    @include('header')
@endsection
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group mt-2">
                    <div class="alert alert-info p-2">
                        <strong>Cung Cấp đến mọi người ⭐ ⭐ ⭐ ⭐ ⭐</strong>
                        <p>Đăng tin lên Cung Cấp để cung cấp sản phẩm, dịch vụ kinh doanh đến mọi người hoàn toàn miễn phí! </p>
                    </div>
                    <div class="btn-group d-flex" role="group"><a class="btn btn-success w-100" href="https://cungcap.net" target="_blank"><h4>Đăng tin miễn phí</h4></a></div>
                </div>
                <div class="form-group mt-2">
                    <div class="form-group">
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-6739685874678212"
                             data-ad-slot="7536384219"
                             data-ad-format="auto"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if(count($listIp)>0)
                    <ul class="list-group">
                        <?php $i=0; ?>
                        @foreach($listIp as $item)
                            <?php $i++;?>
                            @if($i==3 || $i==10)
                                <div class="form-group mt-2">
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="ca-pub-6739685874678212"
                                         data-ad-slot="7536384219"
                                         data-ad-format="auto"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                            @endif
                            <li class="list-group-item">
                                <h3><a href="{!! route('view.ip',$item->ip) !!}">{!! $item->ip !!}</a></h3>
                                <small>{!! $item->updated_at !!}</small>
                            </li>
                        @endforeach
                    </ul>
                    <div class="form-group mt-2">
                        {{ $listIp->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('script')
@endsection