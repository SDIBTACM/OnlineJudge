@extends('layouts.error')

@section('title', __('Precondition Required'))
@section('code', '428')
@section('message',__($exception->getMessage() ?: 'Precondition Required'))