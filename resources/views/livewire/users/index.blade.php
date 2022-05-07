<div id="app">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-fluid">
                <div class="row justify-content-center mx-2">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="text-center font-weight-light my-4">User Table</h3>
                                    {{-- <a href="{{ route('template.create') }}"
                                    class="btn btn-outline-success w-25 mx-auto text-capitalize"><i
                                    class="bi bi-file-earmark-plus"></i> Create</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    {{-- <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Users Table
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input wire:model.debounce.300ms="search" type="text"
                                                class="form-control mb-3" placeholder="Search Here">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" wire:model="orderBy">
                                                    <option value="name">Name</option>
                                                    <option value="email">email</option>
                                                </select>
                                                <label for="ChooseOrderCoulmn">Order By Coulmn</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" wire:model="orderAsc">
                                                    <option value="1">Ascending</option>
                                                    <option value="0">Descending</option>
                                                </select>
                                                <label for="ChooseOrderType">Order Type</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="datatablesSimple" class="table table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Picture</th>
                                                    <th>Department</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        @if (is_null($user->pic))
                                                            <td>Empty</td>
                                                        @else
                                                            <td><img src="{{ $user->pic }}" alt="Picture"></td>
                                                        @endif
                                                        <td>{{ $user->department->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal" data-bs-target="#edituserModal"
                                                                wire:click.prevent="edit({{ $user->user_id }})">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="edituserModal" tabindex="-1"
                                        aria-labelledby="edituserModallabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edituserModalText">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" wire:click.prevent="clear()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if (Session()->has('WrongUser'))
                                                        <div class="alert alert-danger">
                                                            {{ Session('WrongUser') }}
                                                        </div>
                                                    @endif
                                                    @if (!Session()->has('WrongUser'))
                                                        <div class="card-body">
                                                            <form autocomplete="off" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    wire:model="user_id">
                                                                <div class="results">
                                                                    @if (Session()->has('message'))
                                                                        <div class="alert alert-success">
                                                                            {{ Session('message') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control"
                                                                                id="InputName" type="text"
                                                                                name="name"
                                                                                autocomplete="off"
                                                                                wire:model="name" />
                                                                            <label for="inputName">User
                                                                                Name</label>
                                                                            <span
                                                                                class="text-danger">@error('name')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control"
                                                                                id="Inputemail" type="text"
                                                                                {{-- name="email" --}}
                                                                                autocomplete="off"
                                                                                wire:model="email" disabled/>
                                                                            <label for="inputemail">Email</label>
                                                                            <span
                                                                                class="text-danger">@error('email')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="InputUserPicture" type="file"
                                                                                name="pic" autocomplete="off" wire:model="pic" />
                                                                            <span class="text-danger">@error('pic')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                            <label for="InputUserPicture">User Picture</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                        wire:click.prevent="clear()">Close</button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click.prevent="delete()">Delete</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        wire:click.prevent="update()">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
