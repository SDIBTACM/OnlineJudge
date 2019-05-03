@extends('layouts.error')

@section('title', __('Conflict'))
@section('code', '409')
@section('message',__($exception->getMessage() ?: 'Conflict'))