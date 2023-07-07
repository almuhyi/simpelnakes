@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        <h1 class="h1">{{ $contact->subject }}</h1>
        <p>Username : {{ $contact->name }}</p>
        <p>{!! nl2br($contact->reply) !!}</p>

        <p>Jika Anda tidak mengirimkan permintaan ini, abaikan saja.</p>
    </td>
@endsection
