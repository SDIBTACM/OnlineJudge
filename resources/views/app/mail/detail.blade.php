<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-19 13:03
 */
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div id="mail-topic" class="card-title">
                    <h3>
                        <strong>{{ __("Topic") }}:</strong> {{ $mail->topic }}
                    </h3>
                </div>
                <div id="mail-detail" class="">
                    <div id="mail-user">
                        <h5>
                            {{ __('FROM') }}: <a href="{{ route('user.info', ['id', $mail->from_user_id]) }}"> {{ $mail->fromUser->nickname ?: $mail->fromUser->username }} </a>
                            <br>
                            {{ __('TO') }}: <a href="{{ route('user.info', ['id', $mail->to_user_id]) }}"> {{ $mail->toUser->nickname ?: $mail->toUser->username }} </a>
                        </h5>

                    </div>
                    <div id="mail-time" data-content="{{ $mail->created_at->timestamp }}">
                        <h5>
                            {{ __('sent at') }}:
                            <span id="mail-time-local" class="small font-weight-light"> </span>
                            <span id="mail-time-utc"  class="small font-weight-light"> </span>
                        </h5>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div>

                </div>
                <div id="mail-context">
                    {!! $mail->context->context !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const timestamp = $('#mail-time')[0].dataset.content;
        const mailLocalTime = moment.unix(timestamp);
        const mailUTCTime = moment.utc(mailLocalTime);
        $('#mail-time-utc').html(mailUTCTime.format("YYYY-MM-DDTHH:mm:ss z"));
        $('#mail-time-local').html(mailLocalTime.tz(moment.tz.guess()).format("YYYY-MM-DDTHH:mm:ss z"));
    </script>
@endsection