@extends('layouts.app')

@section('title', 'FootStat')

@section('content')
  <competitions :leagues="leagues"></competitions>
  <home-page :leagues="leagues"></home-page>
@endsection
