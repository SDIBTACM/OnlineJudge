@extends('layouts.error')

@section('title', __('Gone'))
@section('code', '410')
@section('message',__($exception->getMessage() ?: 'Gone'))