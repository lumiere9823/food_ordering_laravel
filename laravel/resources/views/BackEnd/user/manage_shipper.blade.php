@extends('layouts.app-master')

@section('content')
<div class="content-wrapper">
    <section class="content container">
        <div class="input-group">
            <form action="{{ route('shippers.search') }}" method="get" style="display: flex;">
                <div class="form-outline" data-mdb-input-init style="display: flex;">
                    <input name="search" type="search" id="form1" placeholder="Type to search" class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="row justify-content-center" style="position: relative">
            <div style="border: solid white 1px; border-radius: 12px; padding: 20px; background: white">
                <div class="card">
                    <div class="card-header">
                        <h3>Datatable for Shippers</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Orders</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr style="text-align: center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->ordersCount }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                    style="min-width: 100px; padding: 8px">
                                                    <button type="button" class="btn btn-warning" style="width: 80%;"
                                                        data-toggle="modal" data-target="#updateuserModal{{ $user->id }}">
                                                        Edit
                                                    </button>
                                                    <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button id="deleteCategoryBtn_{{ $user->id }}"
                                                            class="btn btn-danger show_confirm" style="width: 80%;"
                                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update User Modal -->
                                    <div class="modal fade" id="updateuserModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="updateuserModalLabel{{ $user->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateuserModalLabel{{ $user->id }}">
                                                        Update User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="update-deli-form"
                                                        action="{{ route('user.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name"
                                                                value="{{ $user->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" value="{{ $user->username }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $user->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="role">Role</label>
                                                            <select class="form-control" id="role" name="role">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ $role->id == $user->role ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
