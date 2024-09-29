@extends('adminlte::auth.login')
@if (session('status') === 'account-delete')
    <p class="text-sm text-red-600">
        {{ __("Account Deleted Success.") }}
    </p>
@endif
