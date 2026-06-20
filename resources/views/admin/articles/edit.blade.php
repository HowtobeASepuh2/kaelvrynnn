@extends('admin.layout')
@section('title', 'Edit Insight')
@section('page-title', 'Edit Insight')
@section('content')
@include('admin.articles.form', ['article' => $article, 'action' => route('admin.articles.update', $article), 'method' => 'PUT'])
@endsection
