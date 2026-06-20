@extends('admin.layout')
@section('title', 'Tambah Insight')
@section('page-title', 'Tambah Insight')
@section('content')
@include('admin.articles.form', ['article' => null, 'action' => route('admin.articles.store'), 'method' => 'POST'])
@endsection
