<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">User Table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Picture</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Department</th>

                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    @if (is_null($user->pic))
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Empty</span>
                                        </td>
                                    @else
                                        <td class="align-middle text-center text-sm">
                                            <span class=""><img width="75px"
                                                    src="data:image/png|jpg|jpeg;base64, {!! base64_encode(file_get_contents('../storage/app/' . $user->pic)) !!}"
                                                    alt="Picture"></span>
                                        </td>
                                    @endif
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $user->department->name }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                            data-bs-target="#edituserModal"
                                            wire:click.prevent="edit({{ $user->user_id }})">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="edituserModal" tabindex="-1" aria-labelledby="edituserModallabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edituserModalText">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click.prevent="clear()"></button>
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
                                <input type="hidden" name="user_id" wire:model="user_id">
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
                                            <input class="form-control" id="InputName" type="text" name="name"
                                                autocomplete="off" wire:model="name" />
                                            <label for="inputName">User
                                                Name</label>
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Inputemail" type="text"
                                                {{-- name="email" --}} autocomplete="off" wire:model="email" disabled />
                                            <label for="inputemail">Email</label>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="InputUserPicture" type="file"
                                                name="pic" autocomplete="off" wire:model="pic" />
                                            <span class="text-danger">
                                                @error('pic')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <label for="InputUserPicture">User Picture</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click.prevent="clear()">Close</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="delete()">Delete</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
    {!! $users->links() !!}
</div>
