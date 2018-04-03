@extends('components.backend.master')
@php
    $active = 'users';
@endphp

@section('title', 'Login')
@section('content')
<!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="#">Table</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Table</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
        @include('components.backend.menu')
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>{{ $user_type->name }} List</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>is Approved</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if ($users != NULL)
                                                @foreach ($users as $user)
                                            
                                                
                                            
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <form action="{{route('admin.user.approve', [ 'user_id' => $user->id ] ) }}" method="POST">
                                                        <input name="_method" type="hidden" value="PUT">
                                                        {{ csrf_field() }}
                                                            <td class="bold ">
                                                                <button class="btn btn-primary btn-sm btn--round" type="submit">{{ ($user->approved_by == NULL) ? 'Pending' : "Approved" }}</button>
                                                            </td>
                                                        </form>
                                                        <td class="pending"><span>{{ ($user->status == 1) ? 'Active' : "Deactive" }}</span></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->

@endsection