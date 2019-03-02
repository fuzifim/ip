@extends('layout')
@section('title', $ip->ip)
@section('description', '')
@section('header')
    @include('header')
@endsection
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-8">
                <h1>{!! $ip->ip !!}</h1>
                <div class="form-group mt-2">
                    <div class="alert alert-info p-2">
                        <strong>Cung Cấp đến mọi người ⭐ ⭐ ⭐ ⭐ ⭐</strong>
                        <p>Đăng tin lên Cung Cấp để cung cấp sản phẩm, dịch vụ kinh doanh đến mọi người hoàn toàn miễn phí! </p>
                    </div>
                    <div class="btn-group d-flex" role="group"><a class="btn btn-success w-100" href="https://cungcap.net" target="_blank"><h4>Đăng tin miễn phí</h4></a></div>
                </div>
                {{--<div class="form-group mt-2">--}}
                    {{--<ins class="adsbygoogle"--}}
                         {{--style="display:block"--}}
                         {{--data-ad-client="ca-pub-6739685874678212"--}}
                         {{--data-ad-slot="7536384219"--}}
                         {{--data-ad-format="auto"></ins>--}}
                    {{--<script>--}}
                        {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                    {{--</script>--}}
                {{--</div>--}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{!! $ip->ip !!}</h5>
                        <p><strong>City: </strong>{!! $ip->city !!}</p>
                        <p><strong>Country: </strong>{!! $ip->country !!}</p>
                        <p><strong>Company: </strong>{!! $ip->org !!}</p>
                        <p><strong>Time Zone: </strong>{!! $ip->timezone !!}</p>
                        <p><strong>Browser: </strong>{!! $ip->browser !!}</p>
                        <p><strong>Operating System: </strong>{!! $ip->operating_system !!}</p>
                        <p><strong>Updated at: </strong>{!! $ip->updated_at !!}</p>
                    </div>
                </div>
                {{--<div class="form-group mt-2">--}}
                    {{--<ins class="adsbygoogle"--}}
                         {{--style="display:block"--}}
                         {{--data-ad-client="ca-pub-6739685874678212"--}}
                         {{--data-ad-slot="7536384219"--}}
                         {{--data-ad-format="auto"></ins>--}}
                    {{--<script>--}}
                        {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                    {{--</script>--}}
                {{--</div>--}}
            </div>
            <div class="col-md-4">
                @if(count($listNew))
                    <ul class="list-group">
                        @foreach($listNew as $item)
                            <li class="list-group-item">
                                <a href="{!! route('view.ip',$item->ip) !!}">{!! $item->ip !!}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('script')
@endsection