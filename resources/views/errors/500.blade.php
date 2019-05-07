@extends('layouts.error')

@section('title', __('Service Unavailable'))
@section('code', '500')
@section('message', __($exception->getMessage() ?: 'Internal Server Error'))